@extends('layouts.app')
@section('content')
<div class="bg-black text-white relative z-10">
    <div class="relative pt-14 min-h-[60vh] flex items-end">
        @if($destination->hero_image)
            <img class="absolute inset-0 size-full object-cover -z-10"
                 src="{{ $destination->hero_image }}" alt="{{ $destination->name }}" />
        @elseif($destination->hero_video)
            <video class="absolute inset-0 size-full object-cover -z-10" autoplay muted loop playsinline>
                <source src="{{ $destination->hero_video }}" type="video/mp4">
            </video>
        @else
            <div class="absolute inset-0 bg-zinc-900 -z-10"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-black/10 -z-10"></div>
        <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 pb-10 space-y-3">
            @if($destination->country)
                <p class="text-amber-300 text-xs uppercase tracking-widest">{{ $destination->country }}</p>
            @endif
            <h1 class="text-5xl md:text-6xl font-light uppercase tracking-widest">{{ $destination->name }}</h1>
            @if($destination->description)
                <p class="text-zinc-300 max-w-2xl text-lg font-light">{{ Str::limit(strip_tags($destination->description), 200) }}</p>
            @endif
        </div>
    </div>

    @if($destination->description)
    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 py-12">
        <div class="max-w-3xl text-zinc-300 font-light leading-relaxed text-lg">
            {!! nl2br(e($destination->description)) !!}
        </div>
    </div>
    @endif

    @php $villas = $destination->villas()->where('active', true)->latest()->get(); @endphp
    @if($villas->isNotEmpty())
    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 py-12 border-t border-zinc-800">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-light uppercase tracking-wide">Villas in {{ $destination->name }}</h2>
            <a href="{{ route('villas.index', ['destination' => $destination->slug]) }}"
               class="text-amber-300 text-sm hover:underline">View All</a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($villas->take(6) as $villa)
                <a href="{{ route('villas.show', $villa->slug) }}"
                   class="group block space-y-3">
                    <div class="overflow-hidden rounded-xl aspect-4/3">
                        @if($villa->first_image)
                            <img class="size-full object-cover group-hover:scale-110 transition-transform duration-500"
                                 loading="lazy" src="{{ $villa->first_image }}" alt="{{ $villa->title }}" />
                        @else
                            <div class="size-full bg-zinc-800"></div>
                        @endif
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-white font-light group-hover:text-amber-200 transition-colors">{{ $villa->title }}</h3>
                        <p class="text-zinc-400 text-sm">
                            @if($villa->bedrooms) {{ $villa->bedrooms }} bed &bull; @endif
                            @if($villa->max_guests) {{ $villa->max_guests }} guests @endif
                        </p>
                        @if($villa->price_per_night)
                            <p class="text-amber-300 text-sm">From ${{ number_format($villa->price_per_night) }}/night</p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection