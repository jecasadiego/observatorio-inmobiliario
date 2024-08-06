<?php

namespace App\Http\Controllers;

use App\Models\Inmuebles;
use App\Models\Entidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Notifications\InmueblesPorVencerNotification;
use Illuminate\Support\Facades\Notification;
use App\Clases\VariablesPredefinidas;
use App\Models\FormatoEmail;




class InmuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $latitud = Inmuebles::LATITUD;
        $longitud = Inmuebles::LONGITUD;

        $entidad = Entidad::with('divipos_municipios')->first();
        $tiposInmuebles = Inmuebles::getTiposInmuebles();


        return response()->view('inmuebles.crear', compact('latitud', 'longitud', 'entidad', 'tiposInmuebles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $inmueble = new Inmuebles($request->all());
            $inmueble->id_user = Auth::id();
            $inmueble->valor_incluye_administracion = $request->has('valor_incluye_administracion') ? $request->input('valor_incluye_administracion') : 0;
            $inmueble->save();
            $respuesta = $this->RecibirImagenes($request, $inmueble);
            if ($respuesta['status'] == false) {
                $message = $respuesta['error'];
                DB::rollBack();
                return redirect()->route('inmuebles.crear')->with('error', $message);
            } else {
                DB::commit();
                $formato_email = FormatoEmail::where('sigla', 'store_inmueble')->first();
                $entidad = Entidad::first();
                $usuario = Auth::user();

                $body_correo_predefinido = VariablesPredefinidas::setFrom(['users' => $inmueble->id_user, 'entidad' => $entidad->id, 'inmuebles' => $inmueble->id])
                    ->replaceString($formato_email->descripcion, 'body')
                    ->replaceSpecific("[[categoria]]", $request->tipo_oferta == Inmuebles::TIPO_OFERTA_VENTA ? 'Venta' : 'Arriendo')
                    ->getReplaceToObject();

                $data_mail = (object)[
                    'remitente' => $entidad->remitente,
                    'email_e' => $usuario->email,
                    'bcc' => $entidad->bcc,
                    'asunto' => 'Confirmación de Creación de Publicación',
                    'cuerpo' => $body_correo_predefinido->body,
                ];

                try {
                    $client = new Client();
                    $client->request('POST', 'http://localhost:3001/email', [
                        'json' => [
                            'remitente' => $data_mail->remitente,
                            'to' => $data_mail->email_e,
                            'bcc' => $data_mail->bcc,
                            'asunto' => $data_mail->asunto,
                            'cuerpo' => $data_mail->cuerpo
                        ]
                    ]);
                } catch (\Exception $e) {
                    $error = $e;
                }
                return redirect()->route('dashboard')->with('success', 'Inmueble creado con exito');
            }
        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect()->route('inmuebles.crear')->with('error', $th->getMessage());
        }
    }

    private function RecibirImagenes(Request $request, Inmuebles $inmueble)
    {
        try {
            if ($request->hasFile('portada')) {
                $path = $request->file('portada')->store('images', 'public');
                $inmueble->guardarImagen($path, true);
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('images', 'public');
                    $inmueble->guardarImagen($path, false);
                }
            }
            return ["status" => true, "message" => "Se agrego correctamente las imagenes del inmueble"];
        } catch (\Throwable $th) {
            return ["error" => $th->getMessage(), "status" => false, "message" => "No se pudo agregar las imagenes del inmueble"];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inmuebles  $inmueble
     * @param  \App\Models\Inmuebles::TIPO_OFERTA_VENTA || \App\Models\Inmuebles::TIPO_OFERTA_ARRIENDO
     * @return \Illuminate\Http\Response
     */
    public function show(Inmuebles $inmuebles, int $tipo_oferta, int $active): Response
    {
        $inmuebles = $inmuebles->where('id_user', Auth::id())->where('tipo_oferta', $tipo_oferta)->where('active', $active)->with('imagenes')
            ->get();
        $titulo = "Inmuebles" . ($tipo_oferta == Inmuebles::TIPO_OFERTA_VENTA ? " en Venta" : " en Arriendo") . ($active == 1 ? " publicados" : " eliminados");

        return response()->view('inmuebles.ver', compact('inmuebles', 'titulo'));
    }

    public function vencidos()
    {
        $inmuebles = Inmuebles::where('dias_restantes', '<=', 5)->where('dias_restantes', '>', 0)->with('imagenes')->get();
        $titulo = 'Inmuebles a vencer';
        return view('inmuebles.ver', compact('inmuebles', 'titulo'));
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'btnradio' => 'required|string',
            'tipo_propiedad' => 'nullable|integer',
            'rango_precio' => 'nullable|integer',
            'direccion' => 'nullable|string',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
        ]);

        $tipo_oferta = $request->input('btnradio');
        $tipo_propiedad = $request->input('tipo_propiedad');
        $rango_precio = $request->input('rango_precio');
        $latitud = $request->input('latitud');
        $longitud = $request->input('longitud');

        $inmuebles = Inmuebles::when($tipo_oferta, function ($query, $tipo_oferta) {
            return $query->where('tipo_oferta', $tipo_oferta);
        })
            ->when($tipo_propiedad, function ($query, $tipo_propiedad) {
                return $query->where('tipo_inmueble', $tipo_propiedad);
            })
            ->when($rango_precio, function ($query, $rango_precio) {
                return $query->where('valor_arriendo_venta', '<=', $rango_precio);
            })
            ->when($latitud && $longitud, function ($query) use ($latitud, $longitud) {
                return $query->nearLocation($latitud, $longitud, 5);
            })
            ->where('active', 1)
            ->where('dias_restantes', '>', 0)
            ->get();

        return view('inmuebles.resultados_inmuebles', compact('inmuebles'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inmuebles  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function ver_inmueble($id): Response
    {
        $inmueble = Auth::check()
            ? Inmuebles::where('id_user', Auth::id())->where('id', $id)->first()
            : Inmuebles::with('user')->find($id);

        if ($inmueble == null) {
            $inmueble = Inmuebles::with('user')->find($id);
        }

        $inmuebles_relacionados = Inmuebles::where('id', '!=', $inmueble->id)
            ->where('active', 1)
            ->where('dias_restantes', '>', 0)
            ->where(function ($query) use ($inmueble) {
                $query->where('valor_arriendo_venta', '>=', $inmueble->valor_arriendo_venta * 0.9)
                    ->where('valor_arriendo_venta', '<=', $inmueble->valor_arriendo_venta * 1.1);

                $query->orWhere('estrato', $inmueble->estrato)
                    ->orWhere('num_pisos', $inmueble->num_pisos)
                    ->orWhere('num_habitaciones', $inmueble->num_habitaciones)
                    ->orWhere('num_banos', $inmueble->num_banos);
            })
            ->with('user')
            ->inRandomOrder()
            ->take(3)
            ->get();

        $mostrar_observacion = Auth::check() && Auth::id() != $inmueble->id_user
            && Auth::user()->super_admin == 1;

        return response()->view('inmuebles.ver_inmueble', compact('inmueble', 'id', 'inmuebles_relacionados', 'mostrar_observacion'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inmuebles  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function edit(Inmuebles $inmueble, $id): Response
    {
        $inmueble = $inmueble->where('id_user', Auth::id())->where('id', $id)->with('imagenes')->first();
        $entidad = Entidad::with('divipos_municipios')->first();
        $latitud = Inmuebles::LATITUD;
        $longitud = Inmuebles::LONGITUD;
        $tiposInmuebles = Inmuebles::getTiposInmuebles();


        return response()->view('inmuebles.editar', compact('inmueble', 'id', 'latitud', 'longitud', 'entidad', 'tiposInmuebles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inmuebles  $inmueble
     */
    public function update(Request $request, Inmuebles $inmueble, $id_inmueble)
    {
        try {
            DB::beginTransaction();

            $inmueble = $inmueble->where('id_user', Auth::id())->where('id', $id_inmueble)->with('imagenes')->first();


            $inmueble->fill($request->all());
            $inmueble->valor_incluye_administracion = $request->has('valor_incluye_administracion') ? $request->input('valor_incluye_administracion') : 0;

            if ($inmueble->estado == Inmuebles::ESTADO_NO_APROBADO) {
                $inmueble->estado = Inmuebles::ESTADO_PENDIENTE;
            }

            $inmueble->save();

            $mensaje =  $this->ActualizarImagenes($inmueble, $request);

            if ($mensaje['status'] == false) {
                DB::rollBack();
                return redirect()->route('inmuebles.edit', $id_inmueble)->with('error', $mensaje['message']);
            }

            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Inmueble actualizado exitosamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('inmuebles.edit', $id_inmueble)->with('error', $th->getMessage());
        }
    }

    private function ActualizarImagenes(Inmuebles $inmueble, Request $request)
    {
        try {
            if ($request->has('images')) {
                foreach ($inmueble->imagenes()->where('portada', 0)->get() as $imagen) {
                    Storage::disk('public')->delete($imagen->ruta_imagen);
                    $imagen->delete();
                }

                foreach ($request->file('images') as $image) {
                    $path = $image->store('images', 'public');
                    $inmueble->imagenes()->create([
                        'ruta_imagen' => $path,
                        'portada' => 0,
                    ]);
                }
            }

            if ($request->has('portada')) {
                $imagenPortada = $inmueble->imagenes()->where('portada', 1)->first();
                if ($imagenPortada) {
                    Storage::disk('public')->delete($imagenPortada->ruta_imagen);
                    $imagenPortada->delete();
                }
                $path = $request->file('portada')->store('images', 'public');
                $inmueble->imagenes()->create([
                    'ruta_imagen' => $path,
                    'portada' => 1,
                ]);
            }

            return ["status" => true, "message" => "Se agregaron correctamente las imágenes del inmueble"];
        } catch (\Throwable $th) {
            return ["error" => $th->getMessage(), "status" => false, "message" => "No se pudieron agregar las imágenes del inmueble: " . $th->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inmuebles  $inmueble
     */
    public function delete(Inmuebles $inmueble, $id_inmueble)
    {
        $inmueble = $inmueble->where('id_user', Auth::id())
            ->where('id', $id_inmueble)
            ->first();

        if (!$inmueble) {
            return redirect()->back()->with('error', 'Inmueble no encontrado.');
        }

        if ($inmueble->dias_restantes == 0) {

            return redirect()->route('inmuebles.show', ['tipo_oferta' => $inmueble->tipo_oferta, 'active' => $inmueble->active])
                ->with('error', 'No se puede activar o desactivar el inmueble, debe crear una nueva oferta para el inmueble.');
        }

        $inmueble->active = $inmueble->active == 1 ? 0 : 1;

        $mensaje = $inmueble->active ? 'activado' : 'desactivado';

        try {
            $inmueble->save();

            return redirect()->route('inmuebles.show', ['tipo_oferta' => $inmueble->tipo_oferta, 'active' => $inmueble->active])
                ->with('success', "Inmueble $mensaje exitosamente.");
        } catch (\Throwable $th) {

            return redirect()->route('inmuebles.show', ['tipo_oferta' => $inmueble->tipo_oferta, 'active' => $inmueble->active])
                ->with('error', "No se pudo modificar el estado del inmueble: " . $th->getMessage());
        }
    }

    public function reactivar(Inmuebles $inmueble, $id_inmueble)
    {
        $inmueble = $inmueble->where('id_user', Auth::id())->where("id", $id_inmueble)->first();
        $inmueble->dias_restantes = 40;
        $inmueble->save();

        return redirect()->route('dashboard')->with('success', 'Inmueble reactivado exitosamente');
    }

    public function enviar_correo_prueba()
    {
        $body_correo_predefinido = "Para restablecer su contraseña, haga clic en el siguiente enlace:";

        $entidad = Entidad::first();

        $data_mail = (object)[
            'remitente' => $entidad->remitente,
            'email_e' => 'juanescasa24@gmail.com',
            'bcc' => $entidad->bcc,
            'asunto' => 'Restablecimiento de Contraseña',
            'cuerpo' => $body_correo_predefinido
        ];

        $client = new Client();
        $client->request('POST', 'http://localhost:3001/email', [
            'json' => [
                'remitente' => $data_mail->remitente,
                'to' => $data_mail->email_e,
                'bcc' => $data_mail->bcc,
                'asunto' => $data_mail->asunto,
                'cuerpo' => $data_mail->cuerpo,
                'files' => []
            ]
        ]);

        echo "Enviado";
    }

    public function updateDiasRestantes()
    {
        $inmuebles = Inmuebles::all();
        $notificaciones = [];

        foreach ($inmuebles as $inmueble) {
            if ($inmueble->dias_restantes > 0) {
                $inmueble->dias_restantes -= 1;
                $inmueble->save();

                if ($inmueble->dias_restantes == 5) {
                    Notification::send(User::all(), new InmueblesPorVencerNotification($inmueble));
                    $notificaciones[] = 'El inmueble ' . $inmueble->nombre . ' está a punto de vencer en 5 días.';
                }
            }
        }

        if (!empty($notificaciones)) {
            session()->flash('notificaciones', $notificaciones);
        }

        return response()->json(['message' => 'Días restantes actualizados y notificaciones enviadas.']);
    }
}
