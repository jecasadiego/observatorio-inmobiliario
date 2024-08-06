<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="header-style">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        <!-- Page Content -->
        <main class="mb-5">
            {{ $slot }}
        </main>
        <x-footer />
    </div>

    @stack('modals')

    @livewireScripts
</body>

<style>
    .header-style {
        background: #fff;
        position: relative;
        padding: 20px 0 10px 0;
        /* Añadido padding inferior de 10px */
        text-align: left;
        /* Alinea el texto a la izquierda */
    }

    .header-style::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 4%;
        /* Ajusta para dejar espacio al inicio */
        right: 20%;
        /* Ajusta para dejar más espacio al final */
        height: 3px;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 1px;
    }

    .header-text {
        font-size: 1.25rem;
        /* 20px si estás usando base 16px */
        font-weight: 600;
        /* semi-bold */
        color: #1a202c;
        /* text-gray-800 */
        margin-bottom: 0;
        /* Elimina el margen inferior */
        padding-left: 3%;
        /* Ajustado para alinear con el inicio de la línea */
        padding-bottom: 10px;
        /* Espacio adicional abajo para no pegar al borde o línea */
    }

    .title-style {
        background: #fff;
        position: relative;
        padding: 20px 0;
        text-align: left;
    }

    .title-style::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 4%;
        right: 85%;
        height: 4px;
        /* Línea más gruesa */
        background: #4caf50;
        /* Color verde, ajusta según necesites */
        border-radius: 0;
        /* Línea recta sin bordes redondeados */
    }

    .title-text {
        font-size: 1.5rem;
        /* Ajusta el tamaño del texto */
        font-weight: bold;
        /* Texto en negrita */
        color: #333;
        /* Color del texto */
        margin: 0;

        padding-left: 2%;

        /* Sin márgenes adicionales para alinear correctamente */
    }

    .user-btn {
        background: transparent;
        border: none;
        color: #333;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tab-content {
        background: #ffffff;
        /* Fondo blanco para el contenido */
        padding: 20px;
        border: 1px solid #ccc;
        /* Borde sutil para el contenido */
        border-top: none;
        /* Eliminar el borde superior para unirlo con las tabs */
    }

    .nav-tabs .nav-link.active {
        background-color: #ffffff;
        border-color: #ccc #ccc #ffffff;
        /* Borde específico para fusionar con el contenido */
        border-bottom: 2px solid green;
        /* Línea verde debajo de la tab activa */
    }

    .py-12 {
        display: flex;
        /* Habilita Flexbox */
        justify-content: center;
    }
</style>

</html>
