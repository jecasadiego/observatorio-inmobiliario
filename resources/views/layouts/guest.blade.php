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
    <link rel="icon" href="{{ asset('img/ico-yopal.png') }}">


    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <div id="spinner-overlay"></div>
    <div id="spinner"></div>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
    <x-toast></x-toast>
    @livewireScripts
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            showToast("{{ session('success') }}", 'success');
        @elseif (session('error'))
            showToast("{{ session('error') }}", 'error');
        @endif
    });

    function showToast(message) {
        var toast = document.getElementById('toast');
        var toastMessage = document.getElementById('toast-message');
        toastMessage.textContent = message;
        toast.classList.add('show');
        setTimeout(closeToast, 5000);
    }

    function closeToast() {
        var toasts = document.querySelectorAll('.toast');
        toasts.forEach(function(toast) {
            toast.classList.remove('show');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        var spinner = document.getElementById('spinner');
        var spinnerOverlay = document.getElementById('spinner-overlay');

        function showSpinner() {
            spinner.style.display = 'block';
            spinnerOverlay.style.display = 'block';
        }

        function hideSpinner() {
            spinner.style.display = 'none';
            spinnerOverlay.style.display = 'none';
        }

        document.addEventListener('submit', function() {
            showSpinner();
        });

        window.addEventListener('load', function() {
            hideSpinner();
        });

        window.addEventListener('beforeunload', function() {
            showSpinner();
        });
    });
</script>

</html>
