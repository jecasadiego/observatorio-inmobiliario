<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatoEmail extends Model
{
    use HasFactory;

    protected $table = 'formatoemail';

    protected $fillable = [
        'nombre',
        'descripcion',
        'sigla',
        'active',
    ];
}
