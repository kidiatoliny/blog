@php
use App\Models\Merchant;

try {
    $merchant = Merchant::query()
        ->where('id', $id)
        ->orWhere('slug', $id)
        ->orWhere('name', $id)
        ->first();

    $slug = $slug ?? $merchant->slug;
    $content = $content ?? $merchant->presenter()->content();
    $screenshot = $screenshot ?? $merchant->screenshot;
    $key_features = $key_features ?? $merchant->presenter()->keyFeatures();
    $pros = $pros ?? $merchant->presenter()->pros();
    $cons = $cons ?? $merchant->presenter()->cons();
} catch (Exception $e) {
    echo '<p class="font-bold text-red-400">' . $e->getMessage() . '</p>';
    return;
}
@endphp

<h3 id="{{ $slug }}">
    <a href="#{{ $slug }}">
        {{ $merchant->name }}
    </a>
</h3>

{!! $content !!}

@if ($screenshot)
    <a href="{{ route('merchants.show', $merchant) }}">
        <img src="{{ $screenshot }}" alt="{{ $merchant->name }}" />
    </a>
@endif

@if ($key_features)
    <h4>Key features of {{ $merchant->name }}</h4>
    {!! $key_features !!}
@endif

@if ($pros)
    <h4>Here's what I love about {{ $merchant->name }}</h4>
    {!! $pros !!}
@endif

@if ($cons)
    <h4>And what's not so good about {{ $merchant->name }}</h4>
    {!! $cons !!}
@endif

<p><a href="{{ route('merchants.show', $merchant) }}">Try {{ $merchant->name }}</a></p>
