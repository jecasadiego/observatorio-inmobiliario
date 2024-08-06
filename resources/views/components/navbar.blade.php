<nav class="navbar navbar-expand-lg mb-4" style="background-color: #ffff;">
    <div class="container">
        <!-- Logo y nombre del portal alineados a la izquierda -->
        <a class="navbar-brand" href="{{route('home')}}" style="color: #000000; font-weight: bold; display: flex; align-items: center;">
            <img src="{{asset('img/logo-catastro.png')}}" class="me-3" alt="Logo Catastro Yopal" 
                style="width:4rem">
            <span style="font-size: 1.5rem;">Portal Inmobiliario</span>
        </a>
        <!-- Botón para menú responsivo -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Enlaces del navbar -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}" style="color: #000000;">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{$entidad->url_entidad}}" style="color: #000;">Catastro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{$entidad->url_observatorio}}" style="color: #000;">Observatorio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('nosotros')}}" style="color: #000;">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="btn bg-verde text-white" href="{{ route('login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar {
        font-family: Arial, sans-serif;
        /* Fuente similar a la de la imagen */
    }

    .nav-link {
        margin-right: 20px;
        /* Espaciado entre enlaces */
        font-size: 14px;
        /* Tamaño de letra apropiado */
    }

    .navbar-brand {
        font-size: 18px;
        /* Tamaño de letra para el título y logo */
    }
</style>
