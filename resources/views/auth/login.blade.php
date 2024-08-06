<x-guest-layout>
    <div class="container p-5">
        <div class="row bg-white" style="border-radius: 10px;">
            <div class="col-md-6 p-5">
                <div class="text-center mb-4">
                    <img src="{{ asset('img/logo-catastro.png') }}" alt="Logo Observatorio Inmobiliario" class="img-fluid">
                    <h5 class="mt-3">Iniciar sesión</h5>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Usuario</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                            required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-5 row">
                        <div class="col">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Recuérdame</label>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('password.request') }}" class="text-decoration-none azul">¿Olvidaste tu contraseña?</a>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-verde rounded-pill px-5 text-white">Iniciar sesión</button>
                    </div>
                    <div class="text-center mt-5">
                        <a href="{{ route('register') }}" class="text-decoration-none fw-medium azul">¿No tienes una cuenta?
                            <span class="fw-bold">Regístrate</span></a>
                    </div>
                </form>
            </div>
            <div class="col-md-6 p-0" style="background-image: url({{ asset('img/img-login.jpeg') }}); background-size: cover; background-position: center; border-radius: 0 10px 10px 0">
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #EEFFF8;
        }
    </style>
</x-guest-layout>
