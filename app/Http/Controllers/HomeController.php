<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImagenInmueble;
use App\Models\Inmuebles;
use App\Models\Entidad;

class HomeController extends Controller
{
    public function index()
    {
        $inmuebles = Inmuebles::with(['user'])
            ->where('active', 1)
            ->latest()
            ->take(3)
            ->get();
        

        $tiposInmuebles = Inmuebles::getTiposInmuebles();

        $latitud = Inmuebles::LATITUD;
        $longitud = Inmuebles::LONGITUD;


        return view('welcome', compact('inmuebles', 'tiposInmuebles', 'latitud', 'longitud'));
    }

    public function nosotros(){
        $entidad = Entidad::first();
        return view('nosotros', compact('entidad'));
    }
}
