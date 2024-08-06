<x-guest-layout>
    <div class="authentication-card">
        <div class="form-section">
            <div class="text-center mb-4">
                <x-authentication-card-logo />
                <h5 class="card-title mt-3">Iniciar sesión</h5>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Usuario</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                        required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Recuérdame</label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="text-center mt-2">
                    <a href="{{ route('register') }}" class="text-decoration-none bold">¿No tienes una cuenta?
                        Regístrate</a>
                </div>
            </form>
        </div>
        <div class="image-section">
            <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/home-for-sale-banner-template-design-1f1e896289f0ad2a96771b40bb1297f1_screen.jpg?ts=1645769322" alt="Imagen de fondo" class="img-fluid banner-image" style="width: 100%;height: 100%" >
        </div>
    </div>

    <style>
        body {
            background-color: #D4E6F1;
            /* Color de fondo verde menta claro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .authentication-card {
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            background: #ffffff;
            padding: 30px;
            width: 400px;
        }

        .image-section {
            background-image: url('ruta-a-tu-imagen-lateral.jpg');
            background-size: cover;
            width: 400px;
        }

        .btn-primary {
            background-color: #04AA6D;
            border: none;
            border-radius: 30px;
            /* Botones redondos */
        }

        .btn-primary:hover {
            background-color: #038c5a;
        }

        a {
            color: #04AA6D;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</x-guest-layout>
