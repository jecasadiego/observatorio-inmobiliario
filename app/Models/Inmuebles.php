<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;
use App\Models\Entidad;



class Inmuebles extends Model
{
    //CONSTANTES
    const TIPO_OFERTA_VENTA = 1;
    const TIPO_OFERTA_ARRIENDO = 2;
    const TIPO_INMUEBLE_APARTAMENTO = 1;
    const TIPO_INMUEBLE_CASA = 2;

    const TIPO_INMUEBLE_OFICINA = 3;
    const TIPO_ECONOMICO_COMERCIAL = 1;
    const TIPO_ECONOMICO_HABITACIONAL = 2;
    const TIPO_ECONOMICO_OFICINAS = 3;
    const TIPO_ECONOMICO_GENERAL = 4;

    const ESTADO_PUBLICADO = 1;
    const ESTADO_PENDIENTE = 2;
    const ESTADO_NO_APROBADO = 3;

    const LATITUD = 5.33775;
    const LONGITUD = -72.39456;

    //FIN CONSTANTES

    use HasFactory;

    protected $table = 'inmuebles';

    protected $fillable = [
        'id_user',
        'nombre_inmueble',
        'destino_economico',
        'tipo_oferta',
        'tipo_inmueble',
        'direccion',
        'ciudad',
        'barrio',
        'descripcion',
        'dias_restantes',
        'latitud',
        'longitud',
        'estrato',
        'area_construida',
        'num_pisos',
        'num_habitaciones',
        'num_banos',
        'garajes',
        'valor_arriendo_venta',
        'valor_administracion',
        'valor_incluye_administracion',
        'nombres',
        'apellidos',
        'celular',
        'correo',
        'contacto_whatsapp',
        'politica_datos',
        'observacion',
    ];

    public function setValorIncluyeAdministracionAttribute($value)
    {
        $this->attributes['valor_incluye_administracion'] = $value === 'on' ? true : false;
    }

