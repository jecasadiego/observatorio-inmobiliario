<nav x-data="{ open: false }" class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-gray-100">
    <div class="container-fluid">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="navbar-brand">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b2/Bootstrap_logo.svg" alt="Logo" class="block h-9" style="width:2rem">
        </a>

        <button @click="open = !open" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportContent" aria-controls="navbarSupportContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Right side of navbar -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportContent">
            <!-- User Account and Button -->
            <div class="d-flex align-items-center">
                <!-- User Account Dropdown -->
                <div class="dropdown">
                    <button class="user-btn dropdown-toggle" type="button" id="dropdownUserButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" alt="User Icon" style="height: 20px;">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownUserButton">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>

                <!-- Publish Property Button -->
                <a href="{{route('crear_inmueble')}}"  class="btn btn-success ms-3">Publicar inmueble</a>
            </div>
        </div>
    </div>
</nav>