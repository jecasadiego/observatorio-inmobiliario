<x-app-layout>
    <div class="container">
        <x-regresar route="superadmin.index" />
        <x-header>
            <x-slot name="texto">Formatos Email</x-slot>
        </x-header>
    </div>

    <div class="container mt-5 mb-5">
        <a href="{{ route('superadmin.formatos_email_create') }}" class="btn bg-verde text-white mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                class="bi bi-plus-circle-fill pb-1" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
            </svg>
            Nuevo Formato</a>
        <table class="table table-custom table-hover">
            <thead class=" table-success ">
                <tr class="text-center">
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($formatos as $formato)
                    <tr class="text-center">
                        <td>{{ $formato->id }}</td>
                        <td>{{ $formato->nombre }}</td>
                        <td>{{ $formato->active ? 'Sí' : 'No' }}</td>
                        <td>
                            <a href="{{ route('superadmin.formatos_email_edit', $formato->id) }}"
                                class="btn bg-verde text-white"><svg xmlns="http://www.w3.org/2000/svg" width="18"
                                    height="18" fill="white" class="bi bi-pencil-square pb-1 me-2"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>Editar</a>
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
