<!-- Footer goes here -->

<footer class="container-fluid m-0 mt-5" style="background: linear-gradient(to top, #05af65 80%, transparent 20%);">

    <div class="row justify-content-center">

        <div class="col-12">

            <div class="row justify-content-center ">

                <div class="col-11 col-md-8 bg-white py-5 mb-4 px-5"
                    style="border: 1px solid #c5c5c5; border-radius: 10px;">

                    <h2 class="text-center" style="font-weight: 600 !important; font-size: 1.2rem;">{{ $entidad->nombre }}
                    </h2>
                    <h3 class="text-center" style="font-weight: 600 !important; font-size: 1.2rem ; color:#05af65">
                        {{ $entidad->nombre_oficina }}</h3>

                    <b>
                        <h4 class="text-center" style="font-weight: 600 !important; font-size: 1.2rem; color:black">
                            {{ $entidad->descripcion }}</h4>
                    </b>

                    <p class="light second-family text-small-two text-center">

                        {{ $entidad->direccion }}

                    </p>

                    <p class="light second-family text-small-two text-center" style="margin-bottom: 15px">{{ $entidad->descripcion_horario }} - Email de atención al usuario
                        <strong>{{ $entidad->email_atencion_usuarios}}</strong> - Notificaciones judiciales:
                        <strong>{{ $entidad->email_noti_judiciales }}</strong>

                    </p>

                    <div class="text-medium text-center">

                        <p class="m-0">

                            <a style="color: #098a52; text-decoration: none;" target="_blank">Términos y Condiciones de
                                Uso</a> | <a style="color: #098a52; text-decoration: none;" target="_blank">Tratamiento
                                de Datos Personales

                            </a>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row justify-content-center gov-container py2">

        <div class="col-auto">

            <span class="second-family text-small text-white">© {{ date('Y') }} Catasig todos los derechos
                reservados</span>

        </div>

    </div>

</footer>

<style>
    .gov-container {
        background-color: #3366cc;
        /* height: 4vh; */
    }
</style>
