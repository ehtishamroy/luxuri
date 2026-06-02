@extends('layouts.app')

@section('content')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Product",
    "name": "{{ $villa->title }}",
    "description": "{{ strip_tags($villa->description) }}",
    "image": {!! json_encode($villa->images ?? []) !!},
    "offers": {
        "@@type": "AggregateOffer",
        "priceCurrency": "USD",
        "lowPrice": {{ $villa->price_per_night ?? 0 }},
        "highPrice": {{ $villa->price_per_night ?? 0 }},
        "availability": "https://schema.org/InStock"
    }
}
</script>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<main class="z-0 text-zinc-50 font-light">

    {{-- Hero Section --}}
    <div class="bg-black text-white relative -mb-34">
        <div class="relative isolate pt-14 flex flex-col justify-center items-center overflow-hidden">
            @if($villa->hero_image)
                <img class="absolute inset-0 -z-10 size-full object-cover blur-md opacity-70" src="{{ $villa->hero_image }}" alt="{{ $villa->title }}">
            @endif
            <div class="absolute top-0 left-0 pointer-events-none w-full h-26 -z-10 bg-gradient-to-b from-black from-0% via-black/15 via-70% to-black/0 to-95% bg-blend-overlay"></div>
            <div class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>

            <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
                {{-- Gallery Grid --}}
                @if(!empty($villa->image_urls) && count($villa->image_urls) > 0)
                <div class="relative grid grid-cols-4 lg:grid-rows-2 gap-4 h-[40svh] min-h-96">
                    @foreach(array_slice($villa->image_urls, 0, 5) as $index => $img)
                        <button type="button"
                            class="bg-zinc-900 rounded-2xl shadow-lg relative overflow-hidden group cursor-pointer
                                {{ $index === 0 ? 'col-span-4 lg:col-span-2 lg:row-span-2 h-full' : 'max-md:hidden' }}"
                            @click="$dispatch('open-gallery-modal', { tab: 'gallery', mediaId: {{ $index }} })">
                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 "
                                src="{{ $img }}" alt="{{ $villa->title }} {{ $index + 1 }}">
                        </button>
                    @endforeach
                    @if(count($villa->image_urls) > 5)
                    <div class="absolute bottom-4 right-4">
                        <button type="button"
                            class="rounded-md bg-zinc-50 px-2.5 py-1.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 border border-zinc-400/50 shadow-lg"
                            @click="$dispatch('open-gallery-modal', { tab: 'gallery' })">
                            View all images
                        </button>
                    </div>
                    @endif
                </div>
                @endif
                <div class="h-26"></div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6 relative !pb-0">
        <div class="grid lg:grid-cols-3 gap-6">

            {{-- Left Column: Title / Stats / Description / Amenities --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Title --}}
                <div>
                    <h1 class="uppercase font-semibold mt-2">{{ $villa->title }}</h1>
                </div>

                {{-- Stats --}}
                <div class="flex flex-wrap gap-1.5 mb-3 text-zinc-50">
                    @if($villa->bedrooms)
                    <div><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> {{ $villa->bedrooms }} Bedrooms</div>
                    @endif
                    @if($villa->bedrooms && $villa->max_guests)<span>&middot;</span>@endif
                    @if($villa->max_guests)
                    <div><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> {{ $villa->max_guests }} Sleeps</div>
                    @endif
                    @if(($villa->bedrooms || $villa->max_guests) && $villa->bathrooms)<span>&middot;</span>@endif
                    @if($villa->bathrooms)
                    <div><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i> {{ $villa->bathrooms }} Bathrooms</div>
                    @endif
                </div>

                {{-- Description --}}
                @if($villa->description)
                <div class="text-zinc-50 relative" x-data="{ expanded: false }">
                    <div x-show="expanded" x-collapse.min.120px>
                        <div class="pb-9">
                            {!! $villa->description !!}
                        </div>
                    </div>
                    <div x-show="!expanded" class="line-clamp-5">
                        {!! Str::limit(strip_tags($villa->description), 400) !!}
                    </div>
                    <div class="pt-6 bg-gradient-to-b from-black/10 from-0% to-black to-70% bg-blend-overlay absolute bottom-0 w-full">
                        <button class="uppercase text-xs block w-full text-center" @click="expanded = !expanded">
                            <span x-text="expanded ? '- Less' : '+ More'"></span>
                        </button>
                    </div>
                </div>
                @endif

                {{-- Amenities --}}
                @if($villa->amenitiesList && $villa->amenitiesList->isNotEmpty())
                <div class="space-y-6">
                    <hr class="opacity-30 my-8">
                    <div class="flex justify-between">
                        <h2 class="text-3xl uppercase font-normal">Luxury Amenities</h2>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($villa->amenitiesList->take(16) as $amenity)
                        <div class="flex items-start gap-3 font-normal">
                            <div>
                                <i class="fa-sharp fa-light {{ $amenity->icon }} fa-fw fa-lg"></i>
                            </div>
                            <div>{{ $amenity->name }}</div>
                        </div>
                        @endforeach
                    </div>
                    @if($villa->amenitiesList->count() > 16)
                    <div x-data="{ modalIsOpen: false }">
                        <button type="button"
                            class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300"
                            @click="modalIsOpen = true">
                            See all amenities
                        </button>
                        <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
                             @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false"
                             class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                             role="dialog" aria-modal="true">
                            <div x-show="modalIsOpen"
                                 x-transition:enter="transition ease-out duration-200 delay-100"
                                 x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                                 class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden border border-zinc-50/30 w-4xl !max-w-full">
                                <div class="flex items-center gap-4 justify-between px-6 py-4">
                                    <h3 class="font-semibold tracking-wide text-white">Amenities</h3>
                                    <button @click="modalIsOpen = false" aria-label="close modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                             stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="px-6 py-4 overflow-y-auto">
                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                        @foreach($villa->amenitiesList as $amenity)
                                        <div class="flex items-center gap-2 text-zinc-300">
                                            <i class="fa-sharp fa-light {{ $amenity->icon }} fa-fw"></i>
                                            <span class="text-sm">{{ $amenity->name }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            {{-- Right Sidebar --}}
            <div class="lg:sticky lg:top-24 h-fit lg:row-span-2 space-y-6">
                <div class="bg-zinc-900 rounded-xl p-6 space-y-4">

                    {{-- Price --}}
                    @if($villa->price_per_night > 0)
                    <div class="text-center">
                        <span class="text-3xl font-light">${{ number_format($villa->price_per_night) }}</span>
                        <span class="text-zinc-400 text-sm">/night</span>
                    </div>
                    @else
                    <div class="text-center">
                        <span class="text-2xl font-light text-zinc-300">Price on request</span>
                    </div>
                    @endif
                    @if($villa->price_per_hour)
                    <div class="text-center">
                        <span class="text-lg font-light text-zinc-300">${{ number_format($villa->price_per_hour, 2) }}</span>
                        <span class="text-zinc-500 text-sm">/hour</span>
                    </div>
                    @endif


                    {{-- Reserve Button --}}
                    <a href="{{ url('/inquiry?villa=' . $villa->slug) }}"
                       class="flex items-center justify-center rounded-md bg-zinc-50 px-2.5 py-2.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 w-full">
                        Reserve
                    </a>

                    <a href="{{ route('contact') }}"
                       class="block text-center w-full rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
                        Request Information
                    </a>

                    {{-- Stats --}}
                    <ul class="space-y-2 text-sm text-zinc-400 pt-2 border-t border-zinc-800">
                        @if($villa->bedrooms)
                        <li class="flex justify-between"><span>Bedrooms</span><span class="text-white">{{ $villa->bedrooms }}</span></li>
                        @endif
                        @if($villa->bathrooms)
                        <li class="flex justify-between"><span>Bathrooms</span><span class="text-white">{{ $villa->bathrooms }}</span></li>
                        @endif
                        @if($villa->max_guests)
                        <li class="flex justify-between"><span>Max Guests</span><span class="text-white">{{ $villa->max_guests }}</span></li>
                        @endif
                        @if($villa->location)
                        <li class="flex justify-between"><span>Location</span><span class="text-white text-right max-w-[60%]">{{ $villa->location }}</span></li>
                        @endif
                    </ul>

                    {{-- Fees --}}
                    @if(!empty($villa->fees))
                    <div class="mt-4 pt-4 border-t border-zinc-800">
                        <h4 class="text-sm font-semibold text-zinc-200 mb-2">Additional Fees</h4>
                        <div class="space-y-2 text-sm">
                            @foreach($villa->fees as $fee)
                            <div class="flex justify-between">
                                <span class="text-zinc-400">{{ $fee['name'] ?? 'Fee' }}</span>
                                <span class="text-white">${{ number_format($fee['amount'] ?? 0, 2) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Security Deposit --}}
                    @if($villa->security_deposit_amount)
                    <div class="mt-4 pt-4 border-t border-zinc-800">
                        <div class="text-sm text-zinc-300">
                            <span class="font-medium">Refundable Security Deposit:</span>
                            ${{ number_format($villa->security_deposit_amount, 2) }} will be collected at time of booking.
                        </div>
                    </div>
                    @endif

                    {{-- Policies --}}
                    @php
                        $policies = $villa->policies_text ?: ($globalSettings->global_policies_text ?? null);
                    @endphp
                    @if($policies)
                    <div class="mt-4 pt-4 border-t border-zinc-800">
                        <h4 class="text-sm font-semibold text-zinc-200 mb-2">Policies</h4>
                        <div class="text-xs text-zinc-400 leading-relaxed">
                            {!! nl2br(e($policies)) !!}
                        </div>
                    </div>
                    @endif

                    {{-- Processing Fee Notice --}}
                    @if($globalSettings->global_processing_fee_text ?? false)
                    <div class="mt-4 pt-4 border-t border-zinc-800">
                        <div class="text-xs text-zinc-400 leading-relaxed">
                            {!! nl2br(e($globalSettings->global_processing_fee_text)) !!}
                        </div>
                    </div>
                    @endif

                    {{-- Contact --}}
                    @php
                        $contactPhone = $villa->contact_phone ?: ($globalSettings->global_contact_phone ?? null);
                        $contactEmail = $villa->contact_email ?: ($globalSettings->global_contact_email ?? null);
                    @endphp
                    @if($contactPhone || $contactEmail)
                    <div class="mt-4 pt-4 border-t border-zinc-800">
                        <h4 class="text-sm font-semibold text-zinc-200 mb-2">Contact</h4>
                        @if($contactPhone)
                        <div class="text-sm text-zinc-400"><i class="fa-light fa-phone me-2"></i>{{ $contactPhone }}</div>
                        @endif
                        @if($contactEmail)
                        <div class="text-sm text-zinc-400 mt-1"><i class="fa-light fa-envelope me-2"></i>{{ $contactEmail }}</div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            {{-- Left Column: Map / Related Villas --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Map --}}
                @if($villa->latitude && $villa->longitude)
                <div class="space-y-4">
                    <hr class="opacity-30 my-8">
                    <h2 class="text-3xl uppercase font-normal">Where You'll Be</h2>
                    <div class="rounded-2xl overflow-hidden">
                        <div id="map" class="h-96 w-full"></div>
                    </div>
                </div>
                @endif

                {{-- Related Villas --}}
                @if(isset($related) && $related->isNotEmpty())
                <div class="space-y-6">
                    <hr class="opacity-30 my-8">
                    <h2 class="text-3xl uppercase font-normal">Similar Villas</h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($related as $r)
                        <a href="{{ route('villas.show', $r->slug) }}" class="group block space-y-3">
                            <div class="overflow-hidden rounded-xl aspect-video">
                                <img class="size-full object-cover transition-transform duration-500"
                                     loading="lazy" src="{{ $r->hero_image ?? asset('assets/images/placeholder.jpg') }}" alt="{{ $r->title }}" />
                            </div>
                            <h3 class="text-white font-light group-hover:text-amber-200 transition-colors">{{ $r->title }}</h3>
                            @if($r->price_per_night > 0)
                                <p class="text-zinc-400 text-sm">From ${{ number_format($r->price_per_night) }}/night</p>
                            @else
                                <p class="text-zinc-400 text-sm">Price on request</p>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>

{{-- Gallery Modal --}}
@if(!empty($villa->image_urls))
<div x-data="galleryModal()" @open-gallery-modal.window="open($event.detail.mediaId)" class="contents">
    <div x-show="isOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-trap.inert.noscroll="isOpen"
         @keydown.escape.window="close()" @click.self="close()"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-md"
         role="dialog" aria-modal="true" x-cloak>

        <div x-show="isOpen"
             x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-500"
             x-transition:enter-start="opacity-0 scale-90 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="relative md:w-[90%] max-w-7xl h-[90vh] flex flex-col bg-zinc-900 rounded-xl overflow-hidden border border-zinc-800">

            <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-800 shrink-0">
                <h3 class="text-xl font-semibold text-zinc-100">{{ $villa->title }} Gallery</h3>
                <button @click="close()" class="p-2 hover:bg-zinc-800 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 text-zinc-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="flex-1 relative flex items-center justify-center bg-black overflow-hidden">
                <button @click="prev()" class="absolute left-4 z-10 p-2 bg-black/50 hover:bg-black/70 rounded-full text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <img :src="images[selectedIndex]" :alt="'{{ $villa->title }} ' + (selectedIndex + 1)"
                     class="max-h-full max-w-full object-contain">

                <button @click="next()" class="absolute right-4 z-10 p-2 bg-black/50 hover:bg-black/70 rounded-full text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <div class="shrink-0 h-20 px-4 py-2 bg-zinc-900 border-t border-zinc-800 overflow-x-auto no-scrollbar"
                 x-effect="$nextTick(() => { const container = $el; const active = container.children[0]?.children[selectedIndex]; if(active) active.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' }); })">
                <div class="flex gap-2 h-full items-center">
                    <template x-for="(image, index) in images" :key="index">
                        <button @click="selectedIndex = index"
                                class="h-14 w-20 flex-shrink-0 rounded-md overflow-hidden transition-all border-2"
                                :class="selectedIndex === index ? 'border-amber-500 opacity-100 scale-105' : 'border-transparent opacity-50 hover:opacity-90'">
                            <img :src="image" :alt="'{{ $villa->title }} ' + (index + 1)" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function galleryModal() {
        return {
            isOpen: false,
            selectedIndex: 0,
            images: {!! json_encode($villa->image_urls) !!},
            open(mediaId) {
                if (mediaId !== undefined && mediaId !== null) {
                    const idx = parseInt(mediaId);
                    if (!isNaN(idx) && idx >= 0 && idx < this.images.length) {
                        this.selectedIndex = idx;
                    }
                }
                this.isOpen = true;
            },
            close() { this.isOpen = false; },
            next() { this.selectedIndex = (this.selectedIndex + 1) % this.images.length; },
            prev() { this.selectedIndex = (this.selectedIndex - 1 + this.images.length) % this.images.length; }
        }
    }
</script>
@endif

{{-- Leaflet Map --}}
@if($villa->latitude && $villa->longitude)
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const map = L.map('map').setView([{{ $villa->latitude }}, {{ $villa->longitude }}], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
        L.marker([{{ $villa->latitude }}, {{ $villa->longitude }}]).addTo(map)
            .bindPopup('{{ addslashes($villa->title) }}')
            .openPopup();
    });
</script>
@endif

@endsection