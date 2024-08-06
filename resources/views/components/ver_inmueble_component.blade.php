@props(['inmueble', 'inmuebles_relacionados', 'mostrar_observacion'])


<div class="row justify-content-between">
    <div class="col-auto">
        @auth
            <x-regresar route="inmuebles.show" :params="['tipo_oferta' => $inmueble->tipo_oferta, 'active' => $inmueble->active]"></x-regresar>
        @endauth
        @guest
            <x-regresar route="home"></x-regresar>
        @endguest
    </div>
    @auth
        @if (Auth::id() == $inmueble->id_user)
            <div class="col-auto d-flex align-items-center">

                <a class="btn bg-verde me-1 me-md-2 text-white p-2" href="{{ route('inmuebles.edit', $inmueble->id) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white"
                        class="bi bi-pencil-square pb-1 me-1 me-md-2" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                    </svg>Editar
                </a>
                @if ($inmueble->dias_restantes <= 5 && $inmueble->dias_restantes > 0)
                    <form action="{{ route('inmuebles.reactivar', $inmueble->id) }}" method="post">
                        @method('POST')
                        @csrf
                        <button type="submit" class="btn btn-primary text-white"
                            href="{{ route('inmuebles.reactivar', $inmueble->id) }}"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill"
                                viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>Reactivar
                        </button>
                    </form>
                @elseif($inmueble->dias_restantes == 0)
                    <h6 class="m-0 btn bg-danger text-white p-2" style="pointer-events: none;">Desactivado por inactividad
                    </h6>
                @else
                    <form action="{{ route('inmuebles.desactivar', $inmueble->id) }}" method="post">
                        @method('POST')
                        @csrf
                        @if ($inmueble->active == 0)
                            <button type="submit" class="btn btn-success" @if (
                                $inmueble->estado == App\Models\Inmuebles::ESTADO_PENDIENTE ||
                                    $inmueble->estado == App\Models\Inmuebles::ESTADO_NO_APROBADO) disabled @endif
                                href="{{ route('inmuebles.desactivar', $inmueble->id) }}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </svg>Activar</button>
                        @else
                            <button type="submit" class="btn btn-danger"
                                href="{{ route('inmuebles.desactivar', $inmueble->id) }}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>Desactivar</button>
                        @endif
                    </form>

                    @if (
                        $inmueble->estado == App\Models\Inmuebles::ESTADO_PENDIENTE ||
                            $inmueble->estado == App\Models\Inmuebles::ESTADO_NO_APROBADO)
                        <div class="ms-1 ms-md-2">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#verObservacion"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                </svg></button>

                        </div>
                        <div class="modal fade" id="verObservacion" aria-labelledby="verObservacionLabel" aria-hidden="true"
                            style="display: none;" aria-hidden="true" role="dialog" aria-modal="true" tabindex="-1"
                            data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="verObservacionLabel">Observación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $inmueble->observacion }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

            </div>
        @endif
        @if ($mostrar_observacion)
            <div class="col-auto d-flex align-items-center">
                @if (!$inmueble->observacion && !$inmueble->id_superadmin_observacion)
                    <button class="btn bg-verde text-white p-2 me-2" data-bs-toggle="modal"
                        data-bs-target="#modalObservacion">Crear observación</button>

                    <div class="modal fade" id="modalObservacion" aria-labelledby="modalObservacionLabel" aria-hidden="true"
                        style="display: none;" aria-hidden="true" role="dialog" aria-modal="true" tabindex="-1"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalObservacionLabel">Notificar observación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('superadmin.enviar_observacion', $inmueble) }}" method="post">
                                        @method('POST')
                                        @csrf
                                        <div class="form-group">
                                            <label for="observacion" class="form-label">Observación</label>
                                            <textarea class="form-control" id="observacion" name="observacion" rows="3" required
                                                style="height: 100px; resize: none;"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn bg-verde text-white">Notificar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($inmueble->id_superadmin_observacion == Auth::user()->id)
                    <button class="btn bg-verde  text-white" data-bs-toggle="modal"
                        data-bs-target="#modalObservacionEditar">Editar
                        observación</button>

                    <div class="modal fade" id="modalObservacionEditar" aria-labelledby="modalObservacionLabel"
                        aria-hidden="true" style="display: none;" aria-hidden="true" role="dialog" aria-modal="true"
                        tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalObservacionLabel">Editar observación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario para Editar Observación -->
                                    <form id="formEditarObservacion"
                                        action="{{ route('superadmin.editar_observacion', $inmueble) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label for="observacion" class="form-label">Observación</label>
                                            <textarea class="form-control" id="observacion" name="observacion" rows="3" required
                                                style="height: 100px; resize: none;">{{ $inmueble->observacion }}</textarea>
                                        </div>
                                    </form>
                                    <div class="modal-footer p-0 pt-3 mt-4 justify-content-between">
                                        <div class="col-auto m-0">
                                            <!-- Formulario para Eliminar Observación -->
                                            <form id="formEliminarObservacion"
                                                action="{{ route('superadmin.eliminar_observacion', $inmueble) }}"
                                                method="post">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-danger text-white">Borrar
                                                    observación</button>
                                            </form>
                                        </div>
                                        <div class="col-auto m-0">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" form="formEditarObservacion"
                                                class="btn bg-verde text-white">Editar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
            </div>
        @endif
    @endauth
