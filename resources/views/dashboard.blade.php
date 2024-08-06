<x-app-layout>
    <x-slot name="header">
        <p class="header-text">Inicio</p>
    </x-slot>

    <x-title>
        <p class="title-text">Resumen de mis inmuebles</p>
    </x-title>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 resumen_inmuebles">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
    <style>

        .resumen_inmuebles {
            width: 92%;
            margin-top: 2rem;
        }

        .stat-item {
            background-color: #ffffff;
            border: 1px solid #bebebe;
            border-radius: 5px;
            padding: 10px;
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            width: 100%;
            transition: background-color 0.1s  ease-in; /* Transición suave del fondo */

            /* Asegura que toma todo el espacio disponible hasta el 30% */
        }

        .stat-item .stat-number {
            width: 35px;
            height: 35px;
            background-color: #05AF60;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .stat-item.eliminados .stat-number {
            background-color: #05AF65;
        }

        .stat-item .stat-label {
            flex-grow: 1;
            font-weight: bold;
        }

        .stat-item:hover {
            background-color: #05AF65;
        }
    </style>
</x-app-layout>
