<x-app-layout>

    <div class="container">
        <x-regresar route="superadmin.index" />
        <x-header>
            <x-slot name="texto">Editar Entidad</x-slot>
        </x-header>
    </div>
    <form method="POST" action="{{ route('superadmin.entidad.update') }}" enctype="multipart/form-data" id="entidadForm"
        name="entidadForm">
        @method('POST')
        @csrf
        <div class="container mt-4">
            <div class="card card-form">
                <div class="card-body p-5">
                    <h5 class="card-title mb-4">Entidad </h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="{{ $entidad->nombre }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre_oficina" class="form-label">Nombre oficina</label>
                            <input type="text" class="form-control" id="nombre_oficina" name="nombre_oficina"
                                value="{{ $entidad->nombre_oficina }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="remitente" class="form-label">Remitente</label>
                            <input type="email" class="form-control" id="remitente" name="remitente"
                                value="{{ $entidad->remitente }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="url_entidad" class="form-label">Url</label>
                            <input type="text" class="form-control" id="url_entidad" name="url_entidad"
                                value="{{ $entidad->url_entidad }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email_noti_judiciales" class="form-label">Email Notificaciones
                                Judiciales</label>
                            <input type="email" class="form-control" id="email_noti_judiciales"
                                name="email_noti_judiciales" value="{{ $entidad->email_noti_judiciales }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email_atencion_usuarios" class="form-label">Email atención usuarios</label>
                            <input type="text" class="form-control" id="email_atencion_usuarios"
                                name="email_atencion_usuarios" value="{{ $entidad->email_atencion_usuarios }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Direccion</label>
                            <input type="text" class="form-control" id="direccion" name="direccion"
                                value="{{ $entidad->direccion }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="barrio" class="form-label">Barrio</label>
                            <input type="text" class="form-control" id="barrio" name="barrio"
                                value="{{ $entidad->barrio }}" required>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">

                            <label for="url_observatorio" class="form-label"> Url observatorio</label>
                            <input type="text" class="form-control" id="url_observatorio" name="url_observatorio"
                                value="{{ $entidad->url_observatorio }}" required>
                        </div>
                        <div class="col-md-6">

                            <label for="url_app" class="form-label"> Url app</label>
                            <input type="text" class="form-control" id="url_app" name="url_app"
                                value="{{ $entidad->url_app }}" required>

                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="descripcion_horario" class="form-label">Descripción Horario</label>
                            <textarea class="form-control" id="descripcion_horario" name="descripcion_horario" required rows="3">{{ $entidad->descripcion_horario }}</textarea>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required rows="5">{{ $entidad->descripcion }}</textarea>

                        </div>
                    </div>

                </div>
            </div>
            <div class="container d-flex justify-content-end my-5">
                <button class="btn btn-success" type="submit">Editar entidad</button>
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
</x-app-layout>