</div>

<div class="row mt-4">
    <div class="col text-white">
        <div class="p-3 d-flex" style="background-color:#262626; border-radius: 10px">
            <div>
                <h3 class="m-0">{{ $inmueble->nombre_inmueble }}</h3>
                <p class="m-0">Destino Economico: {{ $inmueble->tipo_economico_descripcion }}</p>
                <p class="m-0">Tipo de Inmueble: {{ $inmueble->tipo_inmueble_descripcion }}</p>
                <p class="m-0">{{ $inmueble->direccion }}</p>
            </div>
            <div class="ms-auto align-self-center">
                <p class="m-0">${{ $inmueble->valor_arriendo_venta_formatted }} COP</p>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-between mt-4">
    <div class="col-md-8">
        <div class="rounded">
            <img id="mainImage" src="{{ asset($inmueble->first_image_url) }}" alt="Imagen de la inmueble"
                class="img-fluid w-100 rounded" style="height: 400px; object-fit: cover;">

        </div>
        <div class="row row-cols-4 mt-3">
            @foreach ($inmueble->images_url as $url)
                <div class="col">
                    <img src="{{ asset($url) }}" alt="Imagen de la inmueble" class="img-fluid w-100 rounded"
                        style="height: 100px; object-fit: cover; cursor: pointer;" onclick="swapImage(this)">
                </div>
            @endforeach
        </div>

        <div class="row mb-3">
            <div class="col mt-3">
                <div class="d-flex border rounded p-3">
                    <div class="border-end flex-fill">
                        <p class="m-0">Área construida</p>
                        <p class="m-0 fw-bold">{{ $inmueble->area_construida }}m²</p>
                    </div>
                    <div class="text-center border-end flex-fill">
                        <p class="m-0 fw-bold"><img src="{{ asset('img/bethroom.png') }}"
                                alt="Icono de habitaciones" class="icon me-2">{{ $inmueble->num_habitaciones }}</p>
                        <p class="m-0">Habitaciones</p>
                    </div>
                    <div class="text-center border-end flex-fill">
                        <p class="m-0 fw-bold"><img src="{{ asset('img/Bathtub.png') }}" alt="Icono de habitaciones"
                                class="icon me-2">{{ $inmueble->num_banos }}</p>
                        <p class="m-0">Baños</p>
                    </div>
                    <div class="text-center border-end flex-fill">
                        <p class="m-0 fw-bold"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#6D737A" class="bi bi-house-up icon me-2" viewBox="0 0 16 16">
                            <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708z"/>
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-5.854 1.5 1.5a.5.5 0 0 1-.708.708L13 11.707V14.5a.5.5 0 1 1-1 0v-2.793l-.646.647a.5.5 0 0 1-.708-.707l1.5-1.5a.5.5 0 0 1 .708 0Z"/>
                          </svg>{{ $inmueble->estrato }}</p>
                        <p class="m-0">Estrato</p>
                    </div>
                    <div class="text-center flex-fill">
                        <p class="m-0 fw-bold"> <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" width="20" height="20" class="icon me-2" fill="#6D737A">
                                <path
                                    d="M256 0C114.6 0 0 114.6 0 256V448c0 35.3 28.7 64 64 64h42.8c-6.6-5.9-10.8-14.4-10.8-24V376c0-20.8 11.3-38.9 28.1-48.6l21-64.7c7.5-23.1 29-38.7 53.3-38.7H313.6c24.3 0 45.8 15.6 53.3 38.7l21 64.7c16.8 9.7 28.2 27.8 28.2 48.6V488c0 9.6-4.2 18.1-10.8 24H448c35.3 0 64-28.7 64-64V256C512 114.6 397.4 0 256 0zM362.8 512c-6.6-5.9-10.8-14.4-10.8-24V448H160v40c0 9.6-4.2 18.1-10.8 24H362.8zM190.8 277.5L177 320H335l-13.8-42.5c-1.1-3.3-4.1-5.5-7.6-5.5H198.4c-3.5 0-6.5 2.2-7.6 5.5zM168 408a24 24 0 1 0 0-48 24 24 0 1 0 0 48zm200-24a24 24 0 1 0 -48 0 24 24 0 1 0 48 0z" />
                            </svg>
                            {{ $inmueble->garajes }}</p>
                        <p class="m-0">Garajes</p>
                    </div>
                </div>

                {{-- no logueado --}}
                @if (Auth::id() != $inmueble->id_user)
                    <div class="d-flex flex-column bg-white p-3 rounded border mt-3">
                        <h4 class="mb-3">Descripción</h4>
                        <p id="description" style="text-align: justify; word-wrap: break-word; hyphens: auto;">
                            {{ $inmueble->descripcion }}
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>
    @auth
        @if (Auth::user()->id == $inmueble->id_user)
            <div class="col-md-4">
                <div class="d-flex flex-column bg-white p-4 rounded border">
                    <h4 class="mb-3">Descripción</h4>
                    <p id="description" style="text-align: justify; word-wrap: break-word; hyphens: auto;">
                        {{ $inmueble->descripcion }}
                    </p>
                </div>
            </div>
        @endif
    @endauth

    @if (Auth::id() != $inmueble->id_user)
        <div class="col-md-4 mt-3 mt-md-0">
            <div class="d-flex flex-column bg-white p-4"
                style="box-shadow: 0px -6px 46px 0px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                <div class="rounded p-3 d-flex align-items-center" style="background-color: #EFEEEE">
                    <img src="{{ $inmueble->user->profile_photo_url }}" alt="{{ $inmueble->user->name }}"
                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%">
                    <div class="ms-2">
                        <h6 class="fw-bold mb-0">
                            {{ $inmueble->nombres . ' ' . $inmueble->apellidos }}
                        </h6>
                        <p class="m-0" style="font-size: 0.8rem">Propietario</p>
                    </div>
                </div>
                <div class="border rounded p-3 d-flex align-items-center mt-3">
                    <div>
                        <h6 class="fw-bold mb-0">
                            Número de contacto
                        </h6>
                        <p class="m-0" style="font-size: 0.8rem">{{ $inmueble->celular }}</p>
                    </div>
                </div>
                <div class="border rounded p-3 d-flex align-items-center mt-3">
                    <div>
                        <h6 class="fw-bold mb-0">
                            Correo electrónico
                        </h6>
                        <p class="m-0" style="font-size: 0.8rem">{{ $inmueble->correo }}</p>
                    </div>
                </div>
                @if ($inmueble->active == 1)
                    <a target="_blank"
                        href="https://api.whatsapp.com/send?phone=57{{ $inmueble->celular }}&text={{ urlencode("Hola $inmueble->nombres, estoy interesado en su propiedad. Quisiera más información.") }}"
                        class="btn btn-success w-100 mt-4 text-white">Contactar</a>
                @else
                    <button class="btn bg-danger w-100 mt-4 text-white" disabled>Inmueble inactivo</button>
                @endif
            </div>
        </div>
    @endif

    <div class="my-5 py-3">
        <h2 class="text-center mb-5">Ofertas similares</h2>
        <div class="container">
            <div class="row">
                @foreach ($inmuebles_relacionados as $inmueble)
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('inmuebles.ver_inmueble', $inmueble->id) }}" class="text-decoration-none">
                            <div class="card border-0 bg-white"
                                style="box-shadow: 0px -6px 46px 0px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                                <img src="{{ $inmueble->first_image_url != null ? asset($inmueble->first_image_url) : asset('img/default-perfil.jpg') }}"
                                    class="card-img-top" alt="Imagen de propiedad"
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
                                        ${{ $inmueble->valor_arriendo_venta_formatted }}
                                        COP
                                    </h5>
                                    <p class="fw-semibold mb-0">
                                        <span>
                                            <img src="{{ asset('img/bethroom.png') }}" alt="Icono de habitaciones"
                                                class="icon"> {{ $inmueble->num_habitaciones }}
                                        </span>&nbsp;
                                        <span>
                                            <img src="{{ asset('img/Bathtub.png') }}" alt="Icono de habitaciones"
                                                class="icon"> {{ $inmueble->num_banos }}
                                        </span>&nbsp;
                                        <span>
                                            <img src="{{ asset('img/ArrowsOut.png') }}" alt="Icono de habitaciones"
                                                class="icon"> {{ $inmueble->area_construida }} m²
                                        </span>
                                    </p>
                                </div>
                                <div class="container pb-3">
                                    <div class="row justify-content-between">
                                        <div class="col-12">
                                            <hr class="mt-0">
                                        </div>
                                        <div class="col-auto fw-semibold">
                                            @if ($inmueble->user)
                                                <img src="{{ $inmueble->user->profile_photo_url }}"
                                                    alt="{{ $inmueble->user->name }}"
                                                    style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%">
                                                {{ $inmueble->user->name }}
                                            @else
                                                <p>Usuario no disponible</p>
                                            @endif
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

