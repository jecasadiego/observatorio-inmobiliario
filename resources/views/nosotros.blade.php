@extends('layouts.invitado2')

@section('content')
<section class="about-section">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-5 text-center">
                <div class="image-background d-inline-block">
                    <img src="{{ asset('img/hombrenosotros.png') }}" alt="Equipo de Inmuebles" class="img-fluid rounded-circle">
                </div>
            </div>
            <div class="col-md-7">
                <h2>Acerca de nosotros</h2>
                <p class="text-justify" style="text-align: justify">En <strong>Proyecto de Inmuebles</strong> somos una empresa innovadora en la gestión de propiedades y
                    bienes raíces. Nos especializamos en ofrecer servicios personalizados y soluciones tecnológicas
                    avanzadas para la compra, venta y administración de inmuebles.</p>
                <p class="text-justify" style="text-align: justify">Somos íntegros, colaboradores y creativos, actuamos apasionados por la excelencia y buscamos personas
                    para quienes todo es posible, que actúen de forma crítica frente a la realidad y se adhieran con
                    entusiasmo a nuestros valores.</p>
                <div class="contact-info">
                    <p class="text-justify" style="text-align: justify">Si estás interesado en ser aliado, colaborador, trabajador o contratista de nuestra empresa,
                        envía tu hoja de vida o portafolio de servicios al correo electrónico:</p>
                    <a href="mailto:{{$entidad->email_noti_judiciales}}" class="btn bg-verde text-white">{{$entidad->email_noti_judiciales}}</a>
                </div>
            </div>            
        </div>
    </div>
</section>

@endsection
