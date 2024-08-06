@props(['route', 'params' => []])

@php
    $url = route($route, $params);
@endphp

<a href="{{ $url }}" class="p-0 pt-2 mb-3 fw-bold text-decoration-none text-black fw-bold">
    <img class="pe-3 pb-1" src="{{ asset('img/back.svg') }}" alt="regresar">Regresar
</a>
