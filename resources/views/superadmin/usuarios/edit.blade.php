<x-app-layout>
    <div class="container">
        <x-regresar route="superadmin.usuarios" />
        <x-header>
            <x-slot name="texto">Editar Usuario</x-slot>
        </x-header>
    </div>

    <div class="container mt-5 mb-5">
        <form action="{{ route('superadmin.usuarios_update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-3 p-3 bg-light shadow rounded ">
                <div class="card-body">
                    <h5 class="card-title mb-4">Editar usuario</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <label for="tipo_documento" class="form-label">Tipo Documento</label>
                                <input type="text" class="form-control" id="tipo_documento" name="tipo_documento" value="{{ $user->tipo_documento }}" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <label for="nro_documento" class="form-label">Nro Documento</label>
                                <input type="text" class="form-control" id="nro_documento" name="nro_documento" value="{{ $user->nro_documento }}" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $user->direccion }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $user->telefono }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3 position-relative">
                                <label for="password">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password">
                                    <button type="button" class="btn bg-verde text-white"
                                        id="generatePassword">Generar</button>
                                    <button type="button" class="btn btn-secondary" id="togglePassword">
                                        <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 12.5A4.5 4.5 0 1 1 8 3a4.5 4.5 0 0 1 0 9zm0-1A3.5 3.5 0 1 0 8 4a3.5 3.5 0 0 0 0 7z" />
                                            <path d="M8 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6z" />
                                        </svg>
                                        <svg id="icon-eye-slash" xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-eye-slash d-none"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M13.359 11.238l.706.706c1.114-1.16 1.935-2.617 2.456-4.006C15.642 5.342 12.583 2 8 2a6.752 6.752 0 0 0-4.456 1.742l.706.706A5.752 5.752 0 0 1 8 3c3.219 0 5.572 2.904 6.359 4.762a12.13 12.13 0 0 1-1.598 2.59l.598.598zm-11.31-7.15l-.708.708A12.13 12.13 0 0 0 0 8c.788 1.858 3.141 4.762 6.359 4.762 1.063 0 2.054-.264 2.956-.733l1.646 1.646-.707.707A6.752 6.752 0 0 1 8 13c-4.583 0-7.642-3.342-7.951-4.938A12.13 12.13 0 0 1 3.238 4.36L1.354 2.475l.707-.707L13.352 13.24l-.707.707-1.586-1.586A5.752 5.752 0 0 1 8 12.5a5.752 5.752 0 0 1-4.456-1.742l-.706-.706A12.13 12.13 0 0 0 8 14c3.219 0 5.572-2.904 6.359-4.762a12.13 12.13 0 0 0-1.598-2.59l1.707-1.707-1.707-1.707z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <label for="superadmin">Super Admin</label>
                                <select class="form-control" id="superadmin" name="superadmin" required>
                                    <option value="1" {{ $user->superadmin == 1 ? 'selected' : '' }}>Sí</option>
                                    <option value="0" {{ $user->superadmin == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group mb-3">
                                <label for="cedula_pdf">Documento de identidad</label>
                                <input type="file" class="form-control" id="cedula_pdf" name="cedula_pdf">
                                @if($user->cedula_pdf)
                                    <p class="mt-2">Documento actual: <a href="{{ Storage::url($user->cedula_pdf) }}" target="_blank">Ver documento</a></p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="container d-flex justify-content-end my-5">
                <button class="btn btn-success" type="submit">Actualizar Usuario</button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('generatePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const password = Array(10).fill('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz')
                .map(x => x[Math.floor(Math.random() * x.length)]).join('');
            passwordField.value = password;
        });

        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const iconEye = document.getElementById('icon-eye');
            const iconEyeSlash = document.getElementById('icon-eye-slash');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                iconEye.classList.add('d-none');
                iconEyeSlash.classList.remove('d-none');
            } else {
                passwordField.type = 'password';
                iconEye.classList.remove('d-none');
                iconEyeSlash.classList.add('d-none');
            }
        });
    </script>
</x-app-layout>