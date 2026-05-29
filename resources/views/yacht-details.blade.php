@extends('layouts.app')
@section('content')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "{{ $yacht->title }}",
    "description": "{{ strip_tags($yacht->description) }}",
    "image": @json($yacht->images ?? [])
}
</script>

<div class="bg-black text-white relative z-10">
    <div class="relative pt-14 min-h-[60vh] flex items-end">
        @if($yacht->first_image)
            <img class="absolute inset-0 size-full object-cover -z-10"
                 src="{{ $yacht->first_image }}" alt="{{ $yacht->title }}" />
        @else
            <div class="absolute inset-0 bg-zinc-900 -z-10"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-black/10 -z-10"></div>
        <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 pb-10 space-y-4">
            @if($yacht->make)
                <p class="text-amber-300 text-xs uppercase tracking-widest">{{ $yacht->make }}</p>
            @endif
            <h1 class="text-4xl md:text-5xl font-light">{{ $yacht->title }}</h1>
            <div class="flex flex-wrap gap-4 text-sm text-zinc-300">
                @if($yacht->length)
                    <span>{{ $yacht->length }} ft</span>
                @endif
                @if($yacht->cabins)
                    <span>&bull; {{ $yacht->cabins }} {{ Str::plural('Cabin', $yacht->cabins) }}</span>
                @endif
                @if($yacht->max_guests)
                    <span>&bull; Up to {{ $yacht->max_guests }} Guests</span>
                @endif
                @if($yacht->style)
                    <span>&bull; {{ $yacht->style }}</span>
                @endif
                @if($yacht->price_per_day)
                    <span>&bull; From ${{ number_format($yacht->price_per_day) }}/day</span>
                @endif
            </div>
        </div>
    </div>

    @if(!empty($yacht->images) && count($yacht->images) > 1)
    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 py-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
            @foreach(array_slice($yacht->images, 0, 8) as $img)
                <div class="overflow-hidden rounded-lg aspect-video">
                    <img class="size-full object-cover hover:scale-105 transition-transform duration-300"
                         loading="lazy" src="{{ $img }}" alt="{{ $yacht->title }}" />
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 py-10 grid lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2 space-y-10">
            @if($yacht->description)
            <section class="space-y-4">
                <h2 class="text-2xl font-light uppercase tracking-wide">About This Yacht</h2>
                <div class="text-zinc-300 font-light leading-relaxed">
                    {!! nl2br(e($yacht->description)) !!}
                </div>
            </section>
            @endif
        </div>

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
                        <li class="flex justify-between"><span>Make</span><span class="text-white">{{ $yacht->make }}</span></li>
                    @endif
                    @if($yacht->style)
                        <li class="flex justify-between"><span>Style</span><span class="text-white">{{ $yacht->style }}</span></li>
                    @endif
                    @if($yacht->length)
                        <li class="flex justify-between"><span>Length</span><span class="text-white">{{ $yacht->length }} ft</span></li>
                    @endif
                    @if($yacht->cabins)
                        <li class="flex justify-between"><span>Cabins</span><span class="text-white">{{ $yacht->cabins }}</span></li>
                    @endif
                    @if($yacht->max_guests)
                        <li class="flex justify-between"><span>Max Guests</span><span class="text-white">{{ $yacht->max_guests }}</span></li>
                    @endif
                    @if($yacht->location)
                        <li class="flex justify-between"><span>Location</span><span class="text-white text-right max-w-[60%]">{{ $yacht->location }}</span></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
