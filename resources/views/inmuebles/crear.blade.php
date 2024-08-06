<x-app-layout>

    <form>
        <div class="container mt-5">
            <div class="card card-custom">
                <div class="card-body">
                    <h5 class="card-title mb-4">Datos y ubicación del inmueble </h5>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="tipoOferta" class="form-label">Elige el tipo de oferta*</label>
                            <select class="form-select mb-3" id="tipoOferta">
                                <option selected>Vender mi inmueble</option>
                                <option>Alquilar mi inmueble</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tipoInmueble" class="form-label">Elige el tipo de inmueble*</label>
                            <select class="form-select mb-3" id="tipoInmueble">
                                <option selected>Apartamento</option>
                                <option>Casa</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Dirección*</label>
                            <input type="text" class="form-control mb-3" id="direccion">
                        </div>
                        <div class="col-md-6">
                            <label for="ciudad" class="form-label">Ciudad/Municipio*</label>
                            <select class="form-select mb-3" id="ciudad">
                                <option selected>Seleccionar</option>
                                <option>Bogotá</option>
                                <option>Medellín</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-md-6 mb-3">
                            <label for="barrio" class="form-label">Barrio*</label>
                            <input type="text" class="form-control" id="barrio">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="map">Elegir ubicación en el mapa*</label>
                            <div id="map" style="width: 100%; height: 200px;"></div>
                            <!-- Contenedor para el mapa -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="card card-custom">
                <div class="card-body">
                    <h5 class="card-title mb-4">Fotos del inmueble </h5>
                    <div class="row">
                        <p>Agrega tus fotos *</p>
                        <div class="col-md-12">
                            <div class="photo-upload-card">
                                <div class="upload-area" id="drag-drop-area">
                                    <input type="file" id="file-input" hidden accept="image/png, image/jpeg"
                                        multiple>
                                    <label for="file-input" class="upload-btn">Seleccionar archivo</label>
                                    <div id="file-preview" class="file-preview"></div>
                                    <small>Puedes arrastrar y soltar los archivos aquí</small>
                                    <small>Acepta formato: JPG, PNG, JPEG. Peso máximo de 5 MB</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="card card-custom">
                <div class="card-body">
                    <h5 class="card-title mb-4">Descripción del inmueble</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="tipoOferta" class="form-label">Agrega descripción detallada y relevante del
                                inmueble</label>
                            <textarea name="description" class="form-control mb-3" id="" cols="30" rows="5"
                                placeholder="Agrega acá la descripción"></textarea>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="card card-custom">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Detalle del inmueble</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="estrato" class="form-label">Estrato*</label>
                                <input type="text" class="form-control mb-3" id="estrato" name="estrato">
                            </div>
                            <div class="col-md-6">
                                <label for="area" class="form-label">Area contruida*</label>
                                <input type="number" class="form-control mb-3" id="area" name="area">
                            </div>
                            <div class="col-md-6">
                                <label for="pisos" class="form-label">Número de pisos*</label>
                                <input type="text" class="form-control mb-3" id="pisos" name="pisos">
                            </div>
                            <div class="col-md-6">
                                <label for="estrato" class="form-label">Número de habitaciones*</label>
                                <input type="text" class="form-control mb-3" id="estrato" name="estrato">
                            </div>
                            <div class="col-md-6">
                                <label for="estrato" class="form-label">Número de baños*</label>
                                <input type="text" class="form-control mb-3" id="estrato" name="estrato">
                            </div>
                        </div>
                    </div>
                </div>

    </form>
    <style>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>
    <script>
        function initMap() {
            var mapOptions = {
                zoom: 8,
                center: {
                    lat: 4.60971,
                    lng: -74.08175
                }, // Coordenadas de Bogotá, ajusta a tu necesidad
                mapTypeId: 'terrain' // Tipo de mapa, puede ser 'roadmap', 'satellite', 'hybrid', 'terrain'
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        }
        document.getElementById('file-input').addEventListener('change', function() {
            const filePreview = document.getElementById('file-preview');
            filePreview.innerHTML = ''; // Limpiar vista previa anterior

            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    filePreview.appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>

</x-app-layout>
