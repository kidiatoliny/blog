<nav {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
    <a href="{{ route('home') }}" class="font-medium text-indigo-400 underline">
        Home
    </a>

    @if (! empty($parent))
        <span class="opacity-30">/</span>

        <a href="{{ $parent->attributes->get('href', '#') }}" {{ $parent->attributes->merge([
            'class' => 'font-medium text-indigo-400 underline',
        ]) }}>
            {!! $parent !!}
        </a>
    @endif

    <span class="opacity-30">/</span>

    <span class="opacity-50 line-clamp-1">
        {{ $slot }}
    </span>
</nav>
