@extends('layouts.app')
@section('content')
<div class="bg-black text-white relative -mb-8">
    <div class="relative isolate pt-14 min-h-[70vh] flex items-center">
        @if($settings && $settings->concierge_hero_image)
            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('storage/' . $settings->concierge_hero_image) }}" alt="Concierge Hero">
        @else
            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxteria.co/bfa7e41ddd0b628b375fee0223e5268d/spa.jpg') }}" alt="spa.jpg">
        @endif
        <div class="absolute top-0 left-0 pointer-events-none w-full h-26 -z-10 bg-gradient-to-b from-black from-0% via-black/15 via-70% to-black/0 to-95% bg-blend-overlay"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0">
        </div>
    </div>
</div>

<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="grid lg:grid-cols-5">
        <div class="space-y-4 lg:col-span-2">
            <h2 class="uppercase font-semibold">Concierge Services</h2>
        </div>
        <div class="lg:col-span-3 space-y-4">
            <div class="content-format">
                <p>Personalized luxury services designed to make every stay seamless, private, and unforgettable.</p>
            </div>
            <div class="flex gap-2">
                @php
                    $conciergePhone = $settings->mobile_phone ?? $settings->phone ?? '+1 (786) 981-0924';
                @endphp
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $conciergePhone) }}"
                    class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
                    Call {{ $conciergePhone }}
                </a>
                <a href="{{ route('contact') }}"
                    class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
                    Inquire
                </a>
            </div>
        </div>
    </div>
</div>

<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8">
        @forelse($services as $index => $service)
            <div class="wow fadeInUp" data-wow-delay="{{ $index * 50 }}ms" />
            <div class="w-2xl hidden"></div>
            <div x-data="{
                modalIsOpen: false,
                updateResponsiveImages() {
                    if (this.modalIsOpen) {
                        this.$nextTick(() => {
                            const images = this.$el.querySelectorAll('img[srcset][onload]');
                            images.forEach(img => {
                                if (img.sizes === '1px' && img.onload) {
                                    img.onload();
                                }
                            });
                        });
                    }
                }
            }" x-effect="updateResponsiveImages()">

                <article class="relative group puffIn text-sm">
                    <div class="mb-4">
                        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
                            @if($service->image)
                                <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                            @else
                                <div class="size-full bg-zinc-800 rounded-lg flex items-center justify-center text-zinc-500 text-xs">No Image</div>
                            @endif
                        </div>
                    </div>

                    <div class="flex-1">
                        <div class="flex gap-2">
                            <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                                <button x-on:click="modalIsOpen = true" type="button">
                                    {{ $service->title }}
                                    <div class="absolute inset-0"></div>
                                </button>
                            </h3>
                        </div>
                    </div>
                </article>

                <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
                     x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
                     class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                     role="dialog" aria-modal="true" aria-labelledby="modal-title-{{ $service->id }}">
                    <div x-show="modalIsOpen"
                         x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                         x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                         class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden border border-zinc-50/30 lg:w-3xl !max-w-full">
                        <div class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                            <h3 id="modal-title-{{ $service->id }}" class="font-semibold tracking-wide text-white">
                                {{ $service->title }}
                            </h3>
                            <button x-on:click="modalIsOpen = false" aria-label="close modal">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                     stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="px-6 py-4 overflow-y-auto">
                            <div class="grid lg:grid-cols-3 gap-6">
                                <div class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                    @if($service->image)
                                        <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                                    @else
                                        <div class="absolute inset-0 -z-10 size-full bg-zinc-800 flex items-center justify-center text-zinc-500 text-xs">No Image</div>
                                    @endif
                                </div>
                                <div class="lg:col-span-2">
                                    {!! $service->description !!}
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $conciergePhone) }}"
                                class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
                                Call {{ $conciergePhone }}
                            </a>
                            <a href="{{ route('contact') }}"
                                class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
                                Inquire
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        @empty
            <div class="col-span-full text-center text-zinc-400 py-12">
                No concierge services available at the moment.
            </div>
        @endforelse
    </div>
</div>
@endsection
