@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-2xl bg-slate-900 px-4 py-3 text-start text-base font-semibold text-white transition duration-150 ease-in-out'
            : 'block w-full rounded-2xl px-4 py-3 text-start text-base font-semibold text-slate-600 transition duration-150 ease-in-out hover:bg-amber-50 hover:text-slate-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
