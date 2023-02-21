@if ($promotesAffiliateLinks && $highlights->isNotEmpty())
    <div {{ $attributes->except('highlights') }}>
        <div class="grid sm:grid-cols-2 @if ($highlights->count() > 2) md:grid-cols-3 @endif place-items-center gap-4 text-center">
            @foreach ($highlights as $highlight)
                <x-posts::affiliate-highlight
                    :highlight="$highlight"
                    class="col-span-1 h-full"
                />
            @endforeach
        </div>

        <p class="mt-4 opacity-75 text-center text-xs">
            This article uses affiliate links, which can compensate me at no cost to you if you decide to pursue a deal. @if ($highlights->count() > 1) <br class="hidden md:inline" /> @endif
            I only promote products I've personally used and stand behind.
        </p>
    </div>
@endif