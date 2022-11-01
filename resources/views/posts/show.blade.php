<x-app
    :title="$post->title"
    :description="$post->description"
    :image="$post->image"
>
    <div class="container sm:flex sm:items-center sm:justify-between mt-8 text-center sm:text-left">
        <x-blog.title />

        <nav class="flex items-center justify-center sm:justify-start gap-8 mt-8 sm:mt-0">
            <a href="{{ route('posts.index') }}" class="text-xs tracking-widest uppercase">
                Blog
            </a>

            <x-hire-me />
        </nav>
    </div>

    <x-breadcrumb class="container mt-8 sm:mt-16">
        <x-breadcrumb-item href="{{ route('posts.index') }}">
            Blog
        </x-breadcrumb-item>

        <x-breadcrumb-item class="truncate">
            {{ $post->title }}
        </x-breadcrumb-item>
    </x-breadcrumb>

    <div class="container lg:grid lg:grid-cols-3 lg:gap-16 mt-8 relative">
        <article class="lg:col-span-2">
            {{-- Title --}}
            <h1 class="font-thin text-3xl md:text-5xl">
                {{ $post->title }}
            </h1>

            {{-- Metadata --}}
            <div class="flex items-center gap-2 mt-4 text-sm">
                <img src="https://www.gravatar.com/avatar/{{ md5('benjamincrozat@me.com') }}" width="18" height="18" alt="Benjamin Crozat's avatar." class="-translate-y-[.5px] rounded-full" />

                <a href="https://benjamincrozat.com" class="font-normal underline" @click="window.fathom?.trackGoal('LNRXVF3B', 0)">Benjamin Crozat</a>
                —
                @choice(':count minute|:count minutes', $post->getReadTime()) read
            </div>

            <x-blog.toc :toc="$post->getTableOfContents()" class="lg:hidden mt-8" />

            {{-- Content --}}
            <div class="break-words max-w-full mt-8 prose prose-a:border-b prose-a:border-indigo-200 prose-a:text-indigo-400 prose-a:no-underline">
                {!! Illuminate\Support\Str::marxdown($post->content) !!}
            </div>
        </article>

        <div class="hidden md:block md:col-span-1 text-sm">
            <x-blog.toc :toc="$post->getTableOfContents()" />

            <div>
                <p class="font-normal mt-8">
                    Let me share with you my discoveries about the art of crafting websites, <span class="text-indigo-400">for free</span>.
                </p>

                <x-form method="POST" action="{{ route('subscribe') }}" class="mt-4">
                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="homer@simpson.com"
                        required
                        class="block border-gray-200 placeholder-gray-200 rounded text-sm w-full"
                    />

                    <button type="submit" class="font-bold mt-4 mx-auto table text-indigo-400">
                        Sign me up!
                    </button>
                </x-form>
            </div>
        </div>
    </div>

    <x-newsletter class="container md:hidden sm:max-w-[480px] mt-16" />

    {{-- Other posts to read --}}
    @if ($others->isNotEmpty())
        <div class="container py-16">
            <p class="font-bold text-center text-xl">Other posts to read</p>

            <div class="grid sm:grid-cols-2 gap-12 sm:gap-8 mt-8">
                @foreach ($others as $post)
                    <x-post :post="$post" @clicked="window.fathom?.trackGoal('LTFJEOM0', 0)" />
                @endforeach
            </div>
        </div>
    @endif

    <div class="bg-gray-900 flex-grow">
        <x-footer class="text-gray-200" />
    </div>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "headline": "{{ $post->title }}",
            "datePublished": "{{ $post->getPublishedAtDate()?->toIso8601String() }}",

            @if ($post->getModifiedAtDate())
                "dateModified": "{{ $post->getModifiedAtDate()?->toIso8601String() }}",
            @endif

            "author": [
                {
                    "@type": "Person",
                    "name": "Benjamin Crozat",
                    "url": "{{ route('home') }}"
                }
            ]
        }
    </script>
</x-app>
