<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;

    protected $table = 'entidad';

    protected $fillable = [
        'id_divipos_municipios',
        'url_entidad',
        'url_observatorio',
        'url_app',
        'remitente',
        'bcc',
        'email_noti_judiciales',
        'email_atencion_usuarios',
        'nombre',
        'nombre_oficina',
        'direccion',
        'barrio',
        'descripcion',
        'descripcion_horario',
        'imagen_logo',
        'ruta_logo',
        'imagen_header',
        'nombre_header',
        'imagen_footer',
        'nombre_footer',
        'active',
    ];

    public function divipos_municipios()
    {
        return $this->belongsTo(Divipos_Municipios::class, 'id_divipos_municipios');
    }
}
