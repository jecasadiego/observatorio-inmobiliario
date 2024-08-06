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

    <!--Icon-->
    <link rel="icon" href="{{ asset('img/ico-yopal.png') }}">


    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    @livewireStyles

    <!-- Styles -->

</head>

<body class="font-sans antialiased">
    <x-banner />
    <div id="spinner-overlay"></div>
    <div id="spinner"></div>

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')


        <!-- Page Content -->
        <main class="mb-5">
            {{ $slot }}
        </main>
        <x-footer />
    </div>
    <x-toast></x-toast>
    @stack('modals')

    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function showToast(message) {
                var toast = document.getElementById('toast');
                var toastMessage = document.getElementById('toast-message');
                toastMessage.textContent = message;
                toast.classList.add('show');
                const notificationId = '{{ optional(auth()->user()->unreadNotifications->first())->id }}';
                setTimeout(closeToast(notificationId), 5000);
            }

            function closeToast(notificationId) {
                var toasts = document.querySelectorAll('.toast');
                toasts.forEach(function(toast) {
                    toast.classList.remove('show');
                });

                if (notificationId) {
                    fetch(`/notifications/${notificationId}/mark-as-read`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(response => {
                        if (response.ok) {
                            // Ocultar el toast
                            const toast = document.getElementById('toast');
                            if (toast) {
                                toast.classList.remove('show');
                            }
                        }
                    });
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showToast("{{ session('success') }}", 'success');
            @elseif (session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif
            @if (auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                showToast("{{ auth()->user()->notifications->first()->data['message'] }}", 'success');
            @endif
        });

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
                let timeout = setTimeout(function() {
                    if (document.readyState === 'complete') {
                        hideSpinner();
                    } else {

                        let intervalCheck = setInterval(function() {
                            if (document.readyState === 'complete') {
                                hideSpinner();
                                clearInterval(intervalCheck);
                            }
                        }, 100);
                    }
                }, 3000);
            });


            window.addEventListener('load', function() {
                hideSpinner();
            });

            window.addEventListener('beforeunload', function() {
                showSpinner();
            });
        });
    </script>
</body>

</html>
