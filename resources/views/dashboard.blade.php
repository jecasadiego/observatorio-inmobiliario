<x-app-layout>
    <div class="container">
        <p class="p-0">Inicio</p>
        <hr style="width: 80%">
        <x-header>
            <x-slot name="texto">Resumen de mis inmuebles</x-slot>
        </x-header>

        <div class="mt-5 bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-welcome :inmueblesVentaActivos="$inmueblesVentaActivos" :inmueblesVentaInactivos="$inmueblesVentaInactivos" :inmueblesArriendoActivos="$inmueblesArriendoActivos" :inmueblesArriendoInactivos="$inmueblesArriendoInactivos" :inmueblesAVencer="$inmueblesAVencer" />
        </div>

    <style>
        body {
            background-color: #F4F4F4;
        }
    </style>
</x-app-layout>
