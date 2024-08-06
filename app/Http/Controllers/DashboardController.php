<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inmuebles;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $inmuebles = Inmuebles::all();
        $user = Auth::user();

        $inmueblesVentaActivos = $inmuebles->where('tipo_oferta', Inmuebles::TIPO_OFERTA_VENTA)->where('id_user', Auth::id())->where('active', 1);
        $inmueblesVentaInactivos = $inmuebles->where('tipo_oferta', Inmuebles::TIPO_OFERTA_VENTA)->where('id_user', Auth::id())->where('active', 0);
        $inmueblesArriendoActivos = $inmuebles->where('tipo_oferta', Inmuebles::TIPO_OFERTA_ARRIENDO)->where('id_user', Auth::id())->where('active', 1);
        $inmueblesArriendoInactivos = $inmuebles->where('tipo_oferta', Inmuebles::TIPO_OFERTA_ARRIENDO)->where('id_user', Auth::id())->where('active', 0);
        $inmueblesAVencer = $inmuebles = Inmuebles::where('dias_restantes', '<=', 5)->where('dias_restantes', '>', 0)->with('imagenes')->get();;
        return view('dashboard', compact('inmueblesVentaActivos', 'inmueblesVentaInactivos', 'inmueblesArriendoActivos', 'inmueblesArriendoInactivos', 'inmueblesAVencer',  'user'));
    }
}
