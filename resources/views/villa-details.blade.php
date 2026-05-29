@extends('layouts.app')
@section('content')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "{{ $villa->title }}",
    "description": "{{ strip_tags($villa->description) }}",
    "image": @json($villa->images ?? []),
    "offers": {
        "@type": "AggregateOffer",
        "priceCurrency": "USD",
        "lowPrice": {{ $villa->price_per_night ?? 0 }},
        "highPrice": {{ $villa->price_per_night ?? 0 }},
        "availability": "https://schema.org/InStock"
    }
}
</script>

<div class="bg-black text-white relative z-10">
    {{-- Hero --}}
    <div class="relative pt-14 min-h-[60vh] flex items-end">
        @if($villa->first_image)
            <img class="absolute inset-0 size-full object-cover -z-10"
                 src="{{ $villa->first_image }}" alt="{{ $villa->title }}" />
        @else
            <div class="absolute inset-0 bg-zinc-900 -z-10"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-black/10 -z-10"></div>
        <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 pb-10 space-y-4">
            @if($villa->destination)
                <a href="{{ route('destinations.show', $villa->destination->slug) }}"
                   class="text-amber-300 text-xs uppercase tracking-widest hover:underline">
                    {{ $villa->destination->name }}
                </a>
            @endif
            <h1 class="text-4xl md:text-5xl font-light">{{ $villa->title }}</h1>
            <div class="flex flex-wrap gap-4 text-sm text-zinc-300">
                @if($villa->bedrooms)
                    <span>{{ $villa->bedrooms }} {{ Str::plural('Bedroom', $villa->bedrooms) }}</span>
                @endif
                @if($villa->bathrooms)
                    <span>&bull; {{ $villa->bathrooms }} {{ Str::plural('Bathroom', $villa->bathrooms) }}</span>
                @endif
                @if($villa->max_guests)
                    <span>&bull; Up to {{ $villa->max_guests }} Guests</span>
                @endif
                @if($villa->price_per_night)
                    <span>&bull; From ${{ number_format($villa->price_per_night) }}/night</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Image Gallery --}}
    @if(!empty($villa->images) && count($villa->images) > 1)
    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 py-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
            @foreach(array_slice($villa->images, 0, 8) as $img)
                <div class="overflow-hidden rounded-lg aspect-video">
                    <img class="size-full object-cover hover:scale-105 transition-transform duration-300"
                         loading="lazy" src="{{ $img }}" alt="{{ $villa->title }}" />
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Main Content --}}
    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 py-10 grid lg:grid-cols-3 gap-12">
        {{-- Left: Description & Amenities --}}
        <div class="lg:col-span-2 space-y-10">
            @if($villa->description)
            <section class="space-y-4">
                <h2 class="text-2xl font-light uppercase tracking-wide">About This Villa</h2>
                <div class="text-zinc-300 font-light leading-relaxed prose prose-invert max-w-none">
                    {!! nl2br(e($villa->description)) !!}
                </div>
            </section>
            @endif

            @if(!empty($villa->amenities))
            <section class="space-y-4">
                <h2 class="text-2xl font-light uppercase tracking-wide">Amenities</h2>
                <ul class="grid grid-cols-2 sm:grid-cols-3 gap-2 text-zinc-300 text-sm">
                    @foreach($villa->amenities as $amenity)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 shrink-0"></span>
                            {{ $amenity }}
                        </li>
                    @endforeach
                </ul>
            </section>
            @endif
        </div>

        {{-- Right: Booking Card --}}
        <div class="space-y-6">
            <div class="bg-zinc-900 rounded-2xl p-6 space-y-4 sticky top-24">
                @if($villa->price_per_night)
                    <p class="text-3xl font-light">
                        ${{ number_format($villa->price_per_night) }}
                        <span class="text-base text-zinc-400">/night</span>
                    </p>
                @endif
                <a href="{{ url('/contact') }}"
                   class="block w-full text-center py-3 px-6 rounded-xl bg-amber-400 hover:bg-amber-300 text-black font-semibold transition-colors">
                    Enquire Now
                </a>
                <ul class="space-y-2 text-sm text-zinc-400 pt-2 border-t border-zinc-800">
                    @if($villa->bedrooms)
                        <li class="flex justify-between">
                            <span>Bedrooms</span>
                            <span class="text-white">{{ $villa->bedrooms }}</span>
                        </li>
                    @endif
                    @if($villa->bathrooms)
                        <li class="flex justify-between">
                            <span>Bathrooms</span>
                            <span class="text-white">{{ $villa->bathrooms }}</span>
                        </li>
                    @endif
                    @if($villa->max_guests)
                        <li class="flex justify-between">
                            <span>Max Guests</span>
                            <span class="text-white">{{ $villa->max_guests }}</span>
                        </li>
                    @endif
                    @if($villa->location)
                        <li class="flex justify-between">
                            <span>Location</span>
                            <span class="text-white text-right max-w-[60%]">{{ $villa->location }}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    {{-- Related Villas --}}
    @if($related->isNotEmpty())
    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 py-12 border-t border-zinc-800">
        <h2 class="text-2xl font-light uppercase tracking-wide mb-8">Similar Villas</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($related as $r)
                <a href="{{ route('villas.show', $r->slug) }}"
                   class="group block space-y-3">
                    <div class="overflow-hidden rounded-xl aspect-4/3">
                        @if($r->first_image)
                            <img class="size-full object-cover group-hover:scale-110 transition-transform duration-500"
                                 loading="lazy" src="{{ $r->first_image }}" alt="{{ $r->title }}" />
                        @else
                            <div class="size-full bg-zinc-800"></div>
                        @endif
                    </div>
                    <h3 class="text-white font-light group-hover:text-amber-200 transition-colors">{{ $r->title }}</h3>
                    @if($r->price_per_night)
                        <p class="text-zinc-400 text-sm">From ${{ number_format($r->price_per_night) }}/night</p>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection