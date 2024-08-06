<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamento';

    protected $fillable = [
        'codigo',
        'nombre_departamento',
        'active',
    ];

    public function municipios()
    {
        return $this->hasMany(Divipos_Municipios::class, 'id_departamento');
    }
}
