@extends('layouts.app')

@section('content')
@php
    $yachtPhone = $globalSettings->global_yacht_contact_phone ?? null;
    $yachtPolicies = $globalSettings->global_yacht_policies_text ?? null;
@endphp
<div class="bg-black text-white relative z-10">
    <div class="relative isolate pt-14 min-h-[40vh] flex items-center">
        @if($yacht->first_image)
        <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ $yacht->first_image }}" alt="{{ $yacht->title }}">
        @endif
        <div class="absolute inset-0 -z-10 size-full object-cover bg-black/20 bg-blend-multiply"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0">
            <div class="mx-auto py-18 max-w-5xl my-12">
                <div class="space-y-4">
                    <h1 class="text-4xl lg:text-6xl font-light tracking-tight">{{ $yacht->title }}</h1>
                    @if($yacht->location)
                    <div class="text-xl text-zinc-300">{{ $yacht->location }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="grid lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-8">
            <div class="space-y-4">
                <h1 class="text-3xl font-light">{{ $yacht->title }}</h1>
                @if($yacht->location)
                <div class="font-normal text-zinc-300">{{ $yacht->location }}</div>
                @endif
                @if($yacht->includes)
                <div class="content-format text-zinc-400">
                    Includes: {{ $yacht->includes }}
                </div>
                @endif
                @if($yacht->description)
                <div class="content-format text-zinc-300 leading-relaxed">
                    {!! $yacht->description !!}
                </div>
                @endif
            </div>

            <div class="grid grid-cols-3 gap-4">
                @if($yacht->max_guests)
                <article class="relative text-sm group rounded-xl border border-zinc-50/30">
                    <div class="p-6 text-center">
                        <div class="text-2xl text-center mb-2">
                            <i class="fa-sharp fa-light fa-seat-airline"></i>
                        </div>
                        <span class="font-medium text-base">{{ $yacht->max_guests }} guests</span>
                    </div>
                </article>
                @endif
                @if($yacht->length_ft)
                <article class="relative text-sm group rounded-xl border border-zinc-50/30">
                    <div class="p-6 text-center">
                        <div class="text-2xl text-center mb-2">
                            <i class="fa-sharp fa-light fa-arrows-left-right-to-line"></i>
                        </div>
                        <span class="font-medium text-base">{{ $yacht->length_ft }} feet</span>
                    </div>
                </article>
                @endif
                @if($yacht->style)
                <article class="relative text-sm group rounded-xl border border-zinc-50/30">
                    <div class="p-6 text-center">
                        <div class="text-2xl text-center mb-2">
                            <i class="fa-sharp fa-light fa-ship"></i>
                        </div>
                        <span class="font-medium text-base">{{ $yacht->style }}</span>
                    </div>
                </article>
                @endif
            </div>
        </div>

        <div class="lg:col-span-1 lg:row-span-2">
            <div class="sticky top-8">
                <div class="bg-zinc-50 dark:bg-zinc-900 rounded-lg p-6 space-y-4">

                    @if($yacht->price_per_hour || $yacht->charter_4h_price || $yacht->charter_6h_price || $yacht->charter_8h_price)
                    <div>
                        <h3 class="text-lg font-medium mb-3">Charter Rates</h3>
                        <div class="space-y-2">
                            @if($yacht->price_per_hour)
                            <div class="flex justify-between items-baseline">
                                <span class="text-zinc-400">Hourly Rate</span>
                                <span class="text-xl font-light">${{ number_format($yacht->price_per_hour) }}</span>
                            </div>
                            @endif
                            @if($yacht->charter_4h_price)
                            <div class="flex justify-between items-baseline">
                                <span class="text-zinc-400">4 Hour Charter</span>
                                <span class="text-xl font-light">${{ number_format($yacht->charter_4h_price) }}</span>
                            </div>
                            @endif
                            @if($yacht->charter_6h_price)
                            <div class="flex justify-between items-baseline">
                                <span class="text-zinc-400">6 Hour Charter</span>
                                <span class="text-xl font-light">${{ number_format($yacht->charter_6h_price) }}</span>
                            </div>
                            @endif
                            @if($yacht->charter_8h_price)
                            <div class="flex justify-between items-baseline">
                                <span class="text-zinc-400">8 Hour Charter</span>
                                <span class="text-xl font-light">${{ number_format($yacht->charter_8h_price) }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <hr class="border-zinc-200 dark:border-zinc-700">
                    @endif

                    <div class="space-y-2 text-sm">
                        @if($yacht->length_ft)
                        <div class="flex justify-between">
                            <span class="text-zinc-400">Length</span>
                            <span>{{ $yacht->length_ft }} feet</span>
                        </div>
                        @endif
                        @if($yacht->max_guests)
                        <div class="flex justify-between">
                            <span class="text-zinc-400">Guest Capacity</span>
                            <span>{{ $yacht->max_guests }} guests</span>
                        </div>
                        @endif
                        @if($yacht->style)
                        <div class="flex justify-between">
                            <span class="text-zinc-400">Style</span>
                            <span>{{ $yacht->style }}</span>
                        </div>
                        @endif
                        @if($yacht->cabins)
                        <div class="flex justify-between">
                            <span class="text-zinc-400">Cabins</span>
                            <span>{{ $yacht->cabins }}</span>
                        </div>
                        @endif
                        @if($yacht->make)
                        <div class="flex justify-between">
                            <span class="text-zinc-400">Make</span>
                            <span>{{ $yacht->make }}</span>
                        </div>
                        @endif
                        @if($yacht->crew_included)
                        <div class="flex justify-between">
                            <span class="text-zinc-400">Captain & Crew</span>
                            <span class="text-emerald-400">Included</span>
                        </div>
                        @endif
                        @if($yacht->catering_available)
                        <div class="flex justify-between">
                            <span class="text-zinc-400">Catering</span>
                            <span class="text-emerald-400">Available</span>
                        </div>
                        @endif
                    </div>

                    <hr class="border-zinc-200 dark:border-zinc-700">

                    <a href="{{ url('/inquiry?yacht=' . $yacht->slug) }}" class="block text-center rounded-md bg-zinc-50 px-2.5 py-2.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 w-full">
                        Request Information
                    </a>

                    @if($yachtPhone)
                    <div class="text-center text-sm text-zinc-400">
                        <p>Questions? Call us at</p>
                        <a href="tel:{{ $yachtPhone }}" class="block font-medium text-white mt-2">{{ $yachtPhone }}</a>
                    </div>
                    @endif

                    @if($yachtPolicies)
                    <div class="text-xs text-zinc-500 space-y-1">
                        {!! nl2br(e($yachtPolicies)) !!}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-8">
            @php
                $imageUrls = $yacht->image_urls;
            @endphp
            @if(!empty($imageUrls))
            <hr class="opacity-30 my-8">
            <div class="flex justify-between">
                <h2 class="text-3xl uppercase font-normal">Gallery</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($imageUrls as $index => $img)
                <button type="button"
                    class="bg-zinc-900 rounded-lg shadow-lg relative overflow-hidden group cursor-pointer w-full h-64"
                    @click="$dispatch('open-yacht-gallery', { mediaId: {{ $index }} })">
                    <img src="{{ $img }}" alt="{{ $yacht->title }} {{ $index + 1 }}" class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 ">
                </button>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Gallery Modal --}}
@if(!empty($imageUrls))
<div x-data="yachtGalleryModal()" @open-yacht-gallery.window="open($event.detail.mediaId)" class="contents">
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
                <h3 class="text-xl font-semibold text-zinc-100">{{ $yacht->title }} Gallery</h3>
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

                <img :src="images[selectedIndex]" :alt="'{{ $yacht->title }} ' + (selectedIndex + 1)"
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
                            <img :src="image" :alt="'{{ $yacht->title }} ' + (index + 1)" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function yachtGalleryModal() {
        return {
            isOpen: false,
            selectedIndex: 0,
            images: {!! json_encode($imageUrls) !!},
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

@endsection