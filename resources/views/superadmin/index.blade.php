<x-app-layout>
    <div class="container">
        <x-regresar route="dashboard" />
        <x-header>
            <x-slot name="texto">Super Administrador</x-slot>
        </x-header>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center align-items-center mt-5 mb-5 ">
            <div class="col-12 col-md-8">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 mt-3">
                        <a href="{{ route('superadmin.formatos_email') }}" style="text-decoration: none;">
                            <div class="card shadow h-100 py-2" style="border-radius:30px" id="zoom">
                                <div class="card-body" style="text-align:center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70"
                                        fill="#05AF65" class="bi bi-envelope-fill mb-3" viewBox="0 0 16 16">
                                        <path
                                            d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                                    </svg>
                                    <div class="col-md-12">
                                        <h6 class="justify-content-end"><b>Modificar Formatos Email</b></h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <a href="{{ route('superadmin.entidad') }}" style="text-decoration: none;">
                            <div class="card shadow h-100 py-2" style="border-radius:30px" id="zoom">
                                <div class="card-body" style="text-align:center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" class="mb-3"
                                        fill="#05AF65" class="bi bi-person-fill-check" viewBox="0 0 16 16">
                                        <path
                                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                        <path
                                            d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                                    </svg>
                                    <div class="col-md-12">
                                        <h6 class="justify-content-end"><b>Modificar Entidad</b></h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <a href="{{ route('superadmin.usuarios') }}" style="text-decoration: none;">
                            <div class="card shadow h-100 py-2" style="border-radius:30px" id="zoom">
                                <div class="card-body" style="text-align:center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#05AF65" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/>
                                      </svg>
                                    <div class="col-md-12">
                                        <h6 class="justify-content-end"><b>Gestor de Usuarios</b></h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <a href="{{ route('superadmin.inmuebles_show') }}" style="text-decoration: none;">
                            <div class="card shadow h-100 py-2" style="border-radius:30px" id="zoom">
                                <div class="card-body" style="text-align:center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#05AF65" class="bi bi-house-check-fill mb-3" viewBox="0 0 16 16">
                                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                                        <path d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514"/>
                                      </svg>
                                    <div class="col-md-12">
                                        <h6 class="justify-content-end"><b>Gestor de Inmuebles</b></h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
