<x-app-layout>

    <div class="container">
        <x-regresar route="superadmin.inmuebles_show" />
        <x-header>
            <x-slot name="texto">Gestor de Inmuebles</x-slot>
        </x-header>
    </div>

    <div class="container mt-5">

        <table class="table table-custom table-hover">
            <thead class="">
                <tr class="text-center">
                    <th>Id</th>
                    <th>Nombre del Inmueble</th>
                    <th>Creador</th>
                    <th>Valor</th>
                    <th>Activo</th>
                    <th>Observacion</th>
                    <th>Ver</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($inmueblesPendientes as $inmueble)
                    <tr class="text-center">
                        <td>{{ $inmueble->id }}</td>
                        <td>{{ $inmueble->nombre_inmueble }}</td>
                        <td>{{ $inmueble->user->name }}</td>
                        <td>${{ $inmueble->valor_arriendo_venta_formatted }} COP</td>
                        <td>{{ $inmueble->active ? 'Si' : 'No' }}</td>
                        <td>
                            <p class="text-justify">{{ $inmueble->observacion }}</p>
                        </td>
                        <td>
                            <a href="{{ route('inmuebles.ver_inmueble', $inmueble->id) }}" target="_blank"
                                class="btn bg-verde text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                </svg>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('superadmin.aprobar_inmueble', $inmueble->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn bg-verde text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                                    </svg>
                                </button>
                            </form>
                            <form action="{{ route('superadmin.rechazar_inmueble', $inmueble->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .table-custom thead th {
            background-color: #047d49;
            color: #fff;
        }
    </style>

</x-app-layout>
