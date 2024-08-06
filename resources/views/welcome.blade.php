@extends('layouts.invitado2')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('content')
    <div class="d-flex justify-content-center align-items-center py-5">
        <div class="banner-container" style="width: 60rem; height: 20rem;">
            <img src="https://w7.pngwing.com/pngs/468/526/png-transparent-city-lights-neon-background-city-lights-poster-banner-photography.png"
                alt="Banner" class="img-fluid banner-image">
            <div class="banner-text">PUBLICACIÓN DE OFERTAS</div>
            <a href="{{route('login')}}" class="btn banner-button">Publica tu inmueble</a>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="btn-group" role="group" aria-label="Rental Sale">
                    <button type="button" class="btn btn-outline-success" id="rentBtn">Arriendo</button>
                    <button type="button" class="btn btn-outline-success" id="saleBtn">Venta</button>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>Ubicación</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>Tipo De Propiedad</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>Rango</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success">Buscar</button>
            </div>
        </div>
    </div>


    <div class="container py-5">
        <h2 class="text-center mb-4">¡Encuentra las mejores ofertas inmobiliarias!</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/2556/2556460.png" alt="Casas en venta"
                                style="width: 40px;">
                        </div>
                        <h5 class="card-title">Casas en venta</h5>
                        <p class="card-text">Descubre una variedad de casas en venta en Yopal. Encuentra tu hogar ideal
                            entre nuestros opciones disponibles que se adaptan a tus necesidades.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/2556/2556460.png" alt="Casas en arriendo"
                                style="width: 40px;">
                        </div>
                        <h5 class="card-title">Casas en arriendo</h5>
                        <p class="card-text">Explora un amplio gama de casas en arriendo en Yopal. Encuentra el lugar
                            perfecto para vivir con opciones que se ajustan a tu presupuesto.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/2556/2556460.png" alt="Terrenos en venta"
                                style="width: 40px;">
                        </div>
                        <h5 class="card-title">Terrenos en venta</h5>
                        <p class="card-text">Descubre terrenos disponibles en Yopal para construir la casa de tus sueños o
                            invertir en proyectos inmobiliarios.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>´

    <div class="container mt-4 mb-4 py-5">
        <h2 class="text-center mb-4">Ultimas ofertas subidas</h2>

        <div class="row">
            <!-- Iterar para cada propiedad -->
            <div class="col-md-4">
                <div class="card">
                    <img src="https://www.shutterstock.com/image-photo/interior-living-room-green-houseplants-600nw-2290526749.jpg" class="card-img-top" alt="Imagen de propiedad">
                    <div class="card-header">
                        Venta
                    </div>
                    <div class="card-body">
                        <h5 class="card-title price">$1,500,000</h5>
                        <p class="card-text details">
                            <i class="fas fa-bed icon"></i>4
                            <i class="fas fa-bath icon"></i>4
                            <i class="fas fa-ruler-combined icon"></i>2,096.00 ft
                        </p>
                    </div>
                    <div class="card-footer">
                        <i class="fas fa-user icon"></i> Juan Sánchez
                        <button class="btn btn-share">
                            <i class="fas fa-share-alt"></i> Compartir
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://www.shutterstock.com/image-photo/interior-living-room-green-houseplants-600nw-2290526749.jpg" class="card-img-top" alt="Imagen de propiedad">
                    <div class="card-header">
                        Venta
                    </div>
                    <div class="card-body">
                        <h5 class="card-title price">$1,500,000</h5>
                        <p class="card-text details">
                            <i class="fas fa-bed icon"></i>4
                            <i class="fas fa-bath icon"></i>4
                            <i class="fas fa-ruler-combined icon"></i>2,096.00 ft
                        </p>
                    </div>
                    <div class="card-footer">
                        <i class="fas fa-user icon"></i> Juan Sánchez
                        <button class="btn btn-share">
                            <i class="fas fa-share-alt"></i> Compartir
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://www.shutterstock.com/image-photo/interior-living-room-green-houseplants-600nw-2290526749.jpg" class="card-img-top" alt="Imagen de propiedad">
                    <div class="card-header">
                        Venta
                    </div>
                    <div class="card-body">
                        <h5 class="card-title price">$1,500,000</h5>
                        <p class="card-text details">
                            <i class="fas fa-bed icon"></i>4
                            <i class="fas fa-bath icon"></i>4
                            <i class="fas fa-ruler-combined icon"></i>2,096.00 ft
                        </p>
                    </div>
                    <div class="card-footer">
                        <i class="fas fa-user icon"></i> Juan Sánchez
                        <button class="btn btn-share">
                            <i class="fas fa-share-alt"></i> Compartir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        .card {
            border-radius: 15px;
            background: #f8f9fa;
        }

        .icon img {
            color: #28a745;
        }

        .banner-container {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
        }

        .banner-image {
            width: 100%;
            display: block;
        }

        .banner-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 30px;
            font-weight: bold;
        }

        .banner-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }

        .banner-button:hover {
            background-color: darkgreen;
        }
        body {
            background-color: #F4F4F4;
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .card-header {
            background-color: #fff;
            border-bottom: none;
        }
        .card-body {
            background-color: #F9F9F9;
        }
        .card-footer {
            background-color: #fff;
            border-top: none;
        }
        .price {
            color: #2D3748;
            font-weight: bold;
            font-size: 18px;
        }
        .details {
            color: #718096;
        }
        .icon {
            color: #4A5568;
        }
    </style>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rentBtn = document.getElementById('rentBtn');
        const saleBtn = document.getElementById('saleBtn');

        rentBtn.addEventListener('click', function() {
            rentBtn.classList.add('active');
            saleBtn.classList.remove('active');
            rentBtn.classList.remove('btn-outline-success');
            saleBtn.classList.add('btn-outline-success');
        });

        saleBtn.addEventListener('click', function() {
            saleBtn.classList.add('active');
            rentBtn.classList.remove('active');
            saleBtn.classList.remove('btn-outline-success');
            rentBtn.classList.add('btn-outline-success');
        });
    });
</script>
