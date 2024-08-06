<x-app-layout>

    <div class="container">
        <x-regresar route="superadmin.index" />
        <x-header>
            <x-slot name="texto">Gestor de Inmuebles</x-slot>
        </x-header>
    </div>

    <div class="container mt-5">

        <a href="{{ route('superadmin.inmuebles_pendientes') }}" class="btn bg-verde text-white mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                class="bi bi-exclamation-circle-fill pb-1" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4m.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
            </svg>
            Inmuebles Pendientes: <strong>{{ $inmueblesPendientes }}</strong>
        </a>
        <a target="_blank" href="{{ route('superadmin.exportar_csv') }}"
            class="btn bg-verde text-white mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                <path d="M6 12v-2h3v2z" />
                <path
                    d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3z" />
            </svg>
            Descargar CSV
        </a>



        <table class="table table-custom table-hover">
            <thead class="">
                <tr class="text-center">
                    <th>Id</th>
                    <th>Nombre del Inmueble</th>
                    <th>Creador</th>
                    <th>Valor</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($inmuebles as $inmueble)
                    <tr class="text-center">
                        <td>{{ $inmueble->id }}</td>
                        <td>{{ $inmueble->nombre_inmueble }}</td>
                        <td>{{ $inmueble->user->name }}</td>
                        <td>${{ $inmueble->valor_arriendo_venta_formatted }} COP</td>
                        <td>{{ $inmueble->active ? 'Si' : 'No' }}</td>
                        <td>
                            <a href="{{ route('inmuebles.ver_inmueble', $inmueble->id) }}" target="_blank"
                                class="btn bg-verde text-white"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                </svg></a>
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