    /**
     * Set the contacto_whatsapp attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setContactoWhatsappAttribute($value)
    {
        $this->attributes['contacto_whatsapp'] = $value === 'on' ? true : false;
    }

    /**
     * Set the politica_datos attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setPoliticaDatosAttribute($value)
    {
        $this->attributes['politica_datos'] = $value === 'on' ? true : false;
    }

    /**
     * Get the user that owns the inmueble.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function observacionUser()
    {
        return $this->belongsTo(User::class, 'id_superadmin_observacion');
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenInmueble::class, 'id_inmueble');
    }

    public function portada()
    {
        return $this->hasOne(ImagenInmueble::class, 'id_inmueble')->where('portada', 1);
    }

    public function getTipoOfertaDescripcionAttribute()
    {
        $tipos = [
            self::TIPO_OFERTA_VENTA => 'Venta',
            self::TIPO_OFERTA_ARRIENDO => 'Arriendo',
        ];

        return $tipos[$this->tipo_oferta] ?? 'Desconocido';
    }

    public function getTipoInmuebleDescripcionAttribute()
    {
        $tipos = [
            self::TIPO_INMUEBLE_APARTAMENTO => 'Apartamento',
            self::TIPO_INMUEBLE_CASA => 'Casa',
            self::TIPO_INMUEBLE_OFICINA => 'Oficina',
        ];

        return $tipos[$this->tipo_inmueble] ?? 'Desconocido';
    }

    public function getTipoEconomicoDescripcionAttribute()
    {
        $tipos = [
            self::TIPO_ECONOMICO_COMERCIAL => 'Comercial',
            self::TIPO_ECONOMICO_HABITACIONAL => 'Habitacional',
            self::TIPO_ECONOMICO_OFICINAS => 'Oficinas',
            self::TIPO_ECONOMICO_GENERAL => 'General',
        ];

        return $tipos[$this->destino_economico] ?? 'Desconocido';
    }


    public function getValorArriendoVentaFormattedAttribute()
    {
        return number_format($this->attributes['valor_arriendo_venta'], 0, '.', ',');
    }

    public function getValorAdministracionVentaFormattedAttribute()
    {
        return number_format($this->attributes['valor_administracion'], 0, '.', ',');
    }


    public function getFirstImageUrlAttribute()
    {
        $firstImage = $this->imagenes()->where('portada', 1)->first();
        return $firstImage ? asset('storage/' . $firstImage->ruta_imagen) : 'img/default-perfil.jpg';
    }

    public function getImagesUrlAttribute()
    {
        $images = $this->imagenes()->where('portada', 0)->get();
        foreach ($images as $image) {
            $urls[] = asset('storage/' . $image->ruta_imagen);
        }

        return $urls ?? ['img/default-perfil.jpg'];
    }

    public function guardarImagen($path, $esPortada = false)
    {
        $imagenInmueble = new ImagenInmueble([
            'portada' => $esPortada ? 1 : 0,
            'ruta_imagen' => $path,
            'id_inmueble' => $this->id,
        ]);
        $this->imagenes()->save($imagenInmueble);
    }

    public static function getTiposOferta()
    {
        return [
            self::TIPO_OFERTA_VENTA => 'Venta',
            self::TIPO_OFERTA_ARRIENDO => 'Arriendo',
        ];
    }
    public static function getTiposInmuebles()
    {
        return [
            self::TIPO_INMUEBLE_APARTAMENTO => 'Apartamento',
            self::TIPO_INMUEBLE_CASA => 'Casa',
            self::TIPO_INMUEBLE_OFICINA => 'Oficina',
        ];
    }

    public function scopeNearLocation($query, $lat, $lng, $distance = 5)
    {
        $haversine = "(6371 * acos(cos(radians($lat)) * cos(radians(latitud)) * cos(radians(longitud) - radians($lng)) + sin(radians($lat)) * sin(radians(latitud))))";
        return $query->whereRaw("$haversine < ?", [$distance]);
    }

    public function addObservacion($observacion, $userId)
    {
        $this->observacion = $observacion;
        $this->id_superadmin_observacion = $userId;
        $this->observacion_at = now();
        $this->active = 0;
        $this->estado = self::ESTADO_PENDIENTE;
        $this->save();
    }

    public function editObservacion($observacion, $userId)
    {
        $this->observacion = $observacion;
        $this->id_superadmin_observacion = $userId;
        $this->observacion_at = now();
        $this->save();
    }

    public function deleteObservacion()
    {
        $this->observacion = null;
        $this->id_superadmin_observacion = null;
        $this->observacion_at = null;
        $this->active = 1;
        $this->estado = self::ESTADO_PUBLICADO;
        $this->save();
    }

    public function cambiarEstado($nuevoEstado, $activo)
    {
        $this->estado = $nuevoEstado;
        $this->active = $activo;
        $this->save();
    }

    public function aprobar()
    {
        $this->cambiarEstado(self::ESTADO_PUBLICADO, 1);
        $this->observacion = null;
        $this->id_superadmin_observacion = null;
        $this->observacion_at = null;
        $this->save();
    }

    public function rechazar()
    {
        $this->cambiarEstado(self::ESTADO_NO_APROBADO, 0);
    }

    public static function exportarCSVConEstructura()
    {
        $fileName = 'inmuebles.csv';
        $inmuebles = self::all();
        $entidad = Entidad::first();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = [
            'Id', 'Propiedad1', 'Valor1', 'Propiedad2', 'Valor2', 'GeometriaTipo',
            'GeometriaLat1', 'GeometriaLng1', 'Propiedad3', 'Valor3',
            'Propiedad4', 'Valor4', 'Propiedad5', 'Valor5', 'Propiedad6',
            'Valor6', 'Propiedad7', 'Valor7', 'Propiedad8', 'Valor8',
            'Propiedad9', 'Valor9', 'Propiedad10', 'Valor10', 'Propiedad11',
            'Valor11', 'Propiedad12', 'Valor12', 'Propiedad13', 'Valor13', 'Propiedad14', 'Valor14', 'Propiedad15', 'Valor15'
        ];

        $callback = function () use ($inmuebles, $columns, $entidad) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            

            foreach ($inmuebles as $inmueble) {
                $row = [
                    $inmueble->id,
                    'TipoInmueble',
                    $inmueble->getTipoInmuebleDescripcionAttribute(),
                    'TipoOferta', $inmueble->getTipoOfertaDescripcionAttribute(),
                    'PUNTO',
                    $inmueble->latitud,
                    $inmueble->longitud,
                    'Valor',
                    $inmueble->valor_arriendo_venta,
                    'Barrio',
                    $inmueble->barrio,
                    'Direccion',
                    $inmueble->direccion,
                    'Estrato',
                    $inmueble->estrato,
                    'NumeroPisos',
                    $inmueble->num_pisos,
                    'Banos',
                    $inmueble->num_banos,
                    'Habitaciones',
                    $inmueble->num_habitaciones,
                    'Garaje',
                    $inmueble->garajes,
                    'Area',
                    $inmueble->area_construida . ' Mt2',
                    'Nombre',
                    $inmueble->nombres . ' ' . $inmueble->apellidos,
                    'Contacto',
                    $inmueble->celular,
                    'FechaPublicacion',
                    $inmueble->created_at->format('d/m/Y'),
                    'Link Inmueble',
                    $entidad->url_app.'ver_inmueble/'.$inmueble->id,
                ];

                fputcsv($file, $row);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
