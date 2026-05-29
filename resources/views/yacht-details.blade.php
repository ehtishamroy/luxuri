@extends('layouts.app')
@section('content')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "{{ $yacht->title }}",
    "description": "{{ strip_tags($yacht->description) }}",
    "image": @json($yacht->images ?? []),
    "brand": {
        "@type": "Brand",
        "name": "Luxuri"
    },
    "offers": {
        "@type": "AggregateOffer",
        "priceCurrency": "USD",
        "lowPrice": {{ $yacht->price_per_day ?? 0 }},
        "highPrice": {{ $yacht->price_per_day ?? 0 }},
        "availability": "https://schema.org/InStock",
        "url": "{{ url()->current() }}"
    }
}
</script>

<div class="bg-black text-white relative z-10">
    <div class="relative isolate pt-14 min-h-[40vh] flex items-center">
        @if($yacht->first_image)
            <img class="absolute inset-0 -z-10 size-full object-cover"
                 src="{{ $yacht->first_image }}" alt="{{ $yacht->title }}" />
        @else
            <div class="absolute inset-0 -z-10 bg-zinc-900"></div>
        @endif
        <div class="absolute inset-0 -z-10 size-full object-cover bg-black/20 bg-blend-multiply"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0">
            <div class="mx-auto py-18 max-w-5xl my-12">
                <div class="space-y-4">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="grid lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            
            <div class="space-y-4">
                <h1>{{ $yacht->title }}</h1>
                <div class="font-normal">
                    @if($yacht->location)
                        {{ $yacht->location }}
                    @else
                        Miami, Florida
                    @endif
                </div>
                @if($yacht->description)
                    <div class="content-format">
                        {!! nl2br(e($yacht->description)) !!}
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-3 gap-4">
                <article class="relative text-sm group rounded-xl border border-zinc-50/30">
                    <div class="p-6 text-center">
                        <div class="text-2xl text-center mb-2">
                            <i class="fa-sharp fa-light fa-seat-airline"></i>
                        </div>
                        <span class="font-medium text-base">
                            @if($yacht->max_guests)
                                {{ $yacht->max_guests }} guests
                            @else
                                13 guests
                            @endif
                        </span>
                    </div>
                </article>
                <article class="relative text-sm group rounded-xl border border-zinc-50/30">
                    <div class="p-6 text-center">
                        <div class="text-2xl text-center mb-2">
                            <i class="fa-sharp fa-light fa-arrows-left-right-to-line"></i>
                        </div>
                        <span class="font-medium text-base">
                            @if($yacht->length)
                                {{ $yacht->length }} feet
                            @else
                                59 feet
                            @endif
                        </span>
                    </div>
                </article>
                <article class="relative text-sm group rounded-xl border border-zinc-50/30">
                    <div class="p-6 text-center">
                        <div class="text-2xl text-center mb-2">
                            <i class="fa-sharp fa-light fa-ship"></i>
                        </div>
                        <span class="font-medium text-base">
                            @if($yacht->style)
                                {{ $yacht->style }}
                            @else
                                Yacht
                            @endif
                        </span>
                    </div>
                </article>
            </div>

            <hr class="opacity-30 my-8">

            {{-- Gallery Section --}}
            @if(!empty($yacht->images))
                <div class="flex justify-between">
                    <h2 class="text-3xl uppercase font-normal">Gallery</h2>
                    <div class="py-2 flex gap-2">
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($yacht->images as $img)
                        <img src="{{ $img }}"
                             alt="{{ $yacht->title }}"
                             class="w-full h-64 object-cover rounded-lg">
                    @endforeach
                </div>
            @endif

        </div>

        {{-- Right Sidebar --}}
        <div class="space-y-6">
            <div class="bg-zinc-900 rounded-2xl p-6 space-y-4 sticky top-24">
                @if($yacht->price_per_day)
                    <p class="text-3xl font-light">
                        ${{ number_format($yacht->price_per_day) }}
                        <span class="text-base text-zinc-400">/day</span>
                    </p>
                @endif
                <a href="{{ url('/contact') }}"
                   class="block w-full text-center py-3 px-6 rounded-xl bg-amber-400 hover:bg-amber-300 text-black font-semibold transition-colors">
                    Enquire Now
                </a>
                <ul class="space-y-2 text-sm text-zinc-400 pt-2 border-t border-zinc-800">
                    @if($yacht->make)
                        <li class="flex justify-between">
                            <span>Make</span>
                            <span class="text-white">{{ $yacht->make }}</span>
                        </li>
                    @endif
                    @if($yacht->style)
                        <li class="flex justify-between">
                            <span>Style</span>
                            <span class="text-white">{{ $yacht->style }}</span>
                        </li>
                    @endif
                    @if($yacht->length)
                        <li class="flex justify-between">
                            <span>Length</span>
                            <span class="text-white">{{ $yacht->length }} ft</span>
                        </li>
                    @endif
                    @if($yacht->cabins)
                        <li class="flex justify-between">
                            <span>Cabins</span>
                            <span class="text-white">{{ $yacht->cabins }}</span>
                        </li>
                    @endif
                    @if($yacht->max_guests)
                        <li class="flex justify-between">
                            <span>Max Guests</span>
                            <span class="text-white">{{ $yacht->max_guests }}</span>
                        </li>
                    @endif
                    @if($yacht->location)
                        <li class="flex justify-between">
                            <span>Location</span>
                            <span class="text-white text-right max-w-[60%]">{{ $yacht->location }}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
