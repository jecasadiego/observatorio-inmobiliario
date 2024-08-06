@php
    $user = Auth::user();
@endphp
<nav x-data="{ open: false }" class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-gray-100 mb-5">
    <div class="container-xl">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="navbar-brand">
            <img src="{{asset('img/logo-catastro.png')}}" alt="Logo" class="block h-9" style="width:3rem">
        </a>

        <!-- Right side of navbar -->
        <div class="d-flex justify-content-end">
            <div class="dropdown">
                <button class="user-btn dropdown-toggle" type="button" id="dropdownUserButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{$user->profile_photo_url}}" class="rounded-circle" alt="User Icon" style="height: 35px;">
                    {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownUserButton">
                    <li> <a href="{{route('inmuebles.crear')}}"  class="dropdown-item d-md-none d-block fw-bold" style="color: #2c9f5f">Publicar inmueble</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.show') }}">Perfil</a></li>
                    <li><a class="dropdown-item" href="{{ route('home') }}">Regresar al Home</a></li>
                    @if ($user->super_admin == 1)
                        <li><a class="dropdown-item" href="{{ route('superadmin.index') }}">Zona administrativa</a></li>
                    @endif
                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>

            <a href="{{route('inmuebles.crear')}}"  class="btn bg-verde text-white ms-3 d-md-block d-none">Publicar inmueble</a>
        </div>
    </div>
</nav>
