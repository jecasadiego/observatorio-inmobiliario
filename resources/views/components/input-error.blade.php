@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'alert alert-danger mt-3']) }}>{{ $message }}</p>
@enderror
