@extends('layouts.app')
@section('content')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "productID": {{ $villa->id }},
    "name": "{{ $villa->title }}",
    "description": "{{ strip_tags($villa->description) }}",
    "image": @json($villa->images ?? []),
    "brand": {
        "@type": "Brand",
        "name": "Luxuri"
    },
    "offers": {
        "@type": "AggregateOffer",
        "priceCurrency": "USD",
        "lowPrice": {{ $villa->price_per_night ?? 0 }},
        "highPrice": {{ $villa->price_per_night ?? 0 }},
        "availability": "https://schema.org/InStock",
        "url": "{{ url()->current() }}"
    },
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $villa->location ?? '' }}",
        "addressLocality": "{{ $villa->destination->name ?? '' }}",
        "addressCountry": "Indonesia"
    }
}
</script>

<div class="bg-black text-white relative -mb-34">
    <div class="relative isolate pt-14 flex flex-col justify-center items-center overflow-hidden">
        @if($villa->first_image)
            <img class="absolute inset-0 -z-10 size-full object-cover blur-md opacity-70" 
                 src="{{ $villa->first_image }}" alt="{{ $villa->title }}" />
        @else
            <div class="absolute inset-0 -z-10 bg-zinc-900"></div>
        @endif

        <div class="absolute top-0 left-0 pointer-events-none w-full h-26 -z-10 bg-gradient-to-b from-black from-0% via-black/15 via-70% to-black/0 to-95% bg-blend-overlay"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>

        <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
            <div class="relative grid grid-cols-4 lg:grid-rows-2 gap-4 h-[40svh] min-h-96">
                {{-- Main Image --}}
                <button type="button" class="bg-zinc-900 rounded-2xl shadow-lg relative overflow-hidden group cursor-pointer col-span-4 lg:col-span-2 lg:row-span-2 h-full">
                    @if($villa->first_image)
                        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" 
                             src="{{ $villa->first_image }}" alt="{{ $villa->title }}" />
                    @else
                        <div class="size-full bg-zinc-800"></div>
                    @endif
                </button>

                {{-- Additional Images --}}
                @if(!empty($villa->images))
                    @foreach(array_slice($villa->images, 1, 4) as $index => $img)
                        <button type="button" class="bg-zinc-900 rounded-2xl shadow-lg relative overflow-hidden group cursor-pointer max-md:hidden">
                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" 
                                 src="{{ $img }}" alt="{{ $villa->title }} - Image {{ $index + 2 }}" />
                        </button>
                    @endforeach
                @endif

                @if(!empty($villa->images) && count($villa->images) > 5)
                    <div class="absolute bottom-4 right-4">
                        <button type="button" class="rounded-md bg-zinc-50 px-2.5 py-1.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 border border-zinc-400/50 shadow-lg">
                            View all images
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="h-26"></div>
    </div>

    <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6 relative !pb-0">
        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Left Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Title and Location --}}
                <div class="">
                    @if($villa->destination)
                        <a href="{{ route('destinations.show', $villa->destination->slug) }}" class="text-amber-300">
                            {{ $villa->destination->name }}
                        </a>
                    @endif
                    <h1 class="uppercase font-semibold mt-2">{{ $villa->title }}</h1>
                </div>

                {{-- Property Stats --}}
                <div class="flex flex-wrap gap-1.5 mb-3 text-zinc-50">
                    @if($villa->bedrooms)
                        <div class="">
                            <i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> {{ $villa->bedrooms }} Bedrooms
                        </div>
                        ·
                    @endif
                    @if($villa->max_guests)
                        <div class="">
                            <i class="fa-sharp fa-light fa-person fa-sm me-1"></i> {{ $villa->max_guests }} Sleeps
                        </div>
                        ·
                    @endif
                    @if($villa->bathrooms)
                        <div class="">
                            <i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>{{ $villa->bathrooms }} Bathrooms
                        </div>
                    @endif
                </div>

                {{-- Description with Read More --}}
                @if($villa->description)
                    <div class="text-zinc-50 relative" x-data="{ expanded: false }">
                        <div x-show="expanded" x-collapse.min.120px>
                            <div class="pb-9">
                                <p>{!! nl2br(e($villa->description)) !!}</p>
                            </div>
                        </div>
                        <div class="pt-6 bg-gradient-to-b from-black/10 from-0% to-black to-70% bg-blend-overlay absolute bottom-0 w-full">
                            <button class="uppercase text-xs block w-full text-center" @click="expanded = ! expanded">
                                <span x-text="expanded ? '- Less' : '+ More'">+ More</span>
                            </button>
                        </div>
                    </div>
                @endif

                {{-- Amenities Section --}}
                @if(!empty($villa->amenities))
                    <div class="space-y-6">
                        <hr class="opacity-30 my-8">
                        <div class="flex justify-between">
                            <h2 class="text-3xl uppercase font-normal">Luxury Amenities</h2>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach($villa->amenities as $amenity)
                                <div class="flex items-start gap-3 font-normal">
                                    <div>
                                        <i class="fa-sharp fa-light fa-check fa-fw fa-lg"></i>
                                    </div>
                                    <div>{{ $amenity }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Property Details --}}
                <div class="space-y-6">
                    <hr class="opacity-30 my-8">
                    <div class="flex justify-between">
                        <h2 class="text-3xl uppercase font-normal">{{ $villa->title }} Details</h2>
                    </div>
                    <div class="grid lg:grid-cols-2 gap-4">
                        <article class="relative text-sm group rounded-xl bg-zinc-800">
                            <div class="p-6 space-y-2">
                                <div class="mb-4">
                                    <i class="fa-sharp fa-light fa-comments fa-xl"></i>
                                </div>
                                <h3 class="font-semibold text-lg uppercase">Things to Know</h3>
                                <div class="content-format">
                                    <p>Enjoy your stay in this luxury villa with all amenities included.</p>
                                </div>
                            </div>
                        </article>
                        <article class="relative text-sm group rounded-xl bg-zinc-800">
                            <div class="p-6 space-y-2">
                                <div class="mb-4">
                                    <i class="fa-sharp fa-light fa-file-circle-info fa-xl"></i>
                                </div>
                                <h3 class="font-semibold text-lg uppercase">Villa Rules</h3>
                                <div class="content-format">
                                    <p>• ㅤDoors and windows must be closed & locked.</p>
                                    <p>• ㅤVisitors need manager's approval in advance</p>
                                    <p>• ㅤLimit cars to the number listed above.</p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                {{-- Location Section --}}
                @if($villa->location || $villa->destination)
                    <div class="space-y-6">
                        <hr class="opacity-30 my-8">
                        <div class="flex justify-between">
                            <h2 class="text-3xl uppercase font-normal">
                                Located in {{ $villa->destination->name ?? 'Unknown' }}
                            </h2>
                        </div>
                        <div class="rounded-2xl overflow-hidden">
                            <div id="map" class="h-96 w-full bg-zinc-800"></div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right Sidebar --}}
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