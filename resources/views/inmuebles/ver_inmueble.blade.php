@if (Auth::check())
    <x-app-layout>
        <div class="container">
            <x-ver_inmueble_component :inmueble="$inmueble" :inmuebles_relacionados="$inmuebles_relacionados" :mostrar_observacion="$mostrar_observacion" />
        </div>
    </x-app-layout>
@else
    @extends('layouts.invitado2')

    @section('content')
        <div class="container">
            <x-ver_inmueble_component :inmueble="$inmueble" :inmuebles_relacionados="$inmuebles_relacionados" :mostrar_observacion="$mostrar_observacion" />
        </div>
    @endsection
@endif
