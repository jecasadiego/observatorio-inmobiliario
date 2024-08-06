<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Entidad;
use Illuminate\Http\Request;
use App\Models\FormatoEmail;
use App\Models\User;
use App\Models\Inmuebles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class SuperAdminController extends Controller
{

    public function index()
    {
        return view('superadmin.index');
    }

    public function entidad()
    {
        $entidad = Entidad::first();
        return view('superadmin.entidad.entidad', compact('entidad'));
    }

    public function entidad_update(Request $request)
    {
        try {
            $entidad = Entidad::first();
            if (!$entidad) {
                $entidad = new Entidad();
            }
            $entidad->nombre = $request->input('nombre');
            $entidad->nombre_oficina = $request->input('nombre_oficina');
            $entidad->remitente = $request->input('remitente');
            $entidad->url_entidad = $request->input('url_entidad');
            $entidad->url_observatorio = $request->input('url_observatorio');
            $entidad->url_app = $request->input('url_app');
            $entidad->direccion = $request->input('direccion');
            $entidad->email_noti_judiciales = $request->input('email_noti_judiciales');
            $entidad->email_atencion_usuarios = $request->input('email_atencion_usuarios');
            $entidad->barrio = $request->input('barrio');
            $entidad->descripcion = $request->input('descripcion');
            $entidad->descripcion_horario = $request->input('descripcion_horario');

            $entidad->save();
            return redirect()->route('superadmin.index')->with('success', 'Entidad actualizada con exito');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.index')->with('error', $e->getMessage());
        }
    }
    public function formatos_email()
    {
        $formatos = FormatoEmail::all();
        return view('superadmin.formatos_email.formatosemail', compact('formatos'));
    }

    public function formatos_email_create()
    {
        return view('superadmin.formatos_email.formatosemail_create');
    }

    public function formatos_email_store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'active' => 'required|integer',
        ]);

        FormatoEmail::create($request->all());

        return redirect()->route('superadmin.formatos_email')->with('success', 'Formato creado exitosamente.');
    }

    public function formatos_email_edit(FormatoEmail $formato)
    {
        return view('superadmin.formatos_email.formatosemail_edit', compact('formato'));
    }

    public function formatos_email_update(Request $request, FormatoEmail $formato)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'active' => 'required|integer',
        ]);

        $formato->update($request->all());

        return redirect()->route('superadmin.formatos_email')->with('success', 'Formato actualizado exitosamente.');
    }

    public function formatos_email_destroy(FormatoEmail $formato)
    {
        $formato->update(['active' => 0]);

        return redirect()->route('superadmin.formatos_email')->with('success', 'Formato desactivado exitosamente.');
    }

    public function usuarios()
    {
        $users = User::all();
        $usersPendientes = User::where('estado', 0)->count();
        return view('superadmin.usuarios.usuarios', compact('users', 'usersPendientes'));
    }

    public function usuarios_pendientes()
    {
        $users = User::where('estado', 0)->get();
        return view('superadmin.usuarios.usuarios_pendientes', compact('users'));
    }

    public function AprobarUsuario(Request $request, User $user)
    {
        $user->update(['estado' => $request->aprobado]);

        $mensaje = $user->estado == 1 ? 'Usuario aprobado exitosamente.' : 'Usuario rechazado exitosamente.';

        return redirect()->route('superadmin.usuarios')->with('success', $mensaje);
    }

    public function usuarios_create()
    {
        return view('superadmin.usuarios.crear');
    }

    public function usuarios_store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'tipo_documento' => 'required|string|max:255',
                'nro_documento' => 'required|string|max:255',
                'direccion' => 'required|string|max:255',
                'telefono' => 'required|string|max:20',
                'password' => ['required', Password::defaults()],
                'superadmin' => 'required|boolean',
                'cedula_pdf' => 'nullable|file|mimes:pdf|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->route('superadmin.usuarios')->with('error', $validator->errors()->first());
            }

            if ($request->hasFile('cedula_pdf')) {
                $path = $request->file('cedula_pdf')->store('cedula_pdfs', 'public');
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'super_admin' => $request->superadmin,
                'tipo_documento' => $request->tipo_documento,
                'nro_documento' => $request->nro_documento,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'password' => Hash::make($request->password),
                'url_documento' => $path ?? null,
            ]);


            return redirect()->route('superadmin.usuarios')->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.usuarios')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function usuarios_edit($id)
    {
        $user = User::findOrFail($id);
        return view('superadmin.usuarios.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function usuarios_update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'tipo_documento' => 'required|string|max:255',
            'nro_documento' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'password' => ['nullable', Password::defaults()],
            'superadmin' => 'required|boolean',
            'cedula_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'tipo_documento' => $request->tipo_documento,
            'nro_documento' => $request->nro_documento,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'super_admin' => $request->superadmin,
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        if ($request->hasFile('cedula_pdf')) {
            if ($user->url_documento) {
                Storage::disk('public')->delete($user->url_documento);
            }

            $path = $request->file('cedula_pdf')->store('cedula_pdfs', 'public');
            $user->url_documento = $path;
            $user->save();
        }

        return redirect()->route('superadmin.usuarios')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function inmuebles_show()
    {

        $inmuebles = Inmuebles::all();
        $inmueblesPendientes = Inmuebles::where('estado', 2)
        ->count();

        
        return view('superadmin.inmuebles.ver', compact('inmuebles', 'inmueblesPendientes'));
    }

    public function EnviarObservacion(Request $request, Inmuebles $inmueble)
    {
        $this->handleObservacion($request, $inmueble, 'addObservacion');

        return redirect()->route('superadmin.inmuebles_show')->with('success', 'Observación creada exitosamente.');
    }

    public function EditarObservacion(Request $request, Inmuebles $inmueble)
    {
        $this->handleObservacion($request, $inmueble, 'editObservacion');

        return redirect()->route('superadmin.inmuebles_show')->with('success', 'Edición realizada exitosamente.');
    }

    public function DeleteObservacion(Inmuebles $inmueble)
    {
        if (Auth::user()->super_admin != 1) {
            return redirect()->route('superadmin.inmuebles_show')->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $inmueble->deleteObservacion();

        return redirect()->route('superadmin.inmuebles_show')->with('success', 'Observación eliminada exitosamente.');
    }

    private function handleObservacion(Request $request, Inmuebles $inmueble, $method)
    {
        if (Auth::user()->super_admin != 1) {
            return redirect()->route('superadmin.inmuebles_show')->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $request->validate([
            'observacion' => 'required|string',
        ]);

        $inmueble->$method($request->observacion, auth()->id());
    }

    public function inmuebles_pendientes_show()
    {
        $inmueblesPendientes = Inmuebles::where('estado', 2)->get();
        return view('superadmin.inmuebles.inmuebles_pendientes', compact('inmueblesPendientes'));
    }

    public function AprobarInmueble(Inmuebles $inmueble)
    {
        $inmueble->aprobar();
        return redirect()->route('superadmin.inmuebles_show')->with('success', 'Inmueble aprobado exitosamente.');
    }

    public function RechazarInmueble(Inmuebles $inmueble)
    {
        $inmueble->rechazar();
        return redirect()->route('superadmin.inmuebles_show')->with('success', 'Inmueble rechazado exitosamente.');
    }

    public function exportarCSVConEstructura()
    {
        return Inmuebles::exportarCSVConEstructura();
    }
}
