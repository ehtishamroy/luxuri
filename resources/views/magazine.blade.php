@extends('layouts.app')
@section('content')
<div class="bg-black text-white relative z-10">
    <div class="relative isolate pt-14 min-h-[60vh] flex items-center">
        @php
            $heroImage = $posts->firstWhere('featured_image', '!=', null)?->featured_image ?? 'https://media.luxteria.co/4d4b19ef720dc8ef7859871647c30dc8/featured.jpg';
        @endphp
        <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ $heroImage }}" alt="Blog hero">

        <div class="absolute inset-0 -z-10 size-full object-cover bg-black/20 bg-blend-multiply"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0">
            <div class="mx-auto py-18 max-w-5xl my-12">
                <div class="space-y-6">
                    <div class="space-y-4 text-shadow-lg/10">
                        <h1 class="text-3xl font-semibold tracking-wide text-center text-balance uppercase font-accent sm:text-5xl">
                            luxteria Blog
                        </h1>
                        <p class="text-lg font-normal text-pretty text-center">
                            Discover curated insights on luxury travel, refined living, and exclusive experiences.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    @if($posts->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8">
        @foreach($posts as $post)
        <div class="wow fadeInUp" data-wow-delay="{{ $loop->index * 50 }}ms">
            <article class="relative group puffIn text-sm">
                <div class="mb-4">
                    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-[4/3]">
                        @if($post->featured_image)
                        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110"
                             loading="lazy" src="{{ $post->featured_image }}" alt="{{ $post->title }}">
                        @else
                        <div class="size-full bg-zinc-800 flex items-center justify-center rounded-lg">
                            <span class="text-zinc-500 text-xs">No image</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="flex-1">
                    <div class="flex gap-2">
                        <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                            <a href="{{ route('magazine.show', $post->slug) }}">
                                {{ $post->title }}
                                <div class="absolute inset-0"></div>
                            </a>
                        </h3>
                    </div>

                    <div class="flex items-center gap-3 mt-3 text-xs text-zinc-400">
                        @if($post->published_at)
                        <span>{{ $post->published_at->format('F j, Y') }}</span>
                        @endif
                        @if($post->category)
                        <span class="bg-zinc-800 px-2 py-0.5 rounded">{{ $post->category }}</span>
                        @endif
                    </div>

                    @if($post->author)
                    <div class="text-zinc-500 mt-1 text-xs">By {{ $post->author }}</div>
                    @endif
                </div>
            </article>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-20">
        <p class="text-zinc-400 text-lg">No articles published yet.</p>
        <p class="text-zinc-500 text-sm mt-2">Check back soon for luxury travel insights.</p>
    </div>
    @endif
</div>

@endsection
