@extends('layouts.invitado2')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('content')
    {{-- banner --}}
    <div class="container">
        <div class="banner-container mt-5 p-0" style="background-image: url({{ asset('img/banner-1.png') }})">
            <div class="banner-overlay">
                <a href="{{ route('login') }}" class="btn banner-button fw-semibold">Publica tu inmueble</a>
                <h1 class="banner-text text-white text-uppercase">Publicación de ofertas</h1>
            </div>
        </div>
    </div>
    {{-- buscador --}}
    <div class="container">
        <form action="{{ route('inmuebles.buscar') }}" method="post">
            @csrf
            <div class="row mt-5 pt-3 justify-content-center">
                <div class="col-auto">
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradio" id="rentBtn" value="2"
                            autocomplete="off" checked>
                        <label class="btn btn-outline-success position-relative" for="rentBtn">Arriendo
                            <svg width="1em" height="1em" viewBox="0 0 16 16"
                                class="position-absolute top-100 start-50 translate-middle mt-1" fill="var(--bs-success)"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </label>

                        <input type="radio" class="btn-check" name="btnradio" id="saleBtn" value="1"
                            autocomplete="off">
                        <label class="btn btn-outline-success" for="saleBtn">Venta
                            <svg width="1em" height="1em" viewBox="0 0 16 16"
                                class="position-absolute top-100 start-50 translate-middle mt-1" fill="var(--bs-success)"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </label>
                    </div>
                </div>
            </div>
            <div class="container mt-4">
                <div class="row justify-content-center align-items-center bg-white py-4"
                    style="box-shadow: 0px -6px 46px 0px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                    <div class="col-12 col-md-3 mt-3 md-mt-0 border-start">
                        <b style="color: #2C3A61">Dirección</b>
                        <input type="text" class="form-control mt-2" name="direccion" id="direccion"
                            placeholder="Dirección del inmueble">
                    </div>
                    <div class="col-1 col-md-1 mt-5 ">
                        <button type="button" class="btn bg-verde" data-bs-toggle="modal" data-bs-target="#mapModal">
                            <i class="fas fa-map text-white"></i>
                        </button>
                    </div>
                    <input type="hidden" name="latitud" id="latitud">
                    <input type="hidden" name="longitud" id="longitud">
                    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mapModalLabel">Seleccionar Ubicación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="map" style="height: 400px;"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-verde text-white" data-bs-dismiss="modal">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mt-3 md-mt-0 border-start">
                        <b style="color: #2C3A61">Tipo De Propiedad</b>
                        <select class="mt-2 form-select" name="tipo_propiedad">
                            <option selected value="">-- Seleccionar --</option>
                            @foreach ($tiposInmuebles as $key => $tipo)
                                <option value="{{ $key }}">{{ $tipo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mt-3 md-mt-0 border-start border-start">
                        <b style="color: #2C3A61">Rango</b>
                        <div class="mt-2">
                            <input type="text" id="priceValue" class="form-control mt-2" readonly>
                            <input type="range" class="form-range" id="priceRange" name="rango_precio" min="0"
                                max="600000000" step="1000000" value="0" oninput="updatePriceValue(this.value)">
                        </div>
                    </div>
                    <div class="col-12 col-md-auto mt-3 md-mt-0">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- mejores ofertas --}}
    <div class="mt-5 pt-3 pb-5" style="background: linear-gradient(to top, #05af65 60%, transparent 40%);">
        <h2 class="text-center mb-5">¡Encuentra las mejores ofertas inmobiliarias!</h2>
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="h-100 bg-white"
                        style="box-shadow: 0px -6px 46px 0px rgba(0, 0, 0, 0.1); border-radius: 20px;">
                        <div class="text-center px-5 pb-5 pt-3">
                            <img src="{{ asset('img/casa_en_venta.png') }}" alt="Casas en venta">
                            <h5 class="card-title">Inmuebles en venta</h5>
                            <p class="card-text">Descubre una variedad de casas en venta en Yopal. Encuentra tu hogar ideal
                                entre nuestros opciones disponibles que se adaptan a tus necesidades.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="h-100 bg-white"
                        style="box-shadow: 0px -6px 46px 0px rgba(0, 0, 0, 0.1); border-radius: 20px;">
                        <div class="text-center px-5 pb-5 pt-3">
                            <img src="{{ asset('img/casa_en_arriendo.png') }}" alt="Casas en venta">
                            <h5 class="card-title">Inmuebles en arriendo</h5>
                            <p class="card-text">Explora un amplio gama de casas en arriendo en Yopal. Encuentra el lugar
                                perfecto para vivir con opciones que se ajustan a tu presupuesto.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="h-100 bg-white"
                        style="box-shadow: 0px -6px 46px 0px rgba(0, 0, 0, 0.1); border-radius: 20px;">
                        <div class="text-center px-5 pb-5 pt-3">
                            <img src="{{ asset('img/terrenos_en_venta.png') }}" alt="Casas en venta">
                            <h5 class="card-title">Terrenos en venta</h5>
                            <p class="card-text">Descubre terrenos disponibles en Yopal para construir la casa de tus
                                sueños
                                o
                                invertir en proyectos inmobiliarios.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ultimas ofertas --}}
    <div class="my-5 py-3">
        <h2 class="text-center mb-5">Ultimas ofertas subidas</h2>
        <div class="container">
            <div class="row">
                @foreach ($inmuebles as $inmueble)
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('inmuebles.ver_inmueble', $inmueble->id) }}" class="text-decoration-none">
                            <div class="card border-0 bg-white"
                                style="box-shadow: 0px -6px 46px 0px rgba(0, 0, 0, 0.1); border-radius: 10px;">

                                <img src="{{ $inmueble->first_image_url }}" class="card-img-top"
                                    alt="Imagen de propiedad"
                                    style="min-height: 250px; max-height: 250px; object-fit: cover;">
                                <span class="etiqueta fw-semibold"
                                    style="{{ $inmueble->tipo_oferta == \App\Models\Inmuebles::TIPO_OFERTA_ARRIENDO ? 'background-color: #0572AF;' : '' }}">
                                    {{ $inmueble->tipo_oferta_descripcion }}
                                </span>
                                <div class="card-body">
                                    <h5 class="mb-3 gris text-truncate">{{ $inmueble->direccion }},
                                        {{ $inmueble->ciudad }},
                                        {{ $inmueble->barrio }} {{ $inmueble->nombre_inmueble }}</h5>
                                    <h5 class="mb-3 verde text-truncate">
                                        ${{ $inmueble->valor_arriendo_venta_formatted }} COP
                                    </h5>
                                    <p class="fw-semibold mb-0">
                                        <span>
                                            <img src="{{ asset('img/bethroom.png') }}" alt="Icono de habitaciones"
                                                class="icon">
                                            {{ $inmueble->num_habitaciones }}
                                        </span>&nbsp;
                                        <span>
                                            <img src="{{ asset('img/Bathtub.png') }}" alt="Icono de habitaciones"
                                                class="icon">
                                            {{ $inmueble->num_banos }}
                                        </span>&nbsp;
                                        <span>
                                            <img src="{{ asset('img/ArrowsOut.png') }}" alt="Icono de habitaciones"
                                                class="icon">
                                            {{ $inmueble->area_construida }} m²
                                        </span>
                                    </p>
                                </div>
                                <div class="container pb-3">
                                    <div class="row justify-content-between">
                                        <div class="col-12">
                                            <hr class="mt-0">
                                        </div>
                                        <div class="col-auto fw-semibold">
                                            @php
                                                $user = $inmueble->user;
                                            @endphp
                                            <img src="{{ $user->profile_photo_url ? asset($user->profile_photo_url) : asset('img/default-perfil.jpg') }}"
                                                alt="Icono de habitaciones"
                                                style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%">
                                            {{ $user->name }}
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-share p-0">
                                                <img src="{{ asset('img/share.svg') }}" width="25"
                                                    alt="Icono de compartir" class="icon-share">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIAUCYmZiIWPbmTabytupLueRjFNmDHUc&libraries=places&callback=initMap"
        async defer></script>

    <script>
        var marker; // Variable para el marcador
        var latitud = {{$latitud}}
        var longitud = {{($longitud)}}

        function initMap() {
            var yopal = {
                lat: parseFloat(latitud),
                lng: parseFloat(longitud)
            };
            var mapOptions = {
                zoom: 12,
                center: yopal,
                mapTypeId: 'terrain',
                mapTypeControl: false,
                scrollwheel: true,
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var geocoder = new google.maps.Geocoder();

            var input = document.getElementById('direccion');
            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: {
                    country: 'co'
                }
            });

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    console.log("No details available for input: '" + place.name + "'");
                    return;
                }

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                updateHiddenInputs(place.geometry.location.lat(), place.geometry.location.lng());
                placeMarker(place.geometry.location, map);
            });

            map.addListener('click', function(event) {
                geocoder.geocode({
                    'location': event.latLng
                }, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            map.setCenter(event.latLng); // Centra el mapa en la ubicación del clic
                            map.setZoom(17); // Realiza el zoom después de centrar el mapa
                            updateHiddenInputs(event.latLng.lat(), event.latLng.lng());
                            input.value = results[0].formatted_address;
                            placeMarker(event.latLng, map);
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
            });
        }

        function updateHiddenInputs(lat, lng) {
            document.getElementById('latitud').value = lat;
            document.getElementById('longitud').value = lng;
        }

        function placeMarker(location, map) {
            if (marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
        }
    </script>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        updatePriceValue(document.getElementById('priceRange').value);
    });

    function updatePriceValue(value) {
        document.getElementById('priceValue').value = new Intl.NumberFormat().format(value);
    }
</script>
