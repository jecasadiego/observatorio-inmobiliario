<x-guest-layout>
    <div class="container p-5 d-flex justify-content-center align-items-center vh-100">
        <div class="row bg-white text-center" style="border-radius: 10px; box-shadow: 0px -6px 46px 0px rgba(0, 0, 0, 0.1);">
            <div class="col p-5">
                <h4 class="azul">¿Olvidaste tu contraseña?</h4>
                <div class="mb-4 px-md-5">
                    {{ __('Ningún problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña que le permitirá elegir una nueva.') }}
                </div>
                <div class="text-center">
                    @session('status')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ $value }}
                    </div>
                    @endsession
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row align-items-center justify-content-center g-2">
                            <div class="col-auto">
                                <x-label for="email" class="form-label fw-semibold azul m-0" value="{{ __('Email') }}" />
                            </div>
                            <div class="col-auto col-md-6">
                                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-button class="btn bg-verde text-white rounded-pill px-5">
                                {{ __('Restablecer contraseña') }}
                            </x-button>
                        </div>
                    </form>
                    <div class="mt-2">
                        <a href="{{ route('login') }}" class="text-decoration-none azul">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        body {
            background-color: #EEFFF8;
        }
    </style>
</x-guest-layout>
