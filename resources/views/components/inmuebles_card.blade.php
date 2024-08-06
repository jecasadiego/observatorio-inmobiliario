<a class="text-decoration-none" href="{{route('inmuebles.ver_inmueble', $id)}}">
    <div class="card border-0 bg-white mb-5" style="box-shadow: 0px -6px 46px 0px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <img src="{{ asset($image) }}" class="card-img-top img-fluid bg-cover" alt="Imagen de propiedad" style="min-height: 250px; max-height: 250px; object-fit: cover;">
        <div class="card-body">
            <h5 class="mb-3 gris text-truncate">{{ $titulo }}</h5>
            <h5 class="mb-3 verde text-truncate">${{ $precio }} COP</h5>
            <p class="fw-semibold mb-0 ">
                <span>
                    <img src="{{ asset('img/bethroom.png') }}" alt="Icono de habitaciones" class="icon">
                    {{ $habitaciones }}
                </span>&nbsp;
                <span>
                    <img src="{{ asset('img/Bathtub.png') }}" alt="Icono de habitaciones" class="icon"> {{ $sanitarios }}
                </span>&nbsp;
                <span>
                    <img src="{{ asset('img/ArrowsOut.png') }}" alt="Icono de habitaciones" class="icon"> {{ $area }} m²
                </span>
            </p>
        </div>
    </div>
</a>
