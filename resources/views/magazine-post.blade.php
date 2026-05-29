@extends('layouts.app')
@section('content')
<div class="bg-black text-white relative z-10">
    <div class="relative pt-14 min-h-[50vh] flex items-end">
        @if($magazinePost->featured_image)
            <img class="absolute inset-0 size-full object-cover -z-10"
                 src="{{ $magazinePost->featured_image }}" alt="{{ $magazinePost->title }}" />
        @else
            <div class="absolute inset-0 bg-zinc-900 -z-10"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-black/10 -z-10"></div>
        <div class="w-full max-w-5xl mx-auto px-6 lg:px-8 pb-10 space-y-4">
            @if($magazinePost->category)
                <p class="text-amber-400 text-xs uppercase tracking-widest">{{ $magazinePost->category }}</p>
            @endif
            <h1 class="text-4xl md:text-5xl font-light">{{ $magazinePost->title }}</h1>
            <p class="text-zinc-400 text-sm">
                @if($magazinePost->author) By {{ $magazinePost->author }} &bull; @endif
                {{ $magazinePost->published_at?->format('F j, Y') }}
            </p>
        </div>
    </div>

    <div class="w-full max-w-3xl mx-auto px-6 lg:px-8 py-12">
        @if($magazinePost->excerpt)
            <p class="text-xl text-zinc-300 font-light leading-relaxed mb-8 border-l-2 border-amber-400 pl-4">
                {{ $magazinePost->excerpt }}
            </p>
        @endif

        @if($magazinePost->content)
            <div class="prose prose-invert prose-lg max-w-none text-zinc-300 font-light leading-relaxed">
                {!! $magazinePost->content !!}
            </div>
        @endif

        <div class="mt-12 pt-8 border-t border-zinc-800">
            <a href="{{ route('magazine.index') }}"
               class="text-amber-400 hover:underline text-sm">&larr; Back to Magazine</a>
        </div>
    </div>
</div>
@endsection