@extends('layouts.app')

@section('content')

<div class="bg-black text-white relative">
    <div class="relative isolate pt-14 min-h-[40vh] flex items-center">
        <div class="absolute inset-0 -z-10 size-full object-cover bg-black/20 bg-blend-multiply"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0">
            <div class="mx-auto py-18 max-w-5xl my-12">
                <div class="space-y-4 text-center">
                    <h1 class="text-4xl lg:text-5xl font-light text-white text-shadow-lg">
                        Luxury Yacht Charters
                    </h1>
                    <p class="text-xl text-white/80 max-w-2xl mx-auto">
                        Discover unforgettable experiences aboard our exclusive yacht collection
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    {{-- Filters --}}
    <form method="GET" action="{{ url('/yachts') }}" class="flex flex-wrap gap-4 mb-8">
        <select name="make" onchange="this.form.submit()" class="px-4 py-2 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-amber-300 focus:border-transparent bg-zinc-900 text-zinc-100 cursor-pointer">
            <option value="">All Makes</option>
            @foreach($makes as $makeOption)
            <option value="{{ strtolower($makeOption) }}" {{ request('make') == strtolower($makeOption) ? 'selected' : '' }}>{{ $makeOption }}</option>
            @endforeach
        </select>

        <select name="style" onchange="this.form.submit()" class="px-4 py-2 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-amber-300 focus:border-transparent bg-zinc-900 text-zinc-100 cursor-pointer">
            <option value="">All Styles</option>
            @foreach($styles as $styleOption)
            <option value="{{ strtolower($styleOption) }}" {{ request('style') == strtolower($styleOption) ? 'selected' : '' }}>{{ $styleOption }}</option>
            @endforeach
        </select>

        <select name="length" onchange="this.form.submit()" class="px-4 py-2 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-amber-300 focus:border-transparent bg-zinc-900 text-zinc-100 cursor-pointer">
            <option value="">All Lengths</option>
            <option value="0-50" {{ request('length') == '0-50' ? 'selected' : '' }}>Under 50ft</option>
            <option value="50-75" {{ request('length') == '50-75' ? 'selected' : '' }}>50ft - 75ft</option>
            <option value="75-100" {{ request('length') == '75-100' ? 'selected' : '' }}>75ft - 100ft</option>
            <option value="100-150" {{ request('length') == '100-150' ? 'selected' : '' }}>100ft - 150ft</option>
            <option value="150-1000" {{ request('length') == '150-1000' ? 'selected' : '' }}>Over 150ft</option>
        </select>

        <select name="sort" onchange="this.form.submit()" class="px-4 py-2 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-amber-300 focus:border-transparent bg-zinc-900 text-zinc-100 cursor-pointer">
            <option value="-created_at" {{ request('sort','-created_at') == '-created_at' ? 'selected' : '' }}>Newest First</option>
            <option value="price_per_hour" {{ request('sort') == 'price_per_hour' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="-price_per_hour" {{ request('sort') == '-price_per_hour' ? 'selected' : '' }}>Price: High to Low</option>
            <option value="-length_ft" {{ request('sort') == '-length_ft' ? 'selected' : '' }}>Length: Largest First</option>
            <option value="length_ft" {{ request('sort') == 'length_ft' ? 'selected' : '' }}>Length: Smallest First</option>
            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Name: A-Z</option>
            <option value="-title" {{ request('sort') == '-title' ? 'selected' : '' }}>Name: Z-A</option>
        </select>

        @if(request('make') || request('style') || request('length'))
        <a href="{{ url('/yachts') }}" class="px-4 py-2 border border-zinc-700 rounded-lg bg-zinc-900 text-zinc-300 hover:text-white transition-colors">
            Clear Filters
        </a>
        @endif
    </form>

    {{-- Yachts Grid --}}
    @if($yachts->count() > 0)
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($yachts as $yacht)
        <div>
            <article class="relative text-sm group rounded-xl">
                <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7">
                    @if($yacht->hero_image)
                    <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy" src="{{ $yacht->hero_image }}" alt="{{ $yacht->title }}">
                    @else
                    <div class="size-full bg-zinc-800 flex items-center justify-center rounded-lg">
                        <span class="text-zinc-500 text-xs">No image</span>
                    </div>
                    @endif
                </div>
                <div class="flex gap-2">
                    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                        <a href="{{ route('yachts.show', $yacht->slug) }}">{{ $yacht->title }}<div class="absolute inset-0"></div></a>
                    </h3>
                </div>
                <div class="text-zinc-200 flex justify-between gap-2">
                    <div class="italic mb-2">{{ $yacht->location ?: '' }}</div>
                </div>
                @if($yacht->price_per_hour)
                <p>${{ number_format($yacht->price_per_hour) }}<span class="text-sm text-zinc-500">/hour</span></p>
                @elseif($yacht->price_per_day)
                <p>${{ number_format($yacht->price_per_day) }}<span class="text-sm text-zinc-500">/day</span></p>
                @else
                <p class="text-amber-300 text-sm">Contact Us</p>
                @endif
            </article>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-20">
        <p class="text-zinc-400 text-lg">No yachts match your filters.</p>
        <a href="{{ url('/yachts') }}" class="inline-block mt-4 text-amber-300 hover:text-amber-200 transition-colors">View all yachts</a>
    </div>
    @endif
</div>

@endsection
