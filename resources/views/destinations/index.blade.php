@extends('layouts.app')
@section('content')
<div class="bg-black text-white relative z-10">
    <div class="relative isolate pt-14 min-h-[50vh] flex items-center">
        <div class="absolute inset-0 -z-10 bg-zinc-900"></div>
        <div class="w-full max-w-7xl mx-auto p-6 lg:py-16 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-light uppercase tracking-widest text-white mb-4">Destinations</h1>
            <p class="text-zinc-300 text-lg max-w-2xl">Explore our most sought-after destinations for luxury villa rentals.</p>
        </div>
    </div>

    @livewire('site.destination-list')
</div>
@endsection
