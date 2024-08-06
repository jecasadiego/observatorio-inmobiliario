<x-app-layout>
    <div class="container">
        <x-regresar route="dashboard" />
        <h2 class="p-0 pt-1 fw-bold text-center">Crea tu aviso</h2>
    </div>
    <form method="POST" action="{{ route('inmuebles.guardar') }}" enctype="multipart/form-data" id="inmuebleForm"
        name="inmuebleForm">
        @method('POST')
        @csrf
        <div class="container mt-4">
            <div class="card card-form">
                <div class="card-body p-5">
                    <h5 class="card-title mb-4">Datos y ubicación del inmueble </h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="titulo" class="form-label">Titulo del inmueble<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombre_inmueble" name="nombre_inmueble"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="destino_economico" class="form-label">Destino economico<span
                                    class="text-danger">*</span> </label>
                            <select class="form-select mb-3" id="destino_economico" name ="destino_economico" required>
                                <option selected value="">--Seleccionar--</option>
                                <option value="1">Comercial</option>
                                <option value="2">Habitacional</option>
                                <option value="3">Oficinas</option>
                                <option value="4">General</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="tipoInmueble" class="form-label">Elige el tipo de inmueble<span
                                    class="text-danger">*</span></label>
                            <select class="form-select mb-3" id="tipoInmueble" name ="tipo_inmueble" required>
                                <option value="">--Seleccionar--</option>
                                @foreach ($tiposInmuebles as $key => $tipo)
                                    <option value="{{ $key }}">{{ $tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tipoOferta" class="form-label">Elige el tipo de oferta<span
                                    class="text-danger">*</span></label>
                            <select class="form-select mb-3" id="tipoOferta" name="tipo_oferta" required="required">
                                <option value="">--Seleccionar--</option>
                                <option value="1">Vender mi inmueble</option>
                                <option value="2">Alquilar mi inmueble</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="ciudad" class="form-label">Ciudad/Municipio<span
                                    class="text-danger">*</span></label>
                            <select class="form-select mb-3" id="ciudad" name ="ciudad" required>
                                <option selected value="{{ $entidad->id_divipos_municipios }}">
                                    {{ $entidad->divipos_municipios->nombre_municipio }}</option>
                            </select>
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label for="barrio" class="form-label">Barrio<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="barrio" name="barrio" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="direccion" class="form-label">Dirección<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control mb-3" id="direccion" name ="direccion" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="map" class="form-label">Elegir ubicación en el mapa<span
                                    class="text-danger">*</span></label>
                            <div id="map" class="border rounded" style="width: 100%; height: 400px;"></div>
                            <!-- Contenedor para el mapa -->
                        </div>
                    </div>
                    <input type="hidden" id="latitud" name="latitud">
                    <input type="hidden" id="longitud" name="longitud">

                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="card card-form">
                <div class="card-body p-5">
                    <h5 class="card-title mb-4">Fotos de portada del inmueble<span class="text-danger">*</span></h5>
                    <div class="row">
                        <p>Agrega tu foto de portada</p>
                        <div class="col-md-12">
                            <div class="photo-upload-card">
                                <div class="upload-area" id="drag-drop-area-portada">
                                    <input type="file" id="file-input-portada" hidden
                                        accept="image/png, image/jpeg" name="portada" multiple>
                                    <label for="file-input-portada" class="upload-btn">Seleccionar archivo</label>
                                    <div id="file-preview-portada" class="file-preview"></div>
                                    <small>Puedes arrastrar y soltar los archivos aquí</small>
                                    <small>Acepta formato: JPG, PNG, JPEG. Peso máximo de 5 MB</small>
                                </div>
                            </div>
                            <div id="error-message-portada" class="alert alert-danger mt-3 d-none" role="alert">
                                Debe subir almenos una imagen del inmueble.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="card card-form">
                <div class="card-body p-5">
                    <h5 class="card-title mb-4">Fotos adicionales del inmueble<span class="text-danger">*</span></h5>
                    <div class="row">
                        <p>Agrega tus fotos</p>
                        <div class="col-md-12">
                            <div class="photo-upload-card">
                                <div class="upload-area" id="drag-drop-area">
                                    <input type="file" id="file-input" hidden accept="image/png, image/jpeg"
                                        name="images[]" multiple>
                                    <label for="file-input" class="upload-btn">Seleccionar archivo</label>
                                    <div id="file-preview" class="file-preview"></div>
                                    <small>Puedes arrastrar y soltar los archivos aquí</small>
                                    <small>Acepta formato: JPG, PNG, JPEG. Peso máximo de 5 MB</small>
                                </div>
                            </div>
                            <div id="error-message" class="alert alert-danger mt-3 d-none" role="alert">
                                Debe subir almenos una imagen del inmueble.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="card card-form">
                <div class="card-body p-5">
                    <h5 class="card-title mb-4">Descripción del inmueble <span class="text-danger">*</span></h5>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="tipoOferta" class="form-label">Agrega descripción detallada y relevante del
                                inmueble</label>
                            <textarea name="descripcion" class="form-control mb-3" id="" cols="30" rows="5"
                                placeholder="Casa en arriendo ubicada al norte de Yopal en el sector del barrio el Prado cuenta con un área total de 1100m2 y área construida de 600m2 , dispone de un parqueadero interno con capacidad para 14 vehículos"
                                required></textarea>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="card card-form">
                <div class="card-body p-5">
                    <h5 class="card-title mb-4">Detalle del inmueble</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="estrato" class="form-label">Estrato<span
                                    class="text-danger">*</span></label>
                            <input type="number" min="0" max="6" class="form-control mb-3"
                                id="estrato" name="estrato" required>
                        </div>
                        <div class="col-md-6">
                            <label for="area_construida" class="form-label">Area contruida (m2)<span
                                    class="text-danger">*</span></label>
                            <input type="number" min="0" max="1000" class="form-control mb-3"
                                id="area_construida" name="area_construida" required>
                        </div>
                        <div class="col-md-6">
                            <label for="num_pisos" class="form-label">Número de pisos<span
                                    class="text-danger">*</span></label>
                            <input type="number" min="0" max="100" class="form-control mb-3"
                                id="num_pisos" name="num_pisos" required>
                        </div>
                        <div class="col-md-6">
                            <label for="num_habitaciones" class="form-label">Número de habitaciones<span
                                    class="text-danger">*</span></label>
                            <input type="number" min="0" max="100" class="form-control mb-3"
                                id="num_habitaciones" name="num_habitaciones" required>
                        </div>
                        <div class="col-md-6">
                            <label for="num_banos" class="form-label">Número de baños<span
                                    class="text-danger">*</span></label>
                            <input type="number" min="0" max="100" class="form-control mb-3"
                                id="num_banos" name="num_banos" required>
                        </div>
                        <div class="col-md-6">
                            <label for="garajes" class="form-label">Número de Garajes<span
                                    class="text-danger">*</span></label>
                            <input type="number" min="0" max="100" class="form-control mb-3"
                                id="garajes" name="garajes" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="card card-form">
                <div class="card-body p-5">
                    <h5 class="card-title mb-4">Valor del inmueble</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="valor_arriendo_venta" class="form-label">Valor del arriendo/venta<span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control mb-3" id="valor_arriendo_venta"
                                name="valor_arriendo_venta" required>
                        </div>
                        <div class="col-md-6">
                            <label for="valor_administracion" class="form-label">Valor de la administración</label>
                            <input type="number" class="form-control mb-3" id="valor_administracion"
                                name="valor_administracion" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <input type="checkbox" name="valor_incluye_administracion"
                                id="valor_incluye_administracion">
                            <label for="valor_incluye_administracion" class="form-label ms-2 mt-1">El valor incluye la
                                administración</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="card card-form">
                <div class="card-body p-5">
                    <h5 class="card-title mb-4">Datos de contacto</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nombres" class="form-label">Nombre/s<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control mb-3" id="nombres" name="nombres">
                        </div>
                        <div class="col-md-6">
                            <label for="apellidos" class="form-label">Apellidos<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control mb-3" id="apellidos" name="apellidos">
                        </div>
                        <div class="col-md-6">
                            <label for="celular" class="form-label">Número de celular<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control mb-3" id="celular" name="celular">
                        </div>
                        <div class="col-md-6">
                            <label for="correo" class="form-label">Correo electrónico<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control mb-3" id="correo" name="correo">
                        </div>
                        <div class="row">
                            <div class="col-md-6 d-flex align-items-centerk">
                                <input type="checkbox" name="contacto_whatsapp" id="contacto_whatsapp">
                                <label for="contacto_whatsapp" class="form-label ms-2 mt-1">Contacto por
                                    Whatsapp</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-centerk">
                                <input type="checkbox" name="politica_datos" id="politica_datos" required>
                                <label for="politica_datos" class="form-label ms-2 mt-1">He leído, entendido y
                                    autorizo el
                                    tratamiento de mis datos personales de acuerdo con la Política de datos personales.
                                    Igualmente he leído y acepto los términos y condiciones de este portal. <span
                                        class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container d-flex justify-content-end my-5">
                <button id="submit-button" class="btn btn-success" type="submit">Publica tu inmueble</button>
            </div>
        </div>

    </form>

    <style>
        body {
            background-color: #F4F4F4;
        }

        .photo-upload-card {
            text-align: center;
        }

        .upload-area {
            border: 2px dashed #ccc;
            padding: 20px;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .upload-btn {
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 2;
            /* Asegura que el botón esté sobre el texto */
        }

        .upload-area.dragover {
            background-color: #e3f2fd;
            /* Cambia el fondo para indicar que puedes soltar los archivos */
        }

        .file-preview {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            overflow-x: auto;
            border: 1px solid #ccc;
        }

        .file-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        small {
            display: block;
            margin-top: 10px;
            /* Espacio adecuado después del botón */
            color: #666;
        }
    </style>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIAUCYmZiIWPbmTabytupLueRjFNmDHUc&libraries=places&callback=initMap"
        async defer></script>
    <script>
        var marker;
        var latitud = {{ $latitud }}
        var longitud = {{ $longitud }}

        function initMap() {
            var mapOptions = {
                zoom: 12,
                center: {
                    lat: latitud,
                    lng: longitud
                },
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
        document.getElementById('file-input').addEventListener('change', function() {
            const filePreview = document.getElementById('file-preview');
            const errorMessage = document.getElementById('error-message');

            filePreview.innerHTML = '';

            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    filePreview.appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            });

            if (this.files.length > 0) {
                errorMessage.classList.add('d-none');
            }
        });

        document.getElementById('file-input-portada').addEventListener('change', function() {
            const filePreview = document.getElementById('file-preview-portada');
            const errorMessage = document.getElementById('error-message-portada');

            filePreview.innerHTML = '';

            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    filePreview.appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            });

            if (this.files.length > 0) {
                errorMessage.classList.add('d-none');
            }
        });

        document.getElementById('inmuebleForm').addEventListener('submit', function(event) {
            var fileInput = document.getElementById('file-input');
            var fileInputPortada = document.getElementById('file-input-portada');

            var errorMessage = document.getElementById('error-message');
            var errorMessagePortada = document.getElementById('error-message-portada');


            if (fileInput.files.length === 0) {
                errorMessage.classList.remove('d-none');
                errorMessage.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                event.preventDefault();
            } else {
                errorMessage.classList.add('d-none');

            }

            if (fileInputPortada.files.length === 0) {
                errorMessagePortada.classList.remove('d-none');
                errorMessagePortada.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                })
                event.preventDefault();
            } else {
                errorMessagePortada.classList.add('d-none');
            }

        });

        document.addEventListener('DOMContentLoaded', function() {
            const adminCheckbox = document.getElementById('valor_incluye_administracion');
            const adminInput = document.getElementById('valor_administracion');

            function toggleAdminInput() {
                if (adminCheckbox.checked) {
                    adminInput.value = '0';
                    adminInput.setAttribute('disabled', 'disabled');
                } else {
                    adminInput.removeAttribute('disabled');
                }
            }

            adminCheckbox.addEventListener('change', toggleAdminInput);
            toggleAdminInput();
        });

        document.getElementById('inmuebleForm').addEventListener('submit', function(event) {
            var button = document.getElementById('submit-button');
            button.disabled = true;
            button.innerHTML = 'Publicando...';
        });
    </script>

</x-app-layout>
