<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenInmueble extends Model
{
    use HasFactory;

    protected $table = 'imagenes_inmuebles';

    protected $fillable = [
        'id_inmueble',
        'ruta_imagen',
        'portada',
    ];

    /**
     * Get the inmueble that owns the image.
     */
    public function inmueble()
    {
        return $this->belongsTo(Inmuebles::class);
    }
}
