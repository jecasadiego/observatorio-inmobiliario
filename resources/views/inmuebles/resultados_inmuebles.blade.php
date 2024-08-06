@guest
    @extends('layouts.invitado2')

    @section('content')
        <div class="container">
            <x-regresar route="home" />
            <x-header>
                <x-slot name="texto">Busqueda inmuebles</x-slot>
            </x-header>
        </div>
        <div class="container mt-5">
            <div class="row">
                @foreach ($inmuebles as $inmueble)
                    <div class="col-md-4 col-sm-12">
                        <x-inmuebles_card image="{{ $inmueble->first_image_url }}" id="{{ $inmueble->id }}"
                            titulo="{{ $inmueble->nombre_inmueble }}" precio="{{ $inmueble->valor_arriendo_venta_formatted }}"
                            habitaciones="{{ $inmueble->num_habitaciones }}" sanitarios="{{ $inmueble->num_banos }}"
                            area="{{ $inmueble->area_construida }}" />
                    </div>
                @endforeach

            </div>
        </div>
    @endsection
@endguest

@auth
    <x-app-layout>
        <div class="container">
            <x-regresar route="home" />
            <x-header>
                <x-slot name="texto">Busqueda inmuebles</x-slot>
            </x-header>
        </div>
        <div class="container mt-5">
            <div class="row">
                @foreach ($inmuebles as $inmueble)
                    <div class="col-md-4 col-sm-12">
                        <x-inmuebles_card image="{{ $inmueble->first_image_url }}" id="{{ $inmueble->id }}"
                            titulo="{{ $inmueble->nombre_inmueble }}"
                            precio="{{ $inmueble->valor_arriendo_venta_formatted }}"
                            habitaciones="{{ $inmueble->num_habitaciones }}" sanitarios="{{ $inmueble->num_banos }}"
                            area="{{ $inmueble->area_construida }}" />
                    </div>
                @endforeach

            </div>
        </div>
        </div>
    </x-app-layout>
@endauth