</div>

<style>
    body {
        background-color: #F4F4F4;
    }
</style>
<script>
    window.onload = function() {
        var description = document.getElementById("description");
        var text = description.innerHTML;

        var words = text.split(" ");
        var visibleWords = words.slice(0, 120).join(" ");
        var hiddenWords = words.slice(120).join(" ");

        if (words.length > 120) {
            description.innerHTML = visibleWords +
                '<span id="dots">...</span><span id="moreText" style="display: none;">&nbsp;' + hiddenWords +
                '</span><button id="toggleButton" class="btn bg-verde text-white rounded-pill btn-sm px-3 mt-3 d-flex" onclick="toggleDescription()">Ver más</button>';
        } else {
            description.innerHTML = text;
        }
    };

    function swapImage(thumbnail) {
        var mainImage = document.getElementById('mainImage');
        var tempSrc = mainImage.src;
        mainImage.src = thumbnail.src;
        thumbnail.src = tempSrc;
    }

    function toggleDescription() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("moreText");
        var toggleButton = document.getElementById("toggleButton");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            moreText.style.display = "none";
            toggleButton.innerHTML = "Ver más";
        } else {
            dots.style.display = "none";
            moreText.style.display = "inline";
            toggleButton.innerHTML = "Ver menos";
        }
    }
</script>
