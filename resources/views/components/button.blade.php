<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn bg-verde text-white flex items-center justify-end text-end btn bg-verde text-white']) }}>
    {{ $slot }}
</button>
