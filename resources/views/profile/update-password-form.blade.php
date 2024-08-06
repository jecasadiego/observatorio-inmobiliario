<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Actualizar contraseña') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantenerse segura.') }}
    </x-slot>

    <x-slot name="form">
        <div class="">
            <x-label for="current_password" class="form-label" value="{{ __('Contraseña actual') }}" />
            <x-input id="current_password" type="password" class="form-control" wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="mt-3">
            <x-label for="password" class="form-label" value="{{ __('Nueva contraseña') }}" />
            <x-input id="password" type="password" class="form-control" wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="mt-3">
            <x-label for="password_confirmation" class="form-label" value="{{ __('Confirme la contraseña') }}" />
            <x-input id="password_confirmation" type="password" class="form-control" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Contraseña guardada.') }}
        </x-action-message>

        <x-button class="btn bg-verde text-white">
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-form-section>
