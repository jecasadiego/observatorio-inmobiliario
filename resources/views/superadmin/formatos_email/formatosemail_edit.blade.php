<x-app-layout>
    <div class="container">
        <x-regresar route="superadmin.formatos_email" />
        <x-header>
            <x-slot name="texto">Editar Formato de Email</x-slot>
        </x-header>
    </div>

    <div class="container mt-5 mb-5">
        <div class="card mb-3 p-3 bg-light shadow rounded ">
            <div class="card-body">
                <h5 class="card-title">Editar Formato</h5>
                <form action="{{ route('superadmin.formatos_email_update', $formato->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{{ $formato->nombre }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" required rows="5">{!! $formato->descripcion !!}</textarea>
                    </div>

                    <div class="form-group mb-3 align-items-center Labels" id="bodyLabels">
                    </div>
                    <div class="form-group mb-3">
                        <label for="active">Activo</label>
                        <select class="form-control" id="active" name="active" required>
                            <option value="1" {{ $formato->active == 1 ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ $formato->active == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    <button type="submit" class="btn bg-verde text-white">Actualizar</button>
                </form>

            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/formatoemail/labels.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('descripcion');
    </script>
</x-app-layout>