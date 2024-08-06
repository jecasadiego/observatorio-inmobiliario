<x-app-layout>

    <div class="container">
        <x-regresar route="superadmin.usuarios" />
        <x-header>
            <x-slot name="texto">Usuarios pendientes</x-slot>
        </x-header>
    </div>

    <div class="container mt-4">
        <table class="table table-custom table-hover table-responsive">
            <thead class="">
                <tr class="text-center">
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Activo</th>
                    <th>SuperAdmin</th>
                    <th>Estado</th>
                    <th>Foto Cedula</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($users as $user)
                    <tr class="text-center">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->active ? 'Sí' : 'No' }}</td>
                        <td>{{ $user->super_admin ? 'Sí' : 'No' }}</td>
                        <td>{{ $user->estado_texto }}</td>
                        <td><a class="btn btn-danger" href="{{ $user->cedula_path }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z" />
                                </svg>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('superadmin.aprobar_usuarios', $user->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <input type="hidden" name="aprobado" value="1">
                                <button type="submit" class="btn bg-verde text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                                    </svg>
                                </button>
                            </form>
                            <form action="{{ route('superadmin.aprobar_usuarios', $user->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <input type="hidden" name="aprobado" value="2">
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
