@extends('layouts.app')
@section('content')
<div class="bg-black text-white relative -mb-8">
    <div class="relative isolate pt-14 min-h-[70vh] flex items-center">
                    <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/bfa7e41ddd0b628b375fee0223e5268d/spa.jpg') }}" alt="spa.jpg">
                <div
            class="absolute top-0 left-0 pointer-events-none w-full h-26 -z-10 bg-gradient-to-b from-black from-0% via-black/15 via-70% to-black/0 to-95% bg-blend-overlay"></div>
        <div
            class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>
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
                    <p>Every moment of your stay should feel effortless. Our dedicated concierge team is here to curate personalized experiences tailored to your tastes, from private chefs and bespoke yacht charters to exclusive wellness treatments and hard-to-find reservations.</p>
                </div>
                        <div class="flex gap-2">
                                    <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call (786) 981-0924
    </a>
                                                    <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                            </div>
        </div>
    </div>
</div>
            <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8">
                            <div class="wow fadeInUp" data-wow-delay="0ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/5328380f48394891596754e3acd5bffe/mixologist.jpg') }}" alt="mixologist.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Mixologist
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Mixologist
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/5328380f48394891596754e3acd5bffe/mixologist.jpg') }}" alt="mixologist.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Enjoy a personalized cocktail experience in the comfort of your villa with a private mixologist. Whether you are hosting a gathering or simply relaxing with friends, your mixologist will craft signature drinks tailored to your preferences using high-quality ingredients. It is the perfect way to elevate any evening and create a memorable atmosphere.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="50ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/b774807d82136d0ad4b61f6dcb0b5cf9/flower.jpg') }}" alt="flower.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Flower Arrangements
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Flower Arrangements
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/b774807d82136d0ad4b61f6dcb0b5cf9/flower.jpg') }}" alt="flower.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Add a touch of beauty and refinement to your villa with custom floral arrangements. Whether you are celebrating a special occasion or simply want to enhance the space, we provide fresh, seasonal flowers designed to reflect your taste and elevate the ambiance of your surroundings.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="100ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/941aa795619a7dfbf3dbb78639971c52/custom-experiences.jpg') }}" alt="custom experiences.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Custom Experiences
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Custom Experiences
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/941aa795619a7dfbf3dbb78639971c52/custom-experiences.jpg') }}" alt="custom experiences.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>If you can imagine it, we can create it. From private yacht dinners and curated adventure days to surprise proposals or wellness retreats, our team designs fully personalized experiences to match your vision. Every detail is handled with care to ensure a truly unforgettable moment.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="150ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/b38582d96fce807f81239fb66aaf56cf/security.jpg') }}" alt="security.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Private Security
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Private Security
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/b38582d96fce807f81239fb66aaf56cf/security.jpg') }}" alt="security.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Maintain peace of mind during your stay with discreet private security tailored to your needs. Whether for a private event, personal protection, or overnight property monitoring, our trained professionals provide a calm and reliable presence so you can feel safe and relaxed at all times.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="200ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/ab3a50d2165f174e77d1c9a83b91df71/Club-reso.jpg') }}" alt="Club reso.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Club Reservations
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Club Reservations
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/ab3a50d2165f174e77d1c9a83b91df71/Club-reso.jpg') }}" alt="Club reso.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Gain access to the city’s top nightlife venues with exclusive club reservations arranged by our concierge team. Your experience includes priority entry, reserved tables, and elevated service, so you can enjoy the evening without waiting or worrying about logistics.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="250ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/5da61508c16b8e379d882cf41791e739/Caviar.jpg') }}" alt="Caviar.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Caviar Delivery
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Caviar Delivery
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/5da61508c16b8e379d882cf41791e739/Caviar.jpg') }}" alt="Caviar.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Savor the indulgence of premium caviar delivered directly to your villa. Choose from an exclusive selection of the finest varieties, perfectly presented and accompanied by traditional pairings. This service is ideal for intimate evenings, celebrations, or moments that call for something exceptional.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="300ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/88df07b16579031cab7cd9edb6462f7c/liquor.jpg') }}" alt="liquor.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Liquor Stock Up
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Liquor Stock Up
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/88df07b16579031cab7cd9edb6462f7c/liquor.jpg') }}" alt="liquor.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Arrive to a fully stocked bar curated to your personal preferences. From top-shelf spirits and wines to craft mixers and garnishes, we ensure your villa is ready for entertaining or unwinding. Let us know your selections in advance, and everything will be waiting for you upon arrival.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="350ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/a948504ff5d5657adef1c449438e802b/private-jet.jpg') }}" alt="private jet.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Private Jet
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Private Jet
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/a948504ff5d5657adef1c449438e802b/private-jet.jpg') }}" alt="private jet.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Fly on your own schedule with private jet services tailored to your itinerary. Whether you are traveling domestically or internationally, our team will arrange seamless and discreet air travel with every comfort considered. From pre-flight coordination to on-board luxury, we handle every detail.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="400ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/1abae8695c8fbcdc1735582b53e27108/IV.jpg') }}" alt="IV.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                In-Home IV Service
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    In-Home IV Service
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/1abae8695c8fbcdc1735582b53e27108/IV.jpg') }}" alt="IV.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Restore your energy and support your wellness with in-villa IV therapy administered by licensed professionals. Treatments can be customized for hydration, immune support, recovery, or revitalization, all within the comfort and privacy of your villa. It is a discreet and convenient way to feel your best.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="450ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/ecad80e72e8e3ecbb57128a147f1b2c9/sprinter.jpg') }}" alt="sprinter.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Sprinter Service
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Sprinter Service
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/ecad80e72e8e3ecbb57128a147f1b2c9/sprinter.jpg') }}" alt="sprinter.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Travel together in comfort with a luxury sprinter van arranged by our team. Ideal for airport transfers, day trips, or nights out, sprinters offer spacious seating, modern entertainment features, and a professional driver who ensures every journey is smooth.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="500ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/e53a3876986e2453f046ffa7afa57230/Restaurant.jpg') }}" alt="Restaurant.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Restaurant Reservations
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Restaurant Reservations
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/e53a3876986e2453f046ffa7afa57230/Restaurant.jpg') }}" alt="Restaurant.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Dine at the most sought-after restaurants in town with exclusive reservations arranged by our concierge team. From casual spots to fine dining experiences, we ensure you have the best table at the perfect time. Simply share your preferences, and we will handle the rest.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="550ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/aab384c821c532068a7c78864fe3e763/grocery.jpg') }}" alt="grocery.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Fresh Groceries
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Fresh Groceries
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/aab384c821c532068a7c78864fe3e763/grocery.jpg') }}" alt="grocery.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Arrive to a villa that is already stocked with everything you need. Our grocery delivery service includes fresh produce, pantry essentials, snacks, and beverages based on your preferences. We take care of the shopping and setup so you can begin your stay without delay.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="600ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/7e3c280d5c15bf5b91c6ede0aa7c7d46/chef.jpg') }}" alt="chef.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Personal Chef
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Personal Chef
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/7e3c280d5c15bf5b91c6ede0aa7c7d46/chef.jpg') }}" alt="chef.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Enjoy the luxury of a private chef preparing gourmet meals in your villa. Whether it is a romantic dinner, a family-style brunch, or a multi-course tasting menu, every dish is crafted to reflect your preferences using fresh, high-quality ingredients. Your chef handles everything from planning to clean-up so you can relax and enjoy.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="650ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/a2e1b25de28957b364af71b3d74563b3/test.jpg') }}" alt="test.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Chauffeur
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Chauffeur
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/a2e1b25de28957b364af71b3d74563b3/test.jpg') }}" alt="test.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Enjoy the ease of professional chauffeur service throughout your stay. Whether you need daily transport, event transfers, or discreet travel around the city, our drivers offer punctual and polished service in luxury vehicles. It is a seamless way to move from place to place with comfort and privacy.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                        <div class="wow fadeInUp" data-wow-delay="700ms" />
                <div class="w-2xl hidden"></div>
                <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-square aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="{{ asset('media.luxuri.com/f396f2511b9c29c00f79eb434a9baef1/massage.jpg') }}" alt="massage.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <button x-on:click="modalIsOpen = true" class="" type="button">
                Spa Services
                <div class="absolute inset-0"></div>
            </button>
            </h3>
    
</div>

        
            </div>
</article>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 lg:w-3xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Spa Services
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="grid lg:grid-cols-3 gap-6">
                        <div
                            class="h-full relative overflow-hidden rounded-2xl min-h-64 z-10">
                                                            <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxuri.com/f396f2511b9c29c00f79eb434a9baef1/massage.jpg') }}" alt="massage.jpg">
                                                    </div>
                        <div class="lg:col-span-2">
                            <p>Transform your villa into a sanctuary of calm with professional in-home spa services. Choose from a range of treatments including massages, facials, body scrubs, and wellness therapies, all delivered by certified experts. Every detail is curated to help you unwind and recharge in the privacy of your own space.</p>
                        </div>
                    </div>
            </div>
            <!-- Dialog Footer -->
                            <div
                    class="flex flex-col-reverse justify-between gap-2 border-outline bg-surface-alt/60 px-6 py-6 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="tel:+17869810924"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Call +1 (786) 981-0924
    </a>
                                                <a href="{{ url('/') }}"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
        Inquire
    </a>
                </div>
                    </div>
    </div>
</div>
        </div>
                </div>
    
            <div class="mt-8">
            
        </div>
</div>
@endsection




