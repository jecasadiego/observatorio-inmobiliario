<x-guest-layout>
    <div class="container p-5">
        <div class="row bg-white" style="border-radius: 10px; box-shadow: 0px -6px 46px 0px rgba(0, 0, 0, 0.1);">
            <div class="col-md-7 justify-content-center p-5">
                <h5 class="mt-3 text-center azul">Registro</h5>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
        
                    <div>
                        <x-label for="name" class="form-label fw-semibold azul" value="{{ __('Nombre Completo') }}" />
                        <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <x-label for="tipo-de-documento" class="form-label fw-semibold azul" value="{{ __('Tipo de documento') }}" />
                            <select name="tipo-de-documento" id="tipo-de-documento" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm form-control ">
                                <option value="">--Seleccionar--</option>
                                <option value="1">Cédula</option>
                                <option value="2">Pasaporte</option>
                                <option value="3">Cedula de extranjería</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <x-label for="nro_documento" class="form-label fw-semibold azul" value="{{ __('Nro. de documento') }}" />
                            <x-input id="nro_documento" class="form-control" type="text" name="nro_documento" :value="old('nro_documento')" required/>
                        </div>
                    </div>
                    <div class="mt-3">
                        <x-label for="direccion" class="form-label fw-semibold azul" value="{{ __('Dirección') }}" />
                        <x-input id="direccion" class="form-control" type="text" name="direccion" required :value="old('direccion')" />
                    </div>

                    <div class="mt-3">
                        <x-label for="telefono" class="form-label fw-semibold azul" value="{{ __('Telefono') }}" />
                        <x-input id="telefono" class="form-control" type="text" name="telefono" :value="old('telefono')" required/>
                    </div>
        
                    <div class="mt-3">
                        <x-label for="email" class="form-label fw-semibold azul" value="{{ __('Correo') }}" />
                        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <x-label for="cedula_pdf" class="form-label fw-semibold azul" value="{{ __('Documento de identidad (PDF)') }}" />
                        <x-input id="cedula_pdf" class="form-control" type="file" name="cedula_pdf" accept="application/pdf" required />
                    </div>
        
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-3">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />
        
                                    <div class="ms-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif
                    <div class="text-center mt-5">
                        <x-button class="btn bg-verde text-white rounded-pill px-5">
                            {{ __('Registrarse') }}
                        </x-button>
                    </div>
                    <div class="text-center mt-5">
                        <a href="{{ route('login') }}" class="text-decoration-none fw-medium azul">¿Ya tienes una cuenta?
                            <span class="fw-bold">Iniciar sesión</span></a>
                    </div>
                </form>
                <x-validation-errors class="mb-4" />
            </div>
            <div class="col-md-5 p-0" style="background-image: url({{ asset('img/img-registro.jpeg') }}); background-size: cover; background-position: center; border-radius: 0 10px 10px 0">
            </div>
        </div>
    </div>
    <style>
        body {
            background-color: #EEFFF8;
        }
    </style>
</x-guest-layout>
