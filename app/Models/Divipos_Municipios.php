<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divipos_Municipios extends Model
{
    use HasFactory;

    protected $table = 'divipos_municipios';

    protected $fillable = [
        'id_departamento',
        'divipo',
        'nombre_municipio',
        'active',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

    public function entidad()
    {
        return $this->hasOne(Entidad::class, 'id_divipos_municipios');
    }
}
