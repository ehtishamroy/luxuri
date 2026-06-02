@extends('layouts.app')
@section('content')
@php
$heroVideosData = [];
$heroKeys = ['hero-video-1', 'hero-video-2', 'hero-video-3'];
foreach ($heroKeys as $key) {
    if (isset($homepageMedia[$key]) && $homepageMedia[$key]->file_path) {
        $item = $homepageMedia[$key];
        $heroVideosData[] = [
            'src' => asset('storage/' . $item->file_path),
            'poster' => $item->poster_path ? asset('storage/' . $item->poster_path) : null,
        ];
    }
}
if (empty($heroVideosData)) {
    $heroVideosData = [
        ['src' => asset('media.luxteria.co/video/luxury-new-video.mp4'), 'poster' => asset('media.luxteria.co/video/luxury-new-video-preview.jpg')],
        ['src' => asset('media.luxteria.co/video/Fort_lauderdale_video.mp4'), 'poster' => null],
        ['src' => asset('media.luxteria.co/video/miami-video.mp4'), 'poster' => null],
    ];
}
@endphp
<div class="bg-black text-white relative z-10">
    <div class="relative isolate pt-14 min-h-[90vh] md:min-h-[70vh] flex items-center">



        <div
    x-data="videoAutoplay({{ json_encode($heroVideosData) }})"
    x-init="init()"
    x-intersect:enter="startLazyLoad()"
    x-intersect:leave="pauseVideos()"
    class="absolute inset-0 -z-10 size-full overflow-hidden"
>
    
    <div class="relative size-full">
        
        <img
            x-show="!isReady && videos[0].poster"
            :src="videos[0].poster"
            alt="Hero video preview"
            class="absolute inset-0 size-full object-cover"
            loading="eager"
        />

        
        <video
            x-ref="mainVideo"
            x-show="isReady"
            class="size-full object-cover"
            muted
            playsinline
            preload="auto"
            :poster="videos[currentVideo].poster || ''"
            @loadeddata="onVideoLoaded"
            @ended="nextVideo"
            x-on:error="handleVideoError"
        >
            <source :src="videos[currentVideo].src" type="video/mp4" />
            Your browser does not support the video tag.
        </video>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('videoAutoplay', (initialVideos) => ({
                videos: initialVideos && initialVideos.length ? initialVideos : [],
                currentVideo: 0,
                isReady: false,
                isInViewport: false,

                init() {
                    // Preload first poster immediately (if available)
                    if (this.videos[0].poster) {
                        const firstPoster = new Image();
                        firstPoster.src = this.videos[0].poster;
                    }

                    // Check if user prefers reduced motion
                    this.respectsReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

                    // Set up visibility change listener
                    document.addEventListener('visibilitychange', () => {
                        if (document.hidden) {
                            this.pauseVideos();
                        } else if (this.isInViewport && this.isReady) {
                            this.playCurrentVideo();
                        }
                    });
                },

                startLazyLoad() {
                    this.isInViewport = true;

                    if (!this.isReady) {
                        // Start loading the first video
                        this.$nextTick(() => {
                            if (this.$refs.mainVideo) {
                                this.$refs.mainVideo.load();
                                this.tryPlayVideo();
                            }
                        });
                    } else {
                        this.playCurrentVideo();
                    }
                },

                onVideoLoaded() {
                    if (!this.isReady) {
                        this.isReady = true;
                        this.tryPlayVideo();
                    }
                },

                tryPlayVideo() {
                    if (!this.$refs.mainVideo || this.respectsReducedMotion) return;

                    const playPromise = this.$refs.mainVideo.play();

                    if (playPromise !== undefined) {
                        playPromise.catch(error => {
                            console.warn('Video autoplay prevented:', error);
                            this.setupPlayOnInteraction();
                        });
                    }
                },

                setupPlayOnInteraction() {
                    const playOnce = () => {
                        this.$refs.mainVideo.play();
                    };

                    document.addEventListener('click', playOnce, { once: true });
                    document.addEventListener('touchstart', playOnce, { once: true });
                },

                nextVideo() {
                    if (this.respectsReducedMotion) return;

                    // Move to next video
                    this.currentVideo = (this.currentVideo + 1) % this.videos.length;

                    // Load and play next video
                    this.$nextTick(() => {
                        if (this.$refs.mainVideo) {
                            this.$refs.mainVideo.load();
                            this.tryPlayVideo();
                        }
                    });
                },

                pauseVideos() {
                    this.isInViewport = false;
                    if (this.$refs.mainVideo) {
                        this.$refs.mainVideo.pause();
                    }
                },

                playCurrentVideo() {
                    if (!this.isInViewport || this.respectsReducedMotion) return;

                    if (this.$refs.mainVideo) {
                        this.tryPlayVideo();
                    }
                },

                handleVideoError() {
                    console.error(`Error loading video ${this.currentVideo + 1}`);

                    // Move to next video after error
                    setTimeout(() => this.nextVideo(), 100);
                }
            }));
        });
    </script>
</div>        <div class="absolute inset-0 -z-10 size-full object-cover bg-black/20 bg-blend-multiply"
        ></div>
        <div
            class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>
        <div class="mx-auto max-w-7xl px-4 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0">
            <div class="mx-auto py-18 max-w-5xl my-12">
        <div class="space-y-6">
            <div class="space-y-4 text-shadow-lg/10">
    <h1 class="text-3xl font-semibold tracking-wide text-center text-balance uppercase font-accent sm:text-5xl">
        Luxury Concierge & Villa Experiences in Miami
    </h1>
    <p class="text-lg font-normal text-pretty text-center">
        From private villas and yachts to VIP lifestyle services LUXTERIA handles every detail with discretion, speed, and luxury.
    </p>
</div>

            {{-- Planner Widget --}}
                    <div x-data="planner()" @keydown.escape="showDestinations = false; showDatepicker = false" @click.outside="showDestinations = false; showDatepicker = false" class="relative z-50 w-full max-w-2xl mx-auto">
                        <div class="w-full" :class="!plannerVisible && capturedHeight === 0 ? 'min-h-[92px] md:min-h-[120px]' : ''" :style="!plannerVisible && capturedHeight > 0 ? 'height: ' + capturedHeight + 'px' : ''"></div>

                        <form x-ref="formContent" :class="{ 'fixed bottom-0 lg:bottom-4 left-1/2 -translate-x-1/2 w-full max-w-2xl': !plannerVisible, 'relative': plannerVisible }">
                            <div class="transition-transform duration-500 ease-out" :class="!plannerVisible ? (hasBeenFixed ? 'translate-y-0' : 'translate-y-full') : ''">
                                <div :class="hasBeenFixed ? '' : 'max-md:min-h-64'" class="">
                                    <div class="w-full max-w-2xl p-5 bg-black/70 border border-zinc-50/90 backdrop-blur-[2px] rounded-xl" x-on:click.outside="showPlannerFields = false">

                                        {{-- Desktop layout --}}
                                        <div class="hidden md:flex gap-4">
                                            <div class="divide-x divide-zinc-200/80 grid grid-cols-15 max-md:grid-cols-5 gap-y-2">
                                                <div class="col-span-4 md:pe-4 text-left max-md:col-span-5 max-md:border-e-0 max-md:border-b">
                                                    <label class="font-medium text-sm max-sm:text-xs">Where
                                                        <input type="text" @click="showDestinations = true; showDatepicker = false" x-model="locationName" x-ref="searchInput" placeholder="Location" class="text-zinc-300 py-1 truncate text-sm max-sm:text-xs focus:outline-none border-1 border-transparent max-w-full w-full block focus-within:border-b-zinc-50">
                                                    </label>
                                                </div>
                                                <div class="col-span-4 pe-2 md:px-4 text-left max-md:col-span-2">
                                                    <label class="font-medium text-sm max-sm:text-xs">Check in
                                                        <input type="text" @click="openDatePicker('from')" x-model="outputDateFromValue" :class="{'border-b-zinc-50': selectingDate == 'from'}" placeholder="Select date" readonly class="text-zinc-300 py-1 truncate text-sm max-sm:text-xs focus:outline-none border-1 border-transparent block max-w-full w-full focus-within:border-b-zinc-50 border-b-zinc-50">
                                                    </label>
                                                </div>
                                                <div class="col-span-4 px-2 md:px-4 text-left max-md:col-span-2">
                                                    <label class="font-medium text-sm max-sm:text-xs">Check out
                                                        <input type="text" @click="openDatePicker('to')" x-model="outputDateToValue" :class="{'border-b-zinc-50': selectingDate == 'to'}" placeholder="Select date" readonly class="text-zinc-300 py-1 truncate text-sm max-sm:text-xs focus:outline-none border-1 border-transparent block max-w-full w-full focus-within:border-b-zinc-50 border-b-zinc-50">
                                                    </label>
                                                </div>
                                                <div class="col-span-3 ps-2 md:px-4 text-left max-md:col-span-1">
                                                    <label class="font-medium text-sm max-sm:text-xs">Guests
                                                        <input type="number" @click="showDatepicker = false; showDestinations = false" x-model="guests" placeholder="2" class="text-zinc-300 py-1 truncate text-sm max-sm:text-xs focus:outline-none border-1 border-transparent block max-w-full w-full focus-within:border-b-zinc-50">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="shrink-0 flex gap-2">
                                                <button type="button" class="rounded-md bg-zinc-50 px-2.5 py-1.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 md:size-12 max-md:w-full max-sm:text-xs max-sm:py-2" @click="handleSearch">
                                                    <i class="fa-sharp fa-solid fa-magnifying-glass max-md:me-1"></i>
                                                    <span class="md:hidden">Search</span>
                                                </button>
                                            </div>
                                        </div>

                                        {{-- Mobile compact --}}
                                        <div class="md:hidden w-full overflow-hidden" x-show="!showPlannerFields" x-transition:enter="transition-all ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-20" x-transition:leave="transition-all ease-in duration-200" x-transition:leave-start="opacity-100 max-h-20" x-transition:leave-end="opacity-0 max-h-0">
                                            <div class="flex gap-2 w-full" @click="showPlannerFields = true">
                                                <div class="font-medium text-sm w-full">
                                                    <div class="flex gap-2 items-baseline">
                                                        <div class="grow">Location</div>
                                                        <div class="text-zinc-300 text-xs" x-text="outputDateFromValue ? new Date(dateFromYmd).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) : ''"></div>
                                                        -
                                                        <div class="text-zinc-300 text-xs" x-text="outputDateToValue ? new Date(dateToYmd).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) : ''"></div>
                                                    </div>
                                                    <div class="text-zinc-300 py-1 text-sm w-full" x-text="locationName || 'Locations...'">Locations...</div>
                                                </div>
                                                <div class="shrink-0">
                                                    <button type="button" class="rounded-md bg-zinc-50 px-2.5 py-1.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 size-12" @click.stop="handleSearch">
                                                        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Mobile expanded --}}
                                        <div class="md:hidden transition-all duration-300 ease-in-out overflow-hidden max-h-0 opacity-0" :class="{ 'max-h-96 opacity-100': showPlannerFields, 'max-h-0 opacity-0': !showPlannerFields }">
                                            <div class="flex flex-col gap-4">
                                                <div class="divide-x divide-zinc-200/80 grid grid-cols-5 gap-y-2">
                                                    <div class="col-span-5 border-b border-e-0">
                                                        <label class="font-medium text-sm max-sm:text-xs">Where
                                                            <input type="text" @click="showDestinations = true; showDatepicker = false" x-model="locationName" x-ref="searchInput" placeholder="Location" class="text-zinc-300 py-1 truncate text-base focus:outline-none border-1 border-transparent max-w-full w-full block focus-within:border-b-zinc-50">
                                                        </label>
                                                    </div>
                                                    <div class="col-span-2 pe-2">
                                                        <label class="font-medium text-sm max-sm:text-xs">Check in
                                                            <input type="text" @click="openDatePicker('from')" x-model="outputDateFromValue" :class="{'border-b-zinc-50': selectingDate == 'from'}" placeholder="Select date" readonly class="text-zinc-300 py-1 truncate text-base focus:outline-none border-1 border-transparent block max-w-full w-full focus-within:border-b-zinc-50 border-b-zinc-50">
                                                        </label>
                                                    </div>
                                                    <div class="col-span-2 px-2">
                                                        <label class="font-medium text-sm max-sm:text-xs">Check out
                                                            <input type="text" @click="openDatePicker('to')" x-model="outputDateToValue" :class="{'border-b-zinc-50': selectingDate == 'to'}" placeholder="Select date" readonly class="text-zinc-300 py-1 truncate text-base focus:outline-none border-1 border-transparent block max-w-full w-full focus-within:border-b-zinc-50 border-b-zinc-50">
                                                        </label>
                                                    </div>
                                                    <div class="col-span-1 ps-2">
                                                        <label class="font-medium text-sm max-sm:text-xs">Guests
                                                            <input type="number" @click="showDatepicker = false; showDestinations = false" x-model="guests" placeholder="2" class="text-zinc-300 py-1 truncate text-base focus:outline-none border-1 border-transparent block max-w-full w-full focus-within:border-b-zinc-50">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="flex gap-2">
                                                    <button type="button" class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 max-sm:py-2" @click="showPlannerFields = false">Close</button>
                                                    <button type="button" class="rounded-md bg-zinc-50 px-2.5 py-1.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 w-full max-sm:py-2" @click="handleSearch">
                                                        <i class="fa-sharp fa-solid fa-magnifying-glass me-1"></i>
                                                        <span>Search</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Destinations Dropdown --}}
                            <div class="absolute left-1/2 z-10 mt-2 flex w-screen max-w-max -translate-x-1/2 px-4 max-md:bottom-full" x-show="showDestinations" x-transition:enter="transition ease-out duration-350" :class="plannerVisible ? '' : 'bottom-full'" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" style="display: none;">
                                <div class="w-screen max-w-2xl flex-auto bg-black/90 border border-zinc-50/90 backdrop-blur-[2px] rounded-xl shadow-lg ring-1 ring-gray-900/5">
                                    <div class="px-6 pt-6 pb-6 max-md:text-xs">
                                        <div>
                                            <div class="font-medium mb-3 text-zinc-50">Locations</div>
                                            <ul class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                                <li>
                                                    <article class="relative text-sm group rounded-xl">
                                                        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-7/5 max-md:hidden">
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="eager" src="https://media.luxteria.co/83926f30daa706ee9a210a080639d387/Aspen.png" alt="Aspen">
                                                        </div>
                                                        <div class="flex gap-2 mb-2">
                                                            <h3 class="text-base font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                                                                <button type="button" class="text-center w-full max-md:text-sm" @click="setDestination('Aspen')">
                                                                    Aspen
                                                                    <div class="absolute inset-0"></div>
                                                                </button>
                                                            </h3>
                                                        </div>
                                                    </article>
                                                </li>
                                                <li>
                                                    <article class="relative text-sm group rounded-xl">
                                                        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-7/5 max-md:hidden">
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="eager" src="https://media.luxteria.co/miami-hero.jpg" alt="Miami">
                                                        </div>
                                                        <div class="flex gap-2 mb-2">
                                                            <h3 class="text-base font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                                                                <button type="button" class="text-center w-full max-md:text-sm" @click="setDestination('Miami')">
                                                                    Miami
                                                                    <div class="absolute inset-0"></div>
                                                                </button>
                                                            </h3>
                                                        </div>
                                                    </article>
                                                </li>
                                                <li>
                                                    <article class="relative text-sm group rounded-xl">
                                                        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-7/5 max-md:hidden">
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="eager" src="https://media.luxteria.co/bali-hero.jpg" alt="Bali">
                                                        </div>
                                                        <div class="flex gap-2 mb-2">
                                                            <h3 class="text-base font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                                                                <button type="button" class="text-center w-full max-md:text-sm" @click="setDestination('Bali')">
                                                                    Bali
                                                                    <div class="absolute inset-0"></div>
                                                                </button>
                                                            </h3>
                                                        </div>
                                                    </article>
                                                </li>
                                                <li>
                                                    <article class="relative text-sm group rounded-xl">
                                                        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-7/5 max-md:hidden">
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="eager" src="https://media.luxteria.co/fort-lauderdale-hero.jpg" alt="Fort Lauderdale">
                                                        </div>
                                                        <div class="flex gap-2 mb-2">
                                                            <h3 class="text-base font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                                                                <button type="button" class="text-center w-full max-md:text-sm" @click="setDestination('Fort Lauderdale')">
                                                                    Fort Lauderdale
                                                                    <div class="absolute inset-0"></div>
                                                                </button>
                                                            </h3>
                                                        </div>
                                                    </article>
                                                </li>
                                                <li>
                                                    <article class="relative text-sm group rounded-xl">
                                                        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-7/5 max-md:hidden">
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="eager" src="https://media.luxteria.co/los-angeles-hero.jpg" alt="Los Angeles">
                                                        </div>
                                                        <div class="flex gap-2 mb-2">
                                                            <h3 class="text-base font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                                                                <button type="button" class="text-center w-full max-md:text-sm" @click="setDestination('Los Angeles')">
                                                                    Los Angeles
                                                                    <div class="absolute inset-0"></div>
                                                                </button>
                                                            </h3>
                                                        </div>
                                                    </article>
                                                </li>
                                                <li>
                                                    <article class="relative text-sm group rounded-xl">
                                                        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-7/5 max-md:hidden">
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="eager" src="https://media.luxteria.co/cape-town-hero.jpg" alt="Cape Town">
                                                        </div>
                                                        <div class="flex gap-2 mb-2">
                                                            <h3 class="text-base font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                                                                <button type="button" class="text-center w-full max-md:text-sm" @click="setDestination('Cape Town')">
                                                                    Cape Town
                                                                    <div class="absolute inset-0"></div>
                                                                </button>
                                                            </h3>
                                                        </div>
                                                    </article>
                                                </li>
                                                <li>
                                                    <article class="relative text-sm group rounded-xl">
                                                        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-7/5 max-md:hidden">
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="eager" src="https://media.luxteria.co/costa-rica-hero.jpg" alt="Costa Rica">
                                                        </div>
                                                        <div class="flex gap-2 mb-2">
                                                            <h3 class="text-base font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                                                                <button type="button" class="text-center w-full max-md:text-sm" @click="setDestination('Costa Rica')">
                                                                    Costa Rica
                                                                    <div class="absolute inset-0"></div>
                                                                </button>
                                                            </h3>
                                                        </div>
                                                    </article>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Datepicker Dropdown --}}
                            <div class="absolute left-1/2 z-10 mt-2 flex w-screen max-w-max -translate-x-1/2 px-4 max-md:bottom-full" x-show="showDatepicker" x-transition:enter="transition ease-out duration-350" :class="plannerVisible ? '' : 'bottom-full'" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" style="display: none;">
                                <div class="w-screen max-w-2xl flex-auto bg-black/90 border border-zinc-50/90 backdrop-blur-[2px] rounded-xl shadow-lg ring-1 ring-gray-900/5">
                                    <div class="p-6">
                                        <div class="flex justify-between items-center mb-4">
                                            <div class="flex items-center gap-3">
                                                <label class="font-medium text-zinc-50">Select Date Range</label>
                                                <span x-show="selectingDate" class="px-3 py-1 bg-amber-500/20 text-amber-300 rounded-full text-sm">
                                                    <span x-text="selectingDate === 'from' ? 'Selecting Check-in' : 'Selecting Check-out'"></span>
                                                </span>
                                            </div>
                                            <button type="button" @click="clearDates()" class="text-zinc-300 hover:text-white transition-colors text-sm">Clear dates</button>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            {{-- First Month --}}
                                            <div class="flex flex-col items-center">
                                                <div class="w-full flex justify-between items-center mb-2 border-b border-zinc-200/30 py-1">
                                                    <button type="button" class="size-8 transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-zinc-700 p-1 rounded-md" @click="previousMonth()">
                                                        <svg class="size-6 text-zinc-50 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                                    </button>
                                                    <div class="grow text-center">
                                                        <span x-text="MONTH_NAMES[month]" class="text-sm font-normal text-zinc-50"></span>
                                                        <span x-text="year" class="ml-1 text-sm text-zinc-50 font-normal"></span>
                                                    </div>
                                                    <button type="button" class="size-8 transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-zinc-700 p-1 rounded-md md:hidden" @click="nextMonth()">
                                                        <svg class="h-6 w-6 text-zinc-50 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                                    </button>
                                                </div>
                                                <div class="w-full flex flex-wrap mb-3 -mx-1">
                                                    <template x-for="(day, index) in DAYS" :key="index">
                                                        <div class="w-1/7 px-1"><div x-text="day" class="text-zinc-200 font-normal text-center text-xs"></div></div>
                                                    </template>
                                                </div>
                                                <div class="flex flex-wrap -mx-1">
                                                    <template x-for="blankday in blankdays">
                                                        <div class="w-1/7 text-center border p-1 border-transparent text-sm"></div>
                                                    </template>
                                                    <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                                                        <div class="w-1/7">
                                                            <div @click="getDateValue(date, false, 'first')" x-text="date" class="p-1.5 cursor-pointer text-center text-sm transition ease-in-out duration-100" :class="{
                                                                'font-bold': isToday(date, 'first'),
                                                                'bg-white text-black rounded-l-md': isDateFrom(date, 'first'),
                                                                'bg-white text-black rounded-r-md': isDateTo(date, 'first'),
                                                                'bg-amber-100 text-black': isInRange(date, 'first')
                                                            }"></div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                            {{-- Second Month --}}
                                            <div class="hidden md:flex flex-col items-center">
                                                <div class="w-full flex justify-between items-center mb-2 border-b border-zinc-200/30 py-1">
                                                    <div class="grow md:ms-8 text-center">
                                                        <span x-text="MONTH_NAMES[secondMonth]" class="text-sm font-normal text-zinc-50"></span>
                                                        <span x-text="secondYear" class="ml-1 text-sm text-zinc-50 font-normal"></span>
                                                    </div>
                                                    <button type="button" class="size-8 transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-zinc-700 p-1 rounded-md" @click="nextMonth()">
                                                        <svg class="h-6 w-6 text-zinc-50 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="w-full flex flex-wrap mb-3 -mx-1">
                                                    <template x-for="(day, index) in DAYS" :key="index">
                                                        <div class="w-1/7 px-1"><div x-text="day" class="text-zinc-200 font-normal text-center text-xs"></div></div>
                                                    </template>
                                                </div>
                                                <div class="flex flex-wrap -mx-1">
                                                    <template x-for="blankday in secondBlankdays">
                                                        <div class="w-1/7 text-center border p-1 border-transparent text-sm"></div>
                                                    </template>
                                                    <template x-for="(date, dateIndex) in secondNo_of_days" :key="dateIndex">
                                                        <div class="w-1/7">
                                                            <div @click="getDateValue(date, false, 'second')" x-text="date" class="p-1.5 cursor-pointer text-center text-sm transition ease-in-out duration-100" :class="{
                                                                'font-bold': isToday(date, 'second'),
                                                                'bg-white text-black rounded-l-md': isDateFrom(date, 'second'),
                                                                'bg-white text-black rounded-r-md': isDateTo(date, 'second'),
                                                                'bg-amber-100 text-black': isInRange(date, 'second')
                                                            }"></div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('alpine:init', () => {
                                    Alpine.data('planner', () => ({
                                        showDestinations: false,
                                        showDatepicker: false,
                                        showPlannerFields: false,
                                        plannerVisible: true,
                                        selectingDate: 'from',
                                        dateFromYmd: '',
                                        dateToYmd: '',
                                        guests: 2,
                                        locationName: '',
                                        outputDateFromValue: '',
                                        outputDateToValue: '',
                                        dateFrom: null,
                                        dateTo: null,
                                        month: new Date().getMonth(),
                                        year: new Date().getFullYear(),
                                        secondMonth: (new Date().getMonth() + 1) % 12,
                                        secondYear: new Date().getMonth() === 11 ? new Date().getFullYear() + 1 : new Date().getFullYear(),
                                        no_of_days: [],
                                        blankdays: [],
                                        secondNo_of_days: [],
                                        secondBlankdays: [],
                                        MONTH_NAMES: ['January','February','March','April','May','June','July','August','September','October','November','December'],
                                        DAYS: ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'],
                                        capturedHeight: 0,
                                        hasBeenFixed: true,

                                        init() {
                                            this.getNoOfDays();
                                        },

                                        setDestination(name) {
                                            this.locationName = name;
                                            this.showDestinations = false;
                                        },

                                        openDatePicker(mode) {
                                            this.selectingDate = mode;
                                            this.showDatepicker = true;
                                            this.showDestinations = false;
                                        },

                                        handleSearch() {
                                            alert('Search functionality coming soon!');
                                        },

                                        previousMonth() {
                                            if (this.month === 0) { this.year--; this.month = 11; }
                                            else { this.month--; }
                                            this.updateSecondMonth();
                                            this.getNoOfDays();
                                        },

                                        nextMonth() {
                                            if (this.month === 11) { this.year++; this.month = 0; }
                                            else { this.month++; }
                                            this.updateSecondMonth();
                                            this.getNoOfDays();
                                        },

                                        updateSecondMonth() {
                                            if (this.month === 11) { this.secondMonth = 0; this.secondYear = this.year + 1; }
                                            else { this.secondMonth = this.month + 1; this.secondYear = this.year; }
                                        },

                                        getNoOfDays() {
                                            let dim = new Date(this.year, this.month + 1, 0).getDate();
                                            let dow = new Date(this.year, this.month).getDay();
                                            this.blankdays = [...Array(dow)].map((_, i) => i + 1);
                                            this.no_of_days = [...Array(dim)].map((_, i) => i + 1);
                                            let sdim = new Date(this.secondYear, this.secondMonth + 1, 0).getDate();
                                            let sdow = new Date(this.secondYear, this.secondMonth).getDay();
                                            this.secondBlankdays = [...Array(sdow)].map((_, i) => i + 1);
                                            this.secondNo_of_days = [...Array(sdim)].map((_, i) => i + 1);
                                        },

                                        isToday(date, mt) {
                                            const today = new Date();
                                            const m = mt === 'first' ? this.month : this.secondMonth;
                                            const y = mt === 'first' ? this.year : this.secondYear;
                                            return today.toDateString() === new Date(y, m, date).toDateString();
                                        },

                                        isDateFrom(date, mt) {
                                            const m = mt === 'first' ? this.month : this.secondMonth;
                                            const y = mt === 'first' ? this.year : this.secondYear;
                                            return this.dateFrom ? new Date(y, m, date).getTime() === this.dateFrom.getTime() : false;
                                        },

                                        isDateTo(date, mt) {
                                            const m = mt === 'first' ? this.month : this.secondMonth;
                                            const y = mt === 'first' ? this.year : this.secondYear;
                                            return this.dateTo ? new Date(y, m, date).getTime() === this.dateTo.getTime() : false;
                                        },

                                        isInRange(date, mt) {
                                            const m = mt === 'first' ? this.month : this.secondMonth;
                                            const y = mt === 'first' ? this.year : this.secondYear;
                                            if (!this.dateFrom || !this.dateTo) return false;
                                            const d = new Date(y, m, date);
                                            const min = this.dateFrom < this.dateTo ? this.dateFrom : this.dateTo;
                                            const max = this.dateFrom > this.dateTo ? this.dateFrom : this.dateTo;
                                            return d > min && d < max;
                                        },

                                        convertToYmd(d) {
                                            return d.getFullYear() + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2);
                                        },

                                        getDateValue(date, temp, mt) {
                                            const m = mt === 'first' ? this.month : this.secondMonth;
                                            const y = mt === 'first' ? this.year : this.secondYear;
                                            let sel = new Date(y, m, date);

                                            if (this.selectingDate === 'from') {
                                                this.dateFrom = sel;
                                                if (!this.dateTo) this.dateTo = sel;
                                                else if (sel > this.dateTo) { this.selectingDate = 'to'; this.dateFrom = this.dateTo; this.dateTo = sel; }
                                                this.selectingDate = 'to';
                                            } else {
                                                this.dateTo = sel;
                                                if (!this.dateFrom) this.dateFrom = sel;
                                                else if (sel < this.dateFrom) { this.selectingDate = 'from'; this.dateTo = this.dateFrom; this.dateFrom = sel; }
                                                this.showDatepicker = false;
                                            }

                                            if (this.dateFrom) {
                                                this.outputDateFromValue = this.dateFrom.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                                                this.dateFromYmd = this.convertToYmd(this.dateFrom);
                                            }
                                            if (this.dateTo) {
                                                this.outputDateToValue = this.dateTo.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                                                this.dateToYmd = this.convertToYmd(this.dateTo);
                                            }
                                        },

                                        clearDates() {
                                            this.dateFrom = null;
                                            this.dateTo = null;
                                            this.dateFromYmd = '';
                                            this.dateToYmd = '';
                                            this.outputDateFromValue = '';
                                            this.outputDateToValue = '';
                                            this.selectingDate = 'from';
                                        }
                                    }));
                                });
                            </script>
        </div>
    </div>
        </div>
    </div>
</div>
            <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="flex justify-between">
    <h2 class="text-3xl uppercase font-normal">Popular Destinations</h2>
    <div class="py-2 flex gap-2">
        <button id="section-11-carousel-prev" class="px-1" type="button"><i
        class="fa-sharp fa-light fa-arrow-left fa-xl"></i>
</button>
<button id="section-11-carousel-next" class="px-1" type="button"><i
        class="fa-sharp fa-light fa-arrow-right fa-xl"></i>
</button>
    </div>
</div>
            
            <div id="section-11" class="swiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide wow fadeInUp" data-wow-delay="0ms">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_3442_1926.png') }} 3442w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_2879_1611.png') }} 2879w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_2409_1348.png') }} 2409w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_2015_1128.png') }} 2015w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_1686_943.png') }} 1686w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_1411_790.png') }} 1411w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_1180_660.png') }} 1180w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_987_552.png') }} 987w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_826_462.png') }} 826w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_691_387.png') }} 691w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_578_323.png') }} 578w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_484_271.png') }} 484w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_404_226.png') }} 404w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_338_189.png') }} 338w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_283_158.png') }} 283w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_237_133.png') }} 237w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_198_111.png') }} 198w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_166_93.png') }} 166w, https:/{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_138_77.png') }} 138w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMzQ0MiAxOTI2Ij4KCTxpbWFnZSB3aWR0aD0iMzQ0MiIgaGVpZ2h0PSIxOTI2IiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FFZ0FnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEEzLzdRc1pINmlyaHZJMWd5b3l0Y1ZIdEdNVjJtazJ5dllEY001RmIxSzFrY0dHanpzeHIyN2dkdVJpbTI2UVRkSEg1MXV6YVRaM0FJa0FCckZ1L0NybHQxcE9RUFROSllxYVJ0TEN3YnVjOUY5NGZXdlFkRi93Q1BKZnBSUldGUVdDMllYZlJxTk9KUGVpaWhiSFc5ei8vWiI+Cgk8L2ltYWdlPgo8L3N2Zz4= 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/b98bd7c3ed631d5533a310723913d412/Miami.png') }}" width="3442" height="1926" alt="Miami.png">

    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="{{ url('/') }}">
                Miami
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
</article>
</div>
                            <div class="swiper-slide wow fadeInUp" data-wow-delay="50ms">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy" src="{{ asset('media.luxteria.co/22696e565bd848d8cf54bb0230c92d6d/ft.jpg') }}" alt="ft.jpg">
    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="{{ url('/') }}">
                Fort Lauderdale
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
</article>
</div>
                            <div class="swiper-slide wow fadeInUp" data-wow-delay="100ms">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy" src="{{ asset('media.luxteria.co/83926f30daa706ee9a210a080639d387/Aspen.png') }}" alt="Aspen.png">
    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="{{ url('/') }}">
                Aspen
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
</article>
</div>
                            <div class="swiper-slide wow fadeInUp" data-wow-delay="150ms">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy" src="{{ asset('media.luxteria.co/47d7a9bd4fe2081026fcfde3895ba1c1/LA.png') }}" alt="LA.png">
    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="{{ url('/') }}">
                Los Angeles
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
</article>
</div>
                            <div class="swiper-slide wow fadeInUp" data-wow-delay="200ms">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy" src="{{ asset('media.luxteria.co/8c4cb49a35c6bd10339fe5cccf553c09/Capetown.png') }}" alt="Capetown.png">
    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="{{ url('/') }}">
                Cape Town
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
</article>
</div>
                            <div class="swiper-slide wow fadeInUp" data-wow-delay="250ms">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_5464_3640.jpeg') }} 5464w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_4571_3045.jpeg') }} 4571w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_3824_2547.jpeg') }} 3824w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_3200_2132.jpeg') }} 3200w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_2677_1783.jpeg') }} 2677w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_2240_1492.jpeg') }} 2240w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_1874_1248.jpeg') }} 1874w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_1568_1045.jpeg') }} 1568w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_1311_873.jpeg') }} 1311w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_1097_731.jpeg') }} 1097w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_918_612.jpeg') }} 918w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_768_512.jpeg') }} 768w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_642_428.jpeg') }} 642w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_537_358.jpeg') }} 537w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_449_299.jpeg') }} 449w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_376_250.jpeg') }} 376w, https:/{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_314_209.jpeg') }} 314w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgNTQ2NCAzNjQwIj4KCTxpbWFnZSB3aWR0aD0iNTQ2NCIgaGVpZ2h0PSIzNjQwIiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEE0TzJnQllLU0swREFZV1VJM1h0WE9mYUdFZzhza24ycld0WHVaU0NGSmFoMDVwa09yVHNkQklpMnR1ck9jbHFvdklzcDZnQ3FVcjNFakZicHlvSFNzUzd2MmhrS28rUld0T0hjeG5VN0lvYVpkUEZNRGdOOWEyeHJGeERPQ2dVVVVWcXRqTnJVb2FscXR4Y1NmTWZ5ckhrZG01Sm9vcVJvLzlrPSI+Cgk8L2ltYWdlPgo8L3N2Zz4= 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/be75fb2bbbf526e43575cd5a655da7b7/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc.jpg') }}" width="5464" height="3640" alt="beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc.jpeg">

    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="{{ url('/') }}">
                Bali
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
</article>
</div>
                            <div class="swiper-slide wow fadeInUp" data-wow-delay="300ms">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy" src="{{ asset('media.luxteria.co/042945ba4d80ea1e9d6c20e8db6ec3d4/Costa-Rica.png') }}" alt="Costa Rica.png">
    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="{{ url('/') }}">
                Costa Rica
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
</article>
</div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new window.Swiper('#section-11', {
            modules: [
                window.SwiperModules.Navigation,
                window.SwiperModules.Keyboard,
                window.SwiperModules.HashNavigation,
            ],
            slidesPerView: 2,
            breakpoints: {
                480: {
                    slidesPerView: 1.5,
                    spaceBetween: 16,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 24,
                },
                1280: {
                    slidesPerView: 5,
                    spaceBetween: 24,
                },
            },
            spaceBetween: 12,
            navigation: {
                prevEl: '#section-11-carousel-prev',
                nextEl: '#section-11-carousel-next',
            },
            loop: true,
            keyboard: { enabled: true },
            lazy: { enabled: true },
            hashNavigation: { enabled: true, watchState: true },
            watchSlidesProgress: true,
            observer: true,
            observeParents: true,
        });
    });
</script>
    
            <div class="mt-8">
            
        </div>
</div>
            <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="flex justify-between">
    <h2 class="text-3xl uppercase font-normal">Featured Villas</h2>
    <div class="py-2 flex gap-2">
        
    </div>
</div>
        
            <ul class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    <li wire:key="property-279" class="wow fadeInUp"
                    data-wow-delay="0ms">
                    <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_320_214.jpg') }} 320w, https:/{{ asset('media.luxteria.co/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_337_225.jpg') }} 337w, https:/{{ asset('media.luxteria.co/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_375_250.jpg') }} 375w, https:/{{ asset('media.luxteria.co/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_414_276.jpg') }} 414w, https:/{{ asset('media.luxteria.co/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_640_427.jpg') }} 640w, https:/{{ asset('media.luxteria.co/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_674_450.jpg') }} 674w, https:/{{ asset('media.luxteria.co/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_750_501.jpg') }} 750w, https:/{{ asset('media.luxteria.co/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_828_553.jpg') }} 828w, https:/{{ asset('media.luxteria.co/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_1011_675.jpg') }} 1011w, https:/{{ asset('media.luxteria.co/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_1024_684.jpg') }} 1024w, https:/{{ asset('media.luxteria.co/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_1280_855.jpg') }} 1280w, https:/{{ asset('media.luxteria.co/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_1348_900.jpg') }} 1348w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMTM0OCA5MDAiPgoJPGltYWdlIHdpZHRoPSIxMzQ4IiBoZWlnaHQ9IjkwMCIgeGxpbms6aHJlZj0iZGF0YTppbWFnZS9qcGVnO2Jhc2U2NCwvOWovNEFBUVNrWkpSZ0FCQVFFQVlBQmdBQUQvL2dBK1ExSkZRVlJQVWpvZ1oyUXRhbkJsWnlCMk1TNHdJQ2gxYzJsdVp5QkpTa2NnU2xCRlJ5QjJPREFwTENCa1pXWmhkV3gwSUhGMVlXeHBkSGtLLzlzQVF3QUlCZ1lIQmdVSUJ3Y0hDUWtJQ2d3VURRd0xDd3daRWhNUEZCMGFIeDRkR2h3Y0lDUXVKeUFpTENNY0hDZzNLU3d3TVRRME5COG5PVDA0TWp3dU16UXkvOXNBUXdFSkNRa01Dd3dZRFEwWU1pRWNJVEl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeS84QUFFUWdBRlFBZ0F3RWlBQUlSQVFNUkFmL0VBQjhBQUFFRkFRRUJBUUVCQUFBQUFBQUFBQUFCQWdNRUJRWUhDQWtLQy8vRUFMVVFBQUlCQXdNQ0JBTUZCUVFFQUFBQmZRRUNBd0FFRVFVU0lURkJCaE5SWVFjaWNSUXlnWkdoQ0NOQ3NjRVZVdEh3SkROaWNvSUpDaFlYR0JrYUpTWW5LQ2txTkRVMk56ZzVPa05FUlVaSFNFbEtVMVJWVmxkWVdWcGpaR1ZtWjJocGFuTjBkWFozZUhsNmc0U0Zob2VJaVlxU2s1U1ZscGVZbVpxaW82U2xwcWVvcWFxeXM3UzF0cmU0dWJyQ3c4VEZ4c2ZJeWNyUzA5VFYxdGZZMmRyaDR1UGs1ZWJuNk9ucThmTHo5UFgyOS9qNSt2L0VBQjhCQUFNQkFRRUJBUUVCQVFFQUFBQUFBQUFCQWdNRUJRWUhDQWtLQy8vRUFMVVJBQUlCQWdRRUF3UUhCUVFFQUFFQ2R3QUJBZ01SQkFVaE1RWVNRVkVIWVhFVElqS0JDQlJDa2FHeHdRa2pNMUx3RldKeTBRb1dKRFRoSmZFWEdCa2FKaWNvS1NvMU5qYzRPVHBEUkVWR1IwaEpTbE5VVlZaWFdGbGFZMlJsWm1kb2FXcHpkSFYyZDNoNWVvS0RoSVdHaDRpSmlwS1RsSldXbDVpWm1xS2pwS1dtcDZpcHFyS3p0TFcydDdpNXVzTER4TVhHeDhqSnl0TFQxTlhXMTlqWjJ1TGo1T1htNStqcDZ2THo5UFgyOS9qNSt2L2FBQXdEQVFBQ0VRTVJBRDhBNEcwdDViaVllbGJTNklxOHNDMmZTdVRzZFVuUnZsYkZkYm8ydnNqWW5YZVBVMXpTcktFV3JYWmFwT1VscllxalIyU1J0c1o1cUtHek1Wd2NqbXV3aTFxeWNFRlYzSHBXUk84UnVYZmdWNTA2a25xejBxY1k3STRyU2JXT1ZodXE1ZnpOWi9KRUFCUlJXejFxV1pnMWFuZEZXQzhsUmZNemxxbEdvVHk3bVpxS0t1VVVPbS9kUC8vWiI+Cgk8L2ltYWdlPgo8L3N2Zz4= 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/9f85a6c93db24466772b5cb0498610be/property-279-hostaway-335765230-order-26.jpg') }}" width="320" height="214" alt="IMG_4055.jpg">

    </div>
    
    
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="{{ url('/') }}">
                Casa Blanca
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Miami, Florida</div>
        <div class="flex flex-wrap gap-1.5 mb-2">
            <div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 4 </div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 10</div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>3</div>
        </div>
    </div>

    <div class="flex gap-2 justify-between items-center">
        <div class="relative">
            
        <div class="text-sm">
            <span class="font-semibold">$425</span>
            <span class="text-zinc-400">/night</span>
        </div>
    </div>
            </div>
</article>
                </li>
                            <li wire:key="property-274" class="wow fadeInUp"
                    data-wow-delay="50ms">
                    <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_320_215.png') }} 320w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_375_252.png') }} 375w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_414_278.png') }} 414w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_632_424.png') }} 632w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_640_429.png') }} 640w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_750_503.png') }} 750w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_828_555.png') }} 828w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_1024_687.png') }} 1024w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_1264_848.png') }} 1264w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_1280_859.png') }} 1280w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_1440_966.png') }} 1440w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_1896_1272.png') }} 1896w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_1920_1288.png') }} 1920w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_2048_1374.png') }} 2048w, https:/{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_2528_1696.png') }} 2528w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMjUyOCAxNjk2Ij4KCTxpbWFnZSB3aWR0aD0iMjUyOCIgaGVpZ2h0PSIxNjk2IiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEF5ZEhoTnBlS3NoMnIzcnByZTVpZ3ZTWVpBVFhNUzZUcTBTbVc1UmxVZDZmb2xyY3pUT3loaUY1NXJtaTU3V0dranRZdFp1blowY1pYTldKWFM0aUNCdWU5Y1piYWhlblVEYitVMkNjWnhYWTZkcDBvRzZWVHpXOG05aHhqWTYrZXd0N2lNcElnS24ycUMzMGF5dHMrVkVvejE0b29vS0VYUjdKWnZNRUs3dlhGWFBJVEdNVVVVQWYvMlE9PSI+Cgk8L2ltYWdlPgo8L3N2Zz4= 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/82b7ba6ed315edbb4ca8590b1abc5f0e/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d.png') }}" width="320" height="215" alt="hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d">

    </div>
    
    
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="{{ url('/') }}">
                Villa Lexi
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Miami, Florida</div>
        <div class="flex flex-wrap gap-1.5 mb-2">
            <div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 6 </div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 14</div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>5</div>
        </div>
    </div>

    <div class="flex gap-2 justify-between items-center">
        <div class="relative">
            
        <div class="text-sm">
            <span class="font-semibold">$1,111</span>
            <span class="text-zinc-400">/night</span>
        </div>
    </div>
            </div>
</article>
                </li>
                            <li wire:key="property-271" class="wow fadeInUp"
                    data-wow-delay="100ms">
                    <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_320_212.jpg') }} 320w, https:/{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_375_248.jpg') }} 375w, https:/{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_414_274.jpg') }} 414w, https:/{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_512_339.jpg') }} 512w, https:/{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_640_424.jpg') }} 640w, https:/{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_750_497.jpg') }} 750w, https:/{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_828_548.jpg') }} 828w, https:/{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1024_678.jpg') }} 1024w, https:/{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1280_848.jpg') }} 1280w, https:/{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1440_953.jpg') }} 1440w, https:/{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1536_1017.jpg') }} 1536w, https:/{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1920_1271.jpg') }} 1920w, https:/{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_2048_1356.jpg') }} 2048w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMjA0OCAxMzU2Ij4KCTxpbWFnZSB3aWR0aD0iMjA0OCIgaGVpZ2h0PSIxMzU2IiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEE2MnhsdEpJOTZTcVI5YWx1OVN0b29XMnVDd0hyWG1HaHZlUXcrV3pNSzJoREpMeVdQNTFkVEZhR2xLalozSmJqeEROSk1VQ0U4MUl2blhLWmtHQlZPU0ZvMkRJb0pGVk5RMWg3YU1LY3FheHBZaVYvZWVodlZqRkwzVWMvRHJOeWVSZ1ZaWFc3cFZPQ0tLSytzbmg2U2g4S1BFOXJQbnRjZmI2MWRHVVpJTmJjVnZGcU9HblVFMFVWenp3OUowN3VLTzFUbGZjLy85az0iPgoJPC9pbWFnZT4KPC9zdmc+ 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/973913ee2bd47d7853209f89595b9ac9/IMG_3.jpg') }}" width="320" height="212" alt="IMG_3">

    </div>
    
    
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="{{ url('/') }}">
                Villa Barcelona
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">, Florida</div>
        <div class="flex flex-wrap gap-1.5 mb-2">
            <div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 6 </div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 12</div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>8</div>
        </div>
    </div>

    <div class="flex gap-2 justify-between items-center">
        <div class="relative">
            
        <div class="text-sm">
            <span class="font-semibold">$7,500</span>
            <span class="text-zinc-400">/night</span>
        </div>
    </div>
            </div>
</article>
                </li>
                            <li wire:key="property-270" class="wow fadeInUp"
                    data-wow-delay="150ms">
                    <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/d818c7f3b6fd78e4adf8191cccd9761d/responsive-images/property-270-hostaway-335389803-order-1___media_library_original_320_239.jpg') }} 320w, https:/{{ asset('media.luxteria.co/d818c7f3b6fd78e4adf8191cccd9761d/responsive-images/property-270-hostaway-335389803-order-1___media_library_original_375_280.jpg') }} 375w, https:/{{ asset('media.luxteria.co/d818c7f3b6fd78e4adf8191cccd9761d/responsive-images/property-270-hostaway-335389803-order-1___media_library_original_414_309.jpg') }} 414w, https:/{{ asset('media.luxteria.co/d818c7f3b6fd78e4adf8191cccd9761d/responsive-images/property-270-hostaway-335389803-order-1___media_library_original_640_477.jpg') }} 640w, https:/{{ asset('media.luxteria.co/d818c7f3b6fd78e4adf8191cccd9761d/responsive-images/property-270-hostaway-335389803-order-1___media_library_original_750_560.jpg') }} 750w, https:/{{ asset('media.luxteria.co/d818c7f3b6fd78e4adf8191cccd9761d/responsive-images/property-270-hostaway-335389803-order-1___media_library_original_828_618.jpg') }} 828w, https:/{{ asset('media.luxteria.co/d818c7f3b6fd78e4adf8191cccd9761d/responsive-images/property-270-hostaway-335389803-order-1___media_library_original_960_716.jpg') }} 960w, https:/{{ asset('media.luxteria.co/d818c7f3b6fd78e4adf8191cccd9761d/responsive-images/property-270-hostaway-335389803-order-1___media_library_original_1024_764.jpg') }} 1024w, https:/{{ asset('media.luxteria.co/d818c7f3b6fd78e4adf8191cccd9761d/responsive-images/property-270-hostaway-335389803-order-1___media_library_original_1280_955.jpg') }} 1280w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMTI4MCA5NTUiPgoJPGltYWdlIHdpZHRoPSIxMjgwIiBoZWlnaHQ9Ijk1NSIgeGxpbms6aHJlZj0iZGF0YTppbWFnZS9qcGVnO2Jhc2U2NCwvOWovNEFBUVNrWkpSZ0FCQVFFQVlBQmdBQUQvL2dBK1ExSkZRVlJQVWpvZ1oyUXRhbkJsWnlCMk1TNHdJQ2gxYzJsdVp5QkpTa2NnU2xCRlJ5QjJPREFwTENCa1pXWmhkV3gwSUhGMVlXeHBkSGtLLzlzQVF3QUlCZ1lIQmdVSUJ3Y0hDUWtJQ2d3VURRd0xDd3daRWhNUEZCMGFIeDRkR2h3Y0lDUXVKeUFpTENNY0hDZzNLU3d3TVRRME5COG5PVDA0TWp3dU16UXkvOXNBUXdFSkNRa01Dd3dZRFEwWU1pRWNJVEl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeS84QUFFUWdBR0FBZ0F3RWlBQUlSQVFNUkFmL0VBQjhBQUFFRkFRRUJBUUVCQUFBQUFBQUFBQUFCQWdNRUJRWUhDQWtLQy8vRUFMVVFBQUlCQXdNQ0JBTUZCUVFFQUFBQmZRRUNBd0FFRVFVU0lURkJCaE5SWVFjaWNSUXlnWkdoQ0NOQ3NjRVZVdEh3SkROaWNvSUpDaFlYR0JrYUpTWW5LQ2txTkRVMk56ZzVPa05FUlVaSFNFbEtVMVJWVmxkWVdWcGpaR1ZtWjJocGFuTjBkWFozZUhsNmc0U0Zob2VJaVlxU2s1U1ZscGVZbVpxaW82U2xwcWVvcWFxeXM3UzF0cmU0dWJyQ3c4VEZ4c2ZJeWNyUzA5VFYxdGZZMmRyaDR1UGs1ZWJuNk9ucThmTHo5UFgyOS9qNSt2L0VBQjhCQUFNQkFRRUJBUUVCQVFFQUFBQUFBQUFCQWdNRUJRWUhDQWtLQy8vRUFMVVJBQUlCQWdRRUF3UUhCUVFFQUFFQ2R3QUJBZ01SQkFVaE1RWVNRVkVIWVhFVElqS0JDQlJDa2FHeHdRa2pNMUx3RldKeTBRb1dKRFRoSmZFWEdCa2FKaWNvS1NvMU5qYzRPVHBEUkVWR1IwaEpTbE5VVlZaWFdGbGFZMlJsWm1kb2FXcHpkSFYyZDNoNWVvS0RoSVdHaDRpSmlwS1RsSldXbDVpWm1xS2pwS1dtcDZpcHFyS3p0TFcydDdpNXVzTER4TVhHeDhqSnl0TFQxTlhXMTlqWjJ1TGo1T1htNStqcDZ2THo5UFgyOS9qNSt2L2FBQXdEQVFBQ0VRTVJBRDhBNUQ3Tk8zekt1YTJ0RUZvc2dXNVREVkRwdDRqSUZZWXpWMmFHMTh6Y1pNR3NhMDAzWnMzcEtTVjBkSE1sbjVIRWloY2V0WTV0YmU1WStTNE9QU3VkMU9XUng1Y0VyZm5Sb2d1N0p5WkhKQjlUUkNWUlI5d1UxQ1V2ZUxNRVVjbU5xNHhVamFhOGx5cmJqaWlpdDdJenVUejJNRnQrOGIwckMvdGlNM2p3dWNMMk5GRk9KRlRUWS8vWiI+Cgk8L2ltYWdlPgo8L3N2Zz4= 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/d818c7f3b6fd78e4adf8191cccd9761d/property-270-hostaway-335389803-order-1.jpg') }}" width="320" height="239" alt="hf_20260418_175547_6a018ee8-28ad-44ed-b563-3fe53dbde186.png">

    </div>
    
    
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="{{ url('/') }}">
                Villa Contempa
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Fort Lauderdale, Florida</div>
        <div class="flex flex-wrap gap-1.5 mb-2">
            <div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 7 </div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 18</div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>6</div>
        </div>
    </div>

    <div class="flex gap-2 justify-between items-center">
        <div class="relative">
            
        <div class="text-sm">
            <span class="font-semibold">$2,750</span>
            <span class="text-zinc-400">/night</span>
        </div>
    </div>
            </div>
</article>
                </li>
                            <li wire:key="property-267" class="wow fadeInUp"
                    data-wow-delay="200ms">
                    <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_320_214.jpg') }} 320w, https:/{{ asset('media.luxteria.co/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_337_225.jpg') }} 337w, https:/{{ asset('media.luxteria.co/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_375_250.jpg') }} 375w, https:/{{ asset('media.luxteria.co/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_414_276.jpg') }} 414w, https:/{{ asset('media.luxteria.co/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_640_427.jpg') }} 640w, https:/{{ asset('media.luxteria.co/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_674_450.jpg') }} 674w, https:/{{ asset('media.luxteria.co/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_750_501.jpg') }} 750w, https:/{{ asset('media.luxteria.co/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_828_553.jpg') }} 828w, https:/{{ asset('media.luxteria.co/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_1011_675.jpg') }} 1011w, https:/{{ asset('media.luxteria.co/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_1024_684.jpg') }} 1024w, https:/{{ asset('media.luxteria.co/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_1280_855.jpg') }} 1280w, https:/{{ asset('media.luxteria.co/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_1348_900.jpg') }} 1348w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMTM0OCA5MDAiPgoJPGltYWdlIHdpZHRoPSIxMzQ4IiBoZWlnaHQ9IjkwMCIgeGxpbms6aHJlZj0iZGF0YTppbWFnZS9qcGVnO2Jhc2U2NCwvOWovNEFBUVNrWkpSZ0FCQVFFQVlBQmdBQUQvL2dBK1ExSkZRVlJQVWpvZ1oyUXRhbkJsWnlCMk1TNHdJQ2gxYzJsdVp5QkpTa2NnU2xCRlJ5QjJPREFwTENCa1pXWmhkV3gwSUhGMVlXeHBkSGtLLzlzQVF3QUlCZ1lIQmdVSUJ3Y0hDUWtJQ2d3VURRd0xDd3daRWhNUEZCMGFIeDRkR2h3Y0lDUXVKeUFpTENNY0hDZzNLU3d3TVRRME5COG5PVDA0TWp3dU16UXkvOXNBUXdFSkNRa01Dd3dZRFEwWU1pRWNJVEl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeS84QUFFUWdBRlFBZ0F3RWlBQUlSQVFNUkFmL0VBQjhBQUFFRkFRRUJBUUVCQUFBQUFBQUFBQUFCQWdNRUJRWUhDQWtLQy8vRUFMVVFBQUlCQXdNQ0JBTUZCUVFFQUFBQmZRRUNBd0FFRVFVU0lURkJCaE5SWVFjaWNSUXlnWkdoQ0NOQ3NjRVZVdEh3SkROaWNvSUpDaFlYR0JrYUpTWW5LQ2txTkRVMk56ZzVPa05FUlVaSFNFbEtVMVJWVmxkWVdWcGpaR1ZtWjJocGFuTjBkWFozZUhsNmc0U0Zob2VJaVlxU2s1U1ZscGVZbVpxaW82U2xwcWVvcWFxeXM3UzF0cmU0dWJyQ3c4VEZ4c2ZJeWNyUzA5VFYxdGZZMmRyaDR1UGs1ZWJuNk9ucThmTHo5UFgyOS9qNSt2L0VBQjhCQUFNQkFRRUJBUUVCQVFFQUFBQUFBQUFCQWdNRUJRWUhDQWtLQy8vRUFMVVJBQUlCQWdRRUF3UUhCUVFFQUFFQ2R3QUJBZ01SQkFVaE1RWVNRVkVIWVhFVElqS0JDQlJDa2FHeHdRa2pNMUx3RldKeTBRb1dKRFRoSmZFWEdCa2FKaWNvS1NvMU5qYzRPVHBEUkVWR1IwaEpTbE5VVlZaWFdGbGFZMlJsWm1kb2FXcHpkSFYyZDNoNWVvS0RoSVdHaDRpSmlwS1RsSldXbDVpWm1xS2pwS1dtcDZpcHFyS3p0TFcydDdpNXVzTER4TVhHeDhqSnl0TFQxTlhXMTlqWjJ1TGo1T1htNStqcDZ2THo5UFgyOS9qNSt2L2FBQXdEQVFBQ0VRTVJBRDhBeElydHB2OEFWbjVxMUlGdXZJM1NIQXJOdHROYTJmY0RXcktaSGlDRTRyYWVLeE5XRjVibkJoNk5LakpzaGFPVjAzSzNJTlNBeVl3eTA2Q0psak9EelVBYWZ6VGpOT2hpcTFOZTgyYVY2TktvcnBJdzR0VXVDbTR0elVyYW5jSHZSUlEyMHRCV3V3WFU3aFJ3MVNSNmpQSTVVbWlpaW03dlVtcm90RC8vMlE9PSI+Cgk8L2ltYWdlPgo8L3N2Zz4= 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/96bd15233bb4ee9008469b6df3b852dc/property-267-hostaway-335113589-order-1.jpg') }}" width="320" height="214" alt="POINCIANA KEY-121.jpg">

    </div>
    
    
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="{{ url('/') }}">
                Sanctuary Manor
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">, Florida</div>
        <div class="flex flex-wrap gap-1.5 mb-2">
            <div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 6 </div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 12</div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>6</div>
        </div>
    </div>

    <div class="flex gap-2 justify-between items-center">
        <div class="relative">
            
        <div class="text-sm">
            <span class="font-semibold">$3,000</span>
            <span class="text-zinc-400">/night</span>
        </div>
    </div>
            </div>
</article>
                </li>
                            <li wire:key="property-265" class="wow fadeInUp"
                    data-wow-delay="250ms">
                    <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_320_213.jpeg') }} 320w, https:/{{ asset('media.luxteria.co/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_360_240.jpeg') }} 360w, https:/{{ asset('media.luxteria.co/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_375_250.jpeg') }} 375w, https:/{{ asset('media.luxteria.co/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_414_276.jpeg') }} 414w, https:/{{ asset('media.luxteria.co/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_640_427.jpeg') }} 640w, https:/{{ asset('media.luxteria.co/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_720_480.jpeg') }} 720w, https:/{{ asset('media.luxteria.co/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_750_500.jpeg') }} 750w, https:/{{ asset('media.luxteria.co/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_828_552.jpeg') }} 828w, https:/{{ asset('media.luxteria.co/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_1024_683.jpeg') }} 1024w, https:/{{ asset('media.luxteria.co/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_1080_720.jpeg') }} 1080w, https:/{{ asset('media.luxteria.co/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_1280_853.jpeg') }} 1280w, https:/{{ asset('media.luxteria.co/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_1440_960.jpeg') }} 1440w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMTQ0MCA5NjAiPgoJPGltYWdlIHdpZHRoPSIxNDQwIiBoZWlnaHQ9Ijk2MCIgeGxpbms6aHJlZj0iZGF0YTppbWFnZS9qcGVnO2Jhc2U2NCwvOWovNEFBUVNrWkpSZ0FCQVFFQVlBQmdBQUQvL2dBK1ExSkZRVlJQVWpvZ1oyUXRhbkJsWnlCMk1TNHdJQ2gxYzJsdVp5QkpTa2NnU2xCRlJ5QjJPREFwTENCa1pXWmhkV3gwSUhGMVlXeHBkSGtLLzlzQVF3QUlCZ1lIQmdVSUJ3Y0hDUWtJQ2d3VURRd0xDd3daRWhNUEZCMGFIeDRkR2h3Y0lDUXVKeUFpTENNY0hDZzNLU3d3TVRRME5COG5PVDA0TWp3dU16UXkvOXNBUXdFSkNRa01Dd3dZRFEwWU1pRWNJVEl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeS84QUFFUWdBRlFBZ0F3RWlBQUlSQVFNUkFmL0VBQjhBQUFFRkFRRUJBUUVCQUFBQUFBQUFBQUFCQWdNRUJRWUhDQWtLQy8vRUFMVVFBQUlCQXdNQ0JBTUZCUVFFQUFBQmZRRUNBd0FFRVFVU0lURkJCaE5SWVFjaWNSUXlnWkdoQ0NOQ3NjRVZVdEh3SkROaWNvSUpDaFlYR0JrYUpTWW5LQ2txTkRVMk56ZzVPa05FUlVaSFNFbEtVMVJWVmxkWVdWcGpaR1ZtWjJocGFuTjBkWFozZUhsNmc0U0Zob2VJaVlxU2s1U1ZscGVZbVpxaW82U2xwcWVvcWFxeXM3UzF0cmU0dWJyQ3c4VEZ4c2ZJeWNyUzA5VFYxdGZZMmRyaDR1UGs1ZWJuNk9ucThmTHo5UFgyOS9qNSt2L0VBQjhCQUFNQkFRRUJBUUVCQVFFQUFBQUFBQUFCQWdNRUJRWUhDQWtLQy8vRUFMVVJBQUlCQWdRRUF3UUhCUVFFQUFFQ2R3QUJBZ01SQkFVaE1RWVNRVkVIWVhFVElqS0JDQlJDa2FHeHdRa2pNMUx3RldKeTBRb1dKRFRoSmZFWEdCa2FKaWNvS1NvMU5qYzRPVHBEUkVWR1IwaEpTbE5VVlZaWFdGbGFZMlJsWm1kb2FXcHpkSFYyZDNoNWVvS0RoSVdHaDRpSmlwS1RsSldXbDVpWm1xS2pwS1dtcDZpcHFyS3p0TFcydDdpNXVzTER4TVhHeDhqSnl0TFQxTlhXMTlqWjJ1TGo1T1htNStqcDZ2THo5UFgyOS9qNSt2L2FBQXdEQVFBQ0VRTVJBRDhBcFcrcVdUODd4V3RheTJzd0cyUWMxNW5ITXFOa0hpdDZ4Y1NxcFdYYVI3MXBIRXpmVTVsQ0I2QXFXc1dDOHFqOGFvNmo0aHROTGNBWVllb3JBZUlGQTBsd1RqME5jcnJ0eW9sMmh5d0ZST3ROOVMzeVIwUlZudGtTSUVFMVR1THVhMmpIbHVSUlJYTlgwbXJFR2xwbW9UeXdZZGlmclZQVXNOSms5NktLd2kzZGs5VC8yUT09Ij4KCTwvaW1hZ2U+Cjwvc3ZnPg== 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/2927e02c07686531b53b5a587cbea3ab/property-265-hostaway-333664708-order-140.jpg') }}" width="320" height="213" alt="DJI_0689-Edit">

    </div>
    
    
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="{{ url('/') }}">
                La Maison
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Palmetto Bay, Florida</div>
        <div class="flex flex-wrap gap-1.5 mb-2">
            <div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 8 </div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 16</div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>9</div>
        </div>
    </div>

    <div class="flex gap-2 justify-between items-center">
        <div class="relative">
            
        <div class="text-sm">
            <span class="font-semibold">$3,200</span>
            <span class="text-zinc-400">/night</span>
        </div>
    </div>
            </div>
</article>
                </li>
                            <li wire:key="property-264" class="wow fadeInUp"
                    data-wow-delay="300ms">
                    <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_320_213.jpg') }} 320w, https:/{{ asset('media.luxteria.co/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_337_225.jpg') }} 337w, https:/{{ asset('media.luxteria.co/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_375_250.jpg') }} 375w, https:/{{ asset('media.luxteria.co/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_414_276.jpg') }} 414w, https:/{{ asset('media.luxteria.co/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_640_427.jpg') }} 640w, https:/{{ asset('media.luxteria.co/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_675_450.jpg') }} 675w, https:/{{ asset('media.luxteria.co/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_750_500.jpg') }} 750w, https:/{{ asset('media.luxteria.co/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_828_552.jpg') }} 828w, https:/{{ asset('media.luxteria.co/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_1012_675.jpg') }} 1012w, https:/{{ asset('media.luxteria.co/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_1024_683.jpg') }} 1024w, https:/{{ asset('media.luxteria.co/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_1280_853.jpg') }} 1280w, https:/{{ asset('media.luxteria.co/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_1350_900.jpg') }} 1350w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMTM1MCA5MDAiPgoJPGltYWdlIHdpZHRoPSIxMzUwIiBoZWlnaHQ9IjkwMCIgeGxpbms6aHJlZj0iZGF0YTppbWFnZS9qcGVnO2Jhc2U2NCwvOWovNEFBUVNrWkpSZ0FCQVFFQVlBQmdBQUQvL2dBK1ExSkZRVlJQVWpvZ1oyUXRhbkJsWnlCMk1TNHdJQ2gxYzJsdVp5QkpTa2NnU2xCRlJ5QjJPREFwTENCa1pXWmhkV3gwSUhGMVlXeHBkSGtLLzlzQVF3QUlCZ1lIQmdVSUJ3Y0hDUWtJQ2d3VURRd0xDd3daRWhNUEZCMGFIeDRkR2h3Y0lDUXVKeUFpTENNY0hDZzNLU3d3TVRRME5COG5PVDA0TWp3dU16UXkvOXNBUXdFSkNRa01Dd3dZRFEwWU1pRWNJVEl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeS84QUFFUWdBRlFBZ0F3RWlBQUlSQVFNUkFmL0VBQjhBQUFFRkFRRUJBUUVCQUFBQUFBQUFBQUFCQWdNRUJRWUhDQWtLQy8vRUFMVVFBQUlCQXdNQ0JBTUZCUVFFQUFBQmZRRUNBd0FFRVFVU0lURkJCaE5SWVFjaWNSUXlnWkdoQ0NOQ3NjRVZVdEh3SkROaWNvSUpDaFlYR0JrYUpTWW5LQ2txTkRVMk56ZzVPa05FUlVaSFNFbEtVMVJWVmxkWVdWcGpaR1ZtWjJocGFuTjBkWFozZUhsNmc0U0Zob2VJaVlxU2s1U1ZscGVZbVpxaW82U2xwcWVvcWFxeXM3UzF0cmU0dWJyQ3c4VEZ4c2ZJeWNyUzA5VFYxdGZZMmRyaDR1UGs1ZWJuNk9ucThmTHo5UFgyOS9qNSt2L0VBQjhCQUFNQkFRRUJBUUVCQVFFQUFBQUFBQUFCQWdNRUJRWUhDQWtLQy8vRUFMVVJBQUlCQWdRRUF3UUhCUVFFQUFFQ2R3QUJBZ01SQkFVaE1RWVNRVkVIWVhFVElqS0JDQlJDa2FHeHdRa2pNMUx3RldKeTBRb1dKRFRoSmZFWEdCa2FKaWNvS1NvMU5qYzRPVHBEUkVWR1IwaEpTbE5VVlZaWFdGbGFZMlJsWm1kb2FXcHpkSFYyZDNoNWVvS0RoSVdHaDRpSmlwS1RsSldXbDVpWm1xS2pwS1dtcDZpcHFyS3p0TFcydDdpNXVzTER4TVhHeDhqSnl0TFQxTlhXMTlqWjJ1TGo1T1htNStqcDZ2THo5UFgyOS9qNSt2L2FBQXdEQVFBQ0VRTVJBRDhBNUhUL0FCRmFwR0NUelhRV092V2t6cXA0elhuMXZad1F1cGR1TTExa0Q2WTlzb1FxcmlqNjQ1TldRNHl0SGM3NjJ2Tk9SUXp5Q3RxMTFiU1VpMythb0E5NjgxU08zUzJMdk1DUHJXVmU2cGIrUTBVY2hCOWpXVlhFeXZabzBqSk5YdWNmSkt4NzAxSm5Yb3hvb3JtU09GRXJYMXh0MitZY2VtYWdhVmoxTkZGVllwSC8yUT09Ij4KCTwvaW1hZ2U+Cjwvc3ZnPg== 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/ece078f6b4a76ba57da525e2f1d8141e/property-264-hostaway-333507462-order-1.jpg') }}" width="320" height="213" alt="02..jpeg">

    </div>
    
    
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="{{ url('/') }}">
                Villa Larsa
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Hallandale Beach, Florida</div>
        <div class="flex flex-wrap gap-1.5 mb-2">
            <div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 5 </div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 12</div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>3</div>
        </div>
    </div>

    <div class="flex gap-2 justify-between items-center">
        <div class="relative">
            
        <div class="text-sm">
            <span class="font-semibold">$1,300</span>
            <span class="text-zinc-400">/night</span>
        </div>
    </div>
            </div>
</article>
                </li>
                            <li wire:key="property-263" class="wow fadeInUp"
                    data-wow-delay="350ms">
                    <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_320_180.jpg') }} 320w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_375_211.jpg') }} 375w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_414_233.jpg') }} 414w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_640_360.jpg') }} 640w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_750_422.jpg') }} 750w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_828_466.jpg') }} 828w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_1024_576.jpg') }} 1024w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_1280_720.jpg') }} 1280w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_1440_810.jpg') }} 1440w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_1920_1080.jpg') }} 1920w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_2048_1152.jpg') }} 2048w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_2560_1440.jpg') }} 2560w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_2880_1620.jpg') }} 2880w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_4096_2304.jpg') }} 4096w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_6144_3456.jpg') }} 6144w, https:/{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_8192_4608.jpg') }} 8192w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgODE5MiA0NjA4Ij4KCTxpbWFnZSB3aWR0aD0iODE5MiIgaGVpZ2h0PSI0NjA4IiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FFZ0FnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEE1cE5TM1RDTlZKSnJlc0RQdnp0T0s1dXp2cmVLNDNPcThkNjZTTHhKWklnSks1cnRxWmhpR3JJOHlsbGVIakxtc3pXKzJ5UURKaU9CVlllSjRiV1l5dndCMnF1ZkZ0bktwVmd1SzVMV3JpRzltSmljS2hxUHJWU1dram9lRmhCWGljanViKzhmenBDN2YzaitkRkZjek9xT3dnZHR2M2orZEx2YmI5NC9uUlJURTlqLzJRPT0iPgoJPC9pbWFnZT4KPC9zdmc+ 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/e4e4a614e00fce5739c7047c8a0834cb/01.jpg') }}" width="320" height="180" alt="01">

    </div>
    
    
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="{{ url('/') }}">
                Casa Lumina
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Fort Lauderdale, Florida</div>
        <div class="flex flex-wrap gap-1.5 mb-2">
            <div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 4 </div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 10</div>
            ·
            <div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>5</div>
        </div>
    </div>

    <div class="flex gap-2 justify-between items-center">
        <div class="relative">
            
        <div class="text-sm">
            <span class="font-semibold">$3,000</span>
            <span class="text-zinc-400">/night</span>
        </div>
    </div>
            </div>
</article>
                </li>
</ul>
</div>
            <style>
    @keyframes marquee {
        0% {
            transform: translateX(0%);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    .marquee-container {
        overflow: hidden;
        position: relative;
    }

    .marquee-track {
        display: flex;
        gap: 5rem;
        animation: marquee 30s linear infinite;
    }

    @media (max-width: 1024px) {
        .marquee-track {
            gap: 3.75rem;
            animation-duration: 25s;
        }
    }

    @media (max-width: 768px) {
        .marquee-track {
            gap: 3rem;
            animation-duration: 20s;
        }
    }

    @media (max-width: 640px) {
        .marquee-track {
            gap: 2.5rem;
            animation-duration: 15s;
        }
    }
</style>

<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6 !py-24">
    <h2 class="text-center uppercase text-white mb-10">Trusted By</h2>

    <div class="relative max-w-7xl mx-auto">
        <!-- Pure CSS Marquee -->
        <div class="marquee-container">
            <div class="marquee-track">
                
                                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/AIRBNB.png') }}"
                                alt="Airbnb"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/VRBO.png') }}"
                                alt="VRBO"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/One%20fine%20stay.png') }}"
                                alt="One Fine Stay"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Plum%20guide.png') }}"
                                alt="Plum Guide"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Luxe.png') }}"
                                alt="Luxe"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Oliver%20travels.png') }}"
                                alt="Oliver Travels"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Stay%20one.png') }}"
                                alt="Stay One"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Quintess.png') }}"
                                alt="Quintess"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/FAVR.png') }}"
                                alt="FAVR"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/BBB.png') }}"
                                alt="Better Business Bureau"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Visit%20lauderdale.png') }}"
                                alt="Visit Lauderdale"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/VRMA.png') }}"
                                alt="VRMA"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/American%20express.png') }}"
                                alt="American Express"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Visa.png') }}"
                                alt="Visa"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Mastercard.png') }}"
                                alt="Mastercard"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Discover.png') }}"
                                alt="Discover"
                                loading="lazy" />
                        </div>
                                                                                <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/AIRBNB.png') }}"
                                alt="Airbnb"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/VRBO.png') }}"
                                alt="VRBO"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/One%20fine%20stay.png') }}"
                                alt="One Fine Stay"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Plum%20guide.png') }}"
                                alt="Plum Guide"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Luxe.png') }}"
                                alt="Luxe"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Oliver%20travels.png') }}"
                                alt="Oliver Travels"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Stay%20one.png') }}"
                                alt="Stay One"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Quintess.png') }}"
                                alt="Quintess"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/FAVR.png') }}"
                                alt="FAVR"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/BBB.png') }}"
                                alt="Better Business Bureau"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Visit%20lauderdale.png') }}"
                                alt="Visit Lauderdale"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/VRMA.png') }}"
                                alt="VRMA"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/American%20express.png') }}"
                                alt="American Express"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Visa.png') }}"
                                alt="Visa"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Mastercard.png') }}"
                                alt="Mastercard"
                                loading="lazy" />
                        </div>
                                            <div class="flex-shrink-0 flex items-center justify-center max-w-48">
                            <img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Discover.png') }}"
                                alt="Discover"
                                loading="lazy" />
                        </div>
                                                </div>
        </div>
    </div>
</div>
            <div class="bg-black text-white relative -mb-8">
    <div class="relative isolate pt-14 min-h-[70vh] flex items-center">
                    @if(isset($homepageMedia['middle-section-bg']) && $homepageMedia['middle-section-bg']->file_path)
                        <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('storage/' . $homepageMedia['middle-section-bg']->file_path) }}" alt="Background">
                    @else
                        <img class="absolute inset-0 -z-10 size-full object-cover" src="{{ asset('media.luxteria.co/b7cfd06c1d9d677f1e2943af6e51a36b/126.jpg') }}" alt="126.jpg">
                    @endif
                <div
            class="absolute top-0 left-0 pointer-events-none w-full h-26 -z-10 bg-gradient-to-b from-black from-0% via-black/15 via-70% to-black/0 to-95% bg-blend-overlay"></div>
        <div
            class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0">

        </div>
    </div>
</div>
            <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="text-center space-y-3 max-w-2xl mx-auto">
                    <div
                class="uppercase text-lg tracking-wider text-balance font-normal">vacation made easy</div>
                            <h2 class="uppercase font-semibold">Fully Operated by luxteria</h2>
                            <p>Every villa in our collection is personally managed by our team, blending five-star hospitality with the privacy, space, and comfort of a true home.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-16 my-16">
                            <div class="space-y-3">
                                            <div>
                            <i class="fa-sharp fa-light fa-circle-check fa-xl"></i>
                        </div>
                                                                <h3>Handpicked and luxteria-Approved</h3>
                                                                <div class="content-format"><p>Each residence is thoughtfully chosen and maintained to our exacting standards, ensuring every stay is as seamless as it is memorable.</p></div>
                                    </div>
                            <div class="space-y-3">
                                            <div>
                            <i class="fa-sharp fa-light fa-sparkle fa-xl"></i>
                        </div>
                                                                <h3>Flawless from the Moment You Arrive</h3>
                                                                <div class="content-format"><p>Our meticulous 302-point cleaning process ensures each villa is pristine upon arrival, no chores, no surprises, and no to-do lists at departure.</p></div>
                                    </div>
                            <div class="space-y-3">
                                            <div>
                            <i class="fa-sharp fa-light fa-spa fa-xl"></i>
                        </div>
                                                                <h3>Premium Amenities for Work and Play</h3>
                                                                <div class="content-format"><p>From high-speed connectivity and serene workspaces to heated pools and in-home spa experiences, every home is prepared for both productivity and pleasure.</p></div>
                                    </div>
                            <div class="space-y-3">
                                            <div>
                            <i class="fa-sharp fa-light fa-plane fa-xl"></i>
                        </div>
                                                                <h3>Inspiring Destinations</h3>
                                                                <div class="content-format"><p>Whether waking to oceanfront sunrises or unwinding at golden hour from a hillside terrace, every location is chosen to evoke connection, wonder, and peace.</p></div>
                                    </div>
                            <div class="space-y-3">
                                            <div>
                            <i class="fa-sharp fa-light fa-house fa-xl"></i>
                        </div>
                                                                <h3>Beauty Beyond the Photograph</h3>
                                                                <div class="content-format"><p>Our villas are not just picture-perfect, they are designed and curated to feel even more exquisite in person, with every detail considered for comfort and style.</p></div>
                                    </div>
                            <div class="space-y-3">
                                            <div>
                            <i class="fa-sharp fa-light fa-bell fa-xl"></i>
                        </div>
                                                                <h3>24/7 Personalized Concierge</h3>
                                                                <div class="content-format"><p>From private chefs and spa treatments to sunset cruises and last-minute reservations, our concierge team is always on hand to tailor every detail of your stay, day or night.</p></div>
                                    </div>
                    </div>
</div>
            <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="flex justify-between">
    <h2 class="text-3xl uppercase font-normal">Recent Reviews</h2>
    <div class="py-2 flex gap-2">
        <button id="reviews-carousel-prev" class="px-1" type="button"><i
        class="fa-sharp fa-light fa-arrow-left fa-xl"></i>
</button>
<button id="reviews-carousel-next" class="px-1" type="button"><i
        class="fa-sharp fa-light fa-arrow-right fa-xl"></i>
</button>
    </div>
</div>
            
                        <style>
        #reviews .swiper-slide {
            height: auto;
        }
    </style>

<div id="reviews" class="swiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&)]:text-sm [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
    <i class="fa-brands fa-google fa-xl me-2"></i>
    <span class="relative -top-0.5">
                        <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                </span>
</div>
                <div class="font-semibold">Cj Laboy</div>
            </figcaption>

            <blockquote class="grow">
                <p>
                    <span>Thank
You for hosting my client and their guests. They thoroughly enjoyed their stay there.</span>
                </p>
            </blockquote>

                            <a href="{{ url('/') }}"
                   class="text-base uppercase font-normal self-end tracking-wide">Boardwalk Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&)]:text-sm [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
    <i class="fa-brands fa-google fa-xl me-2"></i>
    <span class="relative -top-0.5">
                        <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                </span>
</div>
                <div class="font-semibold"></div>
            </figcaption>

            <blockquote class="grow">
                <p>
                    <span>An absolutely stunning place.</span>
                </p>
            </blockquote>

                            <a href="{{ url('/') }}"
                   class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&)]:text-sm [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
    <i class="fa-brands fa-google fa-xl me-2"></i>
    <span class="relative -top-0.5">
                        <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                </span>
</div>
                <div class="font-semibold"></div>
            </figcaption>

            <blockquote class="grow">
                <p>
                    <span>Perfect stay as always</span>
                </p>
            </blockquote>

                            <a href="{{ url('/') }}"
                   class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&)]:text-sm [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
    <i class="fa-brands fa-google fa-xl me-2"></i>
    <span class="relative -top-0.5">
                        <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                </span>
</div>
                <div class="font-semibold"></div>
            </figcaption>

            <blockquote class="grow">
                <p>
                    <span>We had a  great time! The house was awesome.</span>
                </p>
            </blockquote>

                            <a href="{{ url('/') }}"
                   class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&)]:text-sm [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
    <i class="fa-brands fa-google fa-xl me-2"></i>
    <span class="relative -top-0.5">
                        <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                </span>
</div>
                <div class="font-semibold">Jonai Green</div>
            </figcaption>

            <blockquote class="grow">
                <p>
                    <span>Beautiful home just like the pictures</span>
                </p>
            </blockquote>

                            <a href="{{ url('/') }}"
                   class="text-base uppercase font-normal self-end tracking-wide">Boardwalk Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&)]:text-sm [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
    <i class="fa-brands fa-google fa-xl me-2"></i>
    <span class="relative -top-0.5">
                        <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                </span>
</div>
                <div class="font-semibold">Micky Stefanov</div>
            </figcaption>

            <blockquote class="grow">
                <p>
                    <span></span>
                </p>
            </blockquote>

                            <a href="{{ url('/') }}"
                   class="text-base uppercase font-normal self-end tracking-wide">Las Palmas Royal Estate</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&)]:text-sm [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
    <i class="fa-brands fa-google fa-xl me-2"></i>
    <span class="relative -top-0.5">
                        <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                </span>
</div>
                <div class="font-semibold">Holly Ritchie</div>
            </figcaption>

            <blockquote class="grow">
                <p>
                    <span>Loved the property… bubbles didn’t work in hot tub… pool was cold… recommend a booklet of checkin rules.. how to work appliances.. hot tub.. air conditioning etc.  asked and agreed to late. Ch...</span>
                </p>
            </blockquote>

                            <a href="{{ url('/') }}"
                   class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&)]:text-sm [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
    <i class="fa-brands fa-google fa-xl me-2"></i>
    <span class="relative -top-0.5">
                        <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                </span>
</div>
                <div class="font-semibold">Terry Tsimiklis</div>
            </figcaption>

            <blockquote class="grow">
                <p>
                    <span>We were 16 people on a golf trip. The house was great and the service was even better. We booked the night before our arrival and the house was clean and ready to go by 4:00pm check in. Thank you Kath...</span>
                </p>
            </blockquote>

                            <a href="{{ url('/') }}"
                   class="text-base uppercase font-normal self-end tracking-wide">Modani Estates</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&)]:text-sm [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
    <i class="fa-brands fa-google fa-xl me-2"></i>
    <span class="relative -top-0.5">
                        <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                </span>
</div>
                <div class="font-semibold">John Alley</div>
            </figcaption>

            <blockquote class="grow">
                <p>
                    <span>Amazing property! Great communication. We had a blast. Thank you </span>
                </p>
            </blockquote>

                            <a href="{{ url('/') }}"
                   class="text-base uppercase font-normal self-end tracking-wide">Las Palmas Royal Estate</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&)]:text-sm [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
    <i class="fa-brands fa-google fa-xl me-2"></i>
    <span class="relative -top-0.5">
                        <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                </span>
</div>
                <div class="font-semibold">kristie Grandsko</div>
            </figcaption>

            <blockquote class="grow">
                <p>
                    <span>What an incredible home for a family vacation! Conveniently located, very clean, great pool and hot tub and plenty of space for everyone to spread out! We met Kathy, the manager at check in and she wa...</span>
                </p>
            </blockquote>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&)]:text-sm [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
    <i class="fa-brands fa-google fa-xl me-2"></i>
    <span class="relative -top-0.5">
                        <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                </span>
</div>
                <div class="font-semibold">Chris Blevins</div>
            </figcaption>

            <blockquote class="grow">
                <p>
                    <span></span>
                </p>
            </blockquote>

                            <a href="{{ url('/') }}"
                   class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&)]:text-sm [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
    <i class="fa-brands fa-google fa-xl me-2"></i>
    <span class="relative -top-0.5">
                        <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                    <i class="fa-sharp fa-star fa-solid"></i>
                </span>
</div>
                <div class="font-semibold"></div>
            </figcaption>

            <blockquote class="grow">
                <p>
                    <span>This place was great and Elly and Kathy were very responsive leading up to and during our stay. I’d recommend this place to anyone!</span>
                </p>
            </blockquote>
</div>
    </figure>
</article>
</div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new window.Swiper('#reviews', {
            modules: [
                window.SwiperModules.Navigation,
                window.SwiperModules.Keyboard,
                window.SwiperModules.HashNavigation,
            ],
            slidesPerView: 1,
            breakpoints: {
                480: {
                    slidesPerView: 1.2,
                    spaceBetween: 16,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 24,
                },
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 24,
                },
            },
            spaceBetween: 12,
            navigation: {
                prevEl: '#reviews-carousel-prev',
                nextEl: '#reviews-carousel-next',
            },
            loop: true,
            keyboard: { enabled: true },
            lazy: { enabled: true },
            hashNavigation: { enabled: true, watchState: true },
            watchSlidesProgress: true,
            observer: true,
            observeParents: true,
        });
    });
</script>
</div>
            <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="max-w-4xl mx-auto space-y-6">
                    <h2 class="uppercase font-semibold text-center">Frequently Asked Questions</h2>
                
                    <dl class="space-y-3" x-data="{ openFaq: null }">
                                                            <article class="relative text-sm group rounded-xl bg-zinc-800">
    <div class="p-6">
    <dt>
            <button
                type="button"
                class="flex w-full items-start justify-between gap-6 text-left"
                aria-controls="faq-0"
                :aria-expanded="openFaq === 0"
                @click="openFaq = openFaq === 0 ? null : 0"
            >
                <h3 class="text-base font-semibold">What is the minimum age requirement to book a stay with luxteria?</h3>
                <span class="flex size-6 items-center">
                    <i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                       :class="{ 'rotate-45': openFaq === 0 }"></i>
                </span>
            </button>
        </dt>
        <dd
            class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out"
            id="faq-0"
            x-show="openFaq === 0"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 max-h-0"
            x-transition:enter-end="opacity-100 max-h-96"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 max-h-96"
            x-transition:leave-end="opacity-0 max-h-0"
        >
            <p class="">Guests must be at least 21 years old to book a luxteria villa.</p>
        </dd>
</div>
</article>
                                                                                <article class="relative text-sm group rounded-xl bg-zinc-800">
    <div class="p-6">
    <dt>
            <button
                type="button"
                class="flex w-full items-start justify-between gap-6 text-left"
                aria-controls="faq-1"
                :aria-expanded="openFaq === 1"
                @click="openFaq = openFaq === 1 ? null : 1"
            >
                <h3 class="text-base font-semibold">How can I reserve a luxteria property?</h3>
                <span class="flex size-6 items-center">
                    <i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                       :class="{ 'rotate-45': openFaq === 1 }"></i>
                </span>
            </button>
        </dt>
        <dd
            class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out"
            id="faq-1"
            x-show="openFaq === 1"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 max-h-0"
            x-transition:enter-end="opacity-100 max-h-96"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 max-h-96"
            x-transition:leave-end="opacity-0 max-h-0"
        >
            <p class="">You can reserve a property by submitting an inquiry or contacting our reservations team at 786-981-0924 or <a href="cdn-cgi/l/email-protection.html" class="__cf_email__" data-cfemail="cdafa2a2a6a4a3aabe8da1b8b5b8bfa4e3aea2a0">[email&#160;protected]</a>. Due to high demand, a 50% deposit is required to secure your booking.</p>
        </dd>
</div>
</article>
                                                                                <article class="relative text-sm group rounded-xl bg-zinc-800">
    <div class="p-6">
    <dt>
            <button
                type="button"
                class="flex w-full items-start justify-between gap-6 text-left"
                aria-controls="faq-2"
                :aria-expanded="openFaq === 2"
                @click="openFaq = openFaq === 2 ? null : 2"
            >
                <h3 class="text-base font-semibold">Can I host an event at a luxteria property?</h3>
                <span class="flex size-6 items-center">
                    <i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                       :class="{ 'rotate-45': openFaq === 2 }"></i>
                </span>
            </button>
        </dt>
        <dd
            class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out"
            id="faq-2"
            x-show="openFaq === 2"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 max-h-0"
            x-transition:enter-end="opacity-100 max-h-96"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 max-h-96"
            x-transition:leave-end="opacity-0 max-h-0"
        >
            <p class="">Event availability varies by property. Additional event fees may apply in addition to the nightly rate. Please contact us at 786-981-0924 for personalized assistance.</p>
        </dd>
</div>
</article>
                                                                                <article class="relative text-sm group rounded-xl bg-zinc-800">
    <div class="p-6">
    <dt>
            <button
                type="button"
                class="flex w-full items-start justify-between gap-6 text-left"
                aria-controls="faq-3"
                :aria-expanded="openFaq === 3"
                @click="openFaq = openFaq === 3 ? null : 3"
            >
                <h3 class="text-base font-semibold">What is luxteria’s cancellation policy?</h3>
                <span class="flex size-6 items-center">
                    <i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                       :class="{ 'rotate-45': openFaq === 3 }"></i>
                </span>
            </button>
        </dt>
        <dd
            class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out"
            id="faq-3"
            x-show="openFaq === 3"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 max-h-0"
            x-transition:enter-end="opacity-100 max-h-96"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 max-h-96"
            x-transition:leave-end="opacity-0 max-h-0"
        >
            <p class="">Cancellations must be made at least 30 days prior to check-in for a partial refund, minus a 25% cancellation fee.
Cancellations made 13 days or fewer before check-in are non-refundable, though the security deposit will be returned.</p>
        </dd>
</div>
</article>
                                                                                <article class="relative text-sm group rounded-xl bg-zinc-800">
    <div class="p-6">
    <dt>
            <button
                type="button"
                class="flex w-full items-start justify-between gap-6 text-left"
                aria-controls="faq-4"
                :aria-expanded="openFaq === 4"
                @click="openFaq = openFaq === 4 ? null : 4"
            >
                <h3 class="text-base font-semibold">Are pets allowed at luxteria properties?</h3>
                <span class="flex size-6 items-center">
                    <i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                       :class="{ 'rotate-45': openFaq === 4 }"></i>
                </span>
            </button>
        </dt>
        <dd
            class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out"
            id="faq-4"
            x-show="openFaq === 4"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 max-h-0"
            x-transition:enter-end="opacity-100 max-h-96"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 max-h-96"
            x-transition:leave-end="opacity-0 max-h-0"
        >
            <p class="">Some luxteria homes are pet-friendly. Check the individual listing details or reach out to our team to confirm if a property can accommodate your pet.</p>
        </dd>
</div>
</article>
                                                                                <article class="relative text-sm group rounded-xl bg-zinc-800">
    <div class="p-6">
    <dt>
            <button
                type="button"
                class="flex w-full items-start justify-between gap-6 text-left"
                aria-controls="faq-5"
                :aria-expanded="openFaq === 5"
                @click="openFaq = openFaq === 5 ? null : 5"
            >
                <h3 class="text-base font-semibold">Does luxteria offer personalized services during my stay?</h3>
                <span class="flex size-6 items-center">
                    <i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                       :class="{ 'rotate-45': openFaq === 5 }"></i>
                </span>
            </button>
        </dt>
        <dd
            class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out"
            id="faq-5"
            x-show="openFaq === 5"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 max-h-0"
            x-transition:enter-end="opacity-100 max-h-96"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 max-h-96"
            x-transition:leave-end="opacity-0 max-h-0"
        >
            <p class="">Absolutely. We provide a range of luxury concierge services, including private chefs, in-villa spa treatments, and custom itinerary planning to enhance your stay.</p>
        </dd>
</div>
</article>
                                                                                <article class="relative text-sm group rounded-xl bg-zinc-800">
    <div class="p-6">
    <dt>
            <button
                type="button"
                class="flex w-full items-start justify-between gap-6 text-left"
                aria-controls="faq-6"
                :aria-expanded="openFaq === 6"
                @click="openFaq = openFaq === 6 ? null : 6"
            >
                <h3 class="text-base font-semibold">Can I use luxteria concierge services without booking a villa?</h3>
                <span class="flex size-6 items-center">
                    <i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                       :class="{ 'rotate-45': openFaq === 6 }"></i>
                </span>
            </button>
        </dt>
        <dd
            class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out"
            id="faq-6"
            x-show="openFaq === 6"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 max-h-0"
            x-transition:enter-end="opacity-100 max-h-96"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 max-h-96"
            x-transition:leave-end="opacity-0 max-h-0"
        >
            <p class="">Yes. Our concierge services are available independently of villa bookings and can be arranged worldwide. Explore our offerings on the Concierge page.</p>
        </dd>
</div>
</article>
                                                                                <article class="relative text-sm group rounded-xl bg-zinc-800">
    <div class="p-6">
    <dt>
            <button
                type="button"
                class="flex w-full items-start justify-between gap-6 text-left"
                aria-controls="faq-7"
                :aria-expanded="openFaq === 7"
                @click="openFaq = openFaq === 7 ? null : 7"
            >
                <h3 class="text-base font-semibold">How does luxteria ensure guest privacy and discretion?</h3>
                <span class="flex size-6 items-center">
                    <i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                       :class="{ 'rotate-45': openFaq === 7 }"></i>
                </span>
            </button>
        </dt>
        <dd
            class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out"
            id="faq-7"
            x-show="openFaq === 7"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 max-h-0"
            x-transition:enter-end="opacity-100 max-h-96"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 max-h-96"
            x-transition:leave-end="opacity-0 max-h-0"
        >
            <p class="">We prioritize complete discretion and privacy. Many of our villas offer private entrances, gated access, and exclusive amenities to ensure your experience is both luxurious and confidential.</p>
        </dd>
</div>
</article>
                                                </dl>
            </div>
</div>
            <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="flex justify-between">
    <h2 class="text-3xl uppercase font-normal">Latest Articles</h2>
    <div class="py-2 flex gap-2">
        
    </div>
</div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-8">
                            <div class="wow fadeInUp" data-wow-delay="0ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_187_125.jpg') }} 187w, https:/{{ asset('media.luxteria.co/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_320_213.jpg') }} 320w, https:/{{ asset('media.luxteria.co/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_375_250.jpg') }} 375w, https:/{{ asset('media.luxteria.co/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_414_276.jpg') }} 414w, https:/{{ asset('media.luxteria.co/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_562_375.jpg') }} 562w, https:/{{ asset('media.luxteria.co/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_640_427.jpg') }} 640w, https:/{{ asset('media.luxteria.co/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_750_500.jpg') }} 750w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgNzUwIDUwMCI+Cgk8aW1hZ2Ugd2lkdGg9Ijc1MCIgaGVpZ2h0PSI1MDAiIHhsaW5rOmhyZWY9ImRhdGE6aW1hZ2UvanBlZztiYXNlNjQsLzlqLzRBQVFTa1pKUmdBQkFRRUFZQUJnQUFELy9nQStRMUpGUVZSUFVqb2daMlF0YW5CbFp5QjJNUzR3SUNoMWMybHVaeUJKU2tjZ1NsQkZSeUIyT0RBcExDQmtaV1poZFd4MElIRjFZV3hwZEhrSy85c0FRd0FJQmdZSEJnVUlCd2NIQ1FrSUNnd1VEUXdMQ3d3WkVoTVBGQjBhSHg0ZEdod2NJQ1F1SnlBaUxDTWNIQ2czS1N3d01UUTBOQjhuT1QwNE1qd3VNelF5LzlzQVF3RUpDUWtNQ3d3WURRMFlNaUVjSVRJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXkvOEFBRVFnQUZRQWdBd0VpQUFJUkFRTVJBZi9FQUI4QUFBRUZBUUVCQVFFQkFBQUFBQUFBQUFBQkFnTUVCUVlIQ0FrS0MvL0VBTFVRQUFJQkF3TUNCQU1GQlFRRUFBQUJmUUVDQXdBRUVRVVNJVEZCQmhOUllRY2ljUlF5Z1pHaENDTkNzY0VWVXRId0pETmljb0lKQ2hZWEdCa2FKU1luS0NrcU5EVTJOemc1T2tORVJVWkhTRWxLVTFSVlZsZFlXVnBqWkdWbVoyaHBhbk4wZFhaM2VIbDZnNFNGaG9lSWlZcVNrNVNWbHBlWW1acWlvNlNscHFlb3FhcXlzN1MxdHJlNHVickN3OFRGeHNmSXljclMwOVRWMXRmWTJkcmg0dVBrNWVibjZPbnE4Zkx6OVBYMjkvajUrdi9FQUI4QkFBTUJBUUVCQVFFQkFRRUFBQUFBQUFBQkFnTUVCUVlIQ0FrS0MvL0VBTFVSQUFJQkFnUUVBd1FIQlFRRUFBRUNkd0FCQWdNUkJBVWhNUVlTUVZFSFlYRVRJaktCQ0JSQ2thR3h3UWtqTTFMd0ZXSnkwUW9XSkRUaEpmRVhHQmthSmljb0tTbzFOamM0T1RwRFJFVkdSMGhKU2xOVVZWWlhXRmxhWTJSbFptZG9hV3B6ZEhWMmQzaDVlb0tEaElXR2g0aUppcEtUbEpXV2w1aVptcUtqcEtXbXA2aXBxckt6dExXMnQ3aTV1c0xEeE1YR3g4akp5dExUMU5YVzE5aloydUxqNU9YbTUranA2dkx6OVBYMjkvajUrdi9hQUF3REFRQUNFUU1SQUQ4QXFhQmNSQU0yZUszYkRWaUxoZzQrWFBCcmg5RWdudHJQekpUeFhXYm9IMDlXang1aEZjTlZ5anFlbGgrV1c1YjF6VkNxSzhMWjlxcFdGM0pmUU1adUt5WmxsYzRPVFVmbDNsdXBDdGhhSVRiWmVJcHh0ZUp3TnRyMTdJRmpML0xYY2FYUEk4S1pQVVVVVlZYV2FUTUtEdFRiUmFNN3JjQmVvcWxxMm96S3B4Z1lvb3Fra2t5WlNkMGovOWs9Ij4KCTwvaW1hZ2U+Cjwvc3ZnPg== 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/b881777ab725a0f9e84ef26bad1a9968/featured.jpg') }}" width="187" height="125" alt="Three women sitting on a striped lounge chair, toasting with cocktails in a tropical-themed setting.">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/top-miami-events-in-may-2025.html">
                Top Miami Events in May 2025
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                May 1, 2025
            </div>
            </div>
</article>
                </div>
                            <div class="wow fadeInUp" data-wow-delay="50ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_320_213.jpg') }} 320w, https:/{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_375_250.jpg') }} 375w, https:/{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_400_267.jpg') }} 400w, https:/{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_414_276.jpg') }} 414w, https:/{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_640_427.jpg') }} 640w, https:/{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_750_500.jpg') }} 750w, https:/{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_800_534.jpg') }} 800w, https:/{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_828_552.jpg') }} 828w, https:/{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_1024_683.jpg') }} 1024w, https:/{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_1200_800.jpg') }} 1200w, https:/{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_1280_854.jpg') }} 1280w, https:/{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_1440_960.jpg') }} 1440w, https:/{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_1600_1067.jpg') }} 1600w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMTYwMCAxMDY3Ij4KCTxpbWFnZSB3aWR0aD0iMTYwMCIgaGVpZ2h0PSIxMDY3IiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEE5QTFQVmY3SnQxZU1iaWEyTkQxMUx1eTg2Vmd1QnpYR3p1bDZtMW15S3JTTzFwWnZBcmxRM2VzWXhueXBvMmxLTjJqMHlEWGJPNGw4cU9RRTFCZitYTG5EQTE1YnAxODFtUzZ1U3c3MXJhZjRyaExPazc0WW51YUtrWHlwdGlwdjN0REF0cnFSWk1acldpWVhTWWtVR2lpdHFiME1wclVxNmxiUlcxbTd4cmc0cmdaN2lRekU1eHoyb29yS3A4UnRUZnVYUC8vWiI+Cgk8L2ltYWdlPgo8L3N2Zz4= 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/531a9942bce12455b447e429d0137442/featured.jpg') }}" width="320" height="213" alt="A man with closed eyes sitting on a bench, relaxing with his friends during a vacation.">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/why-now-is-the-time-to-detox-from-stress.html">
                Why Now Is the Time to Detox from Stress (And Maybe Your Stocks)
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                March 26, 2025
            </div>
            </div>
</article>
                </div>
                            <div class="wow fadeInUp" data-wow-delay="100ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_2100_1400.jpg') }} 2100w, https:/{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_1756_1171.jpg') }} 1756w, https:/{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_1470_980.jpg') }} 1470w, https:/{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_1229_819.jpg') }} 1229w, https:/{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_1029_686.jpg') }} 1029w, https:/{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_860_573.jpg') }} 860w, https:/{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_720_480.jpg') }} 720w, https:/{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_602_401.jpg') }} 602w, https:/{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_504_336.jpg') }} 504w, https:/{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_421_281.jpg') }} 421w, https:/{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_352_235.jpg') }} 352w, https:/{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_295_197.jpg') }} 295w, https:/{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_247_165.jpg') }} 247w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMjEwMCAxNDAwIj4KCTxpbWFnZSB3aWR0aD0iMjEwMCIgaGVpZ2h0PSIxNDAwIiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEF0YTlvMS9lVGlVUk1WUGJGWkIwSzZSZHZrc0Q5SzlPUGl1MjNlVzBLN3ZTay90MnhFbSs0aFZWOWNWelNvUm0rYm1OWTE1UWp5Mk9LOFA2TmV3WEc5a0lYM3FmWGRQdjVaaDVLbmJYY3c2OXBjeWt4QlNQYW9wOVZzTnVTbGR0T0ZQMlhzbTlEZ3FWYXZ0dmFwYW5rMDg4djJvUytZZDJhbTFqVkoyMDBLVDI2MFVWNWtVZXV5bDRmMWE0aGlZWjNmV3VudGRWa2xHMTQxSW9vcXJhR2N0ei8yUT09Ij4KCTwvaW1hZ2U+Cjwvc3ZnPg== 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/67f697fec3f9f94af593446a9d94246f/featured.jpg') }}" width="2100" height="1400" alt="Wooden deck chairs under rough straw sun umbrella on sea beach and big white yacht ship in water near Miami.">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/go-bespoke-or-go-home.html">
                Go Bespoke or Go Home
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                August 1, 2024
            </div>
            </div>
</article>
                </div>
                            <div class="wow fadeInUp" data-wow-delay="150ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy"  srcset="https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_320_213.jpg') }} 320w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_375_250.jpg') }} 375w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_414_276.jpg') }} 414w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_525_350.jpg') }} 525w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_640_427.jpg') }} 640w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_750_500.jpg') }} 750w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_828_552.jpg') }} 828w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_1024_683.jpg') }} 1024w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_1050_700.jpg') }} 1050w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_1280_853.jpg') }} 1280w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_1440_960.jpg') }} 1440w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_1575_1050.jpg') }} 1575w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_1920_1280.jpg') }} 1920w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_2048_1365.jpg') }} 2048w, https:/{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_2100_1400.jpg') }} 2100w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMjEwMCAxNDAwIj4KCTxpbWFnZSB3aWR0aD0iMjEwMCIgaGVpZ2h0PSIxNDAwIiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEF3NHhUbVlJUG1OUW01aWlYTzRVeUp4ZlM3RjlhOW1WV01kTG53Y2FVcE85dEM1dWlsaHdvNXFLS1dXMGZkR2NWMGxqNGNWclBleHdjVlJsMEM2OHc3UVN2WTF6ckZVWlhUWjZYOW40cFdsRmFIQk51ODhKdU9LM3RGVVFYU0VjL1dpaXZEeERhcTJQZXdrSXVLdWoxUFNZRnVWVGVUZzlxNldHeWdRQmRneFJSU21rbGM5TS8vOWs9Ij4KCTwvaW1hZ2U+Cjwvc3ZnPg== 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxteria.co/e08401cf19d408bce0ad279a0cf887e9/featured.jpg') }}" width="320" height="213" alt="Woman swimming underwater in a luxury villa in Miami, a hat, sunglasses and plan are on the edge of the pool.">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/3-luxury-travel-perks-you-didn-t-know-you-needed.html">
                3 Luxury Travel Perks You Didn’t Know You Needed
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                September 1, 2024
            </div>
            </div>
</article>
                </div>
                    </div>
    
            <div class="mt-8">
            <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-400 bg-black border border-zinc-50/30 cursor-default leading-5 rounded-md">
                    &laquo; Previous
                </span>
            
                            <a href="index4658.html?page=2" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-zinc-50 bg-black border border-zinc-50/30 leading-5 rounded-md hover:bg-zinc-800 focus:outline-none focus:ring ring-amber-300 focus:border-amber-300 active:bg-zinc-700 active:text-zinc-100 transition ease-in-out duration-150">
                    Next &raquo;
                </a>
                    </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-zinc-300 leading-5">
                    Showing
                                            <span class="font-medium">1</span>
                        to
                        <span class="font-medium">4</span>
                                        of
                    <span class="font-medium">24</span>
                    results
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                    
                                            <span aria-disabled="true" aria-label="&amp;laquo; Previous">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-zinc-400 bg-black border border-zinc-50/30 cursor-default rounded-l-md leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    
                    
                                            
                        
                        
                                                                                                                        <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-black bg-amber-200 border border-amber-300 cursor-default leading-5">1</span>
                                    </span>
                                                                                                                                <a href="index4658.html?page=2" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-zinc-50 bg-black border border-zinc-50/30 leading-5 hover:bg-zinc-800 focus:z-10 focus:outline-none focus:ring ring-amber-300 focus:border-amber-300 active:bg-zinc-700 active:text-zinc-100 transition ease-in-out duration-150" aria-label="Go to page 2">
                                        2
                                    </a>
                                                                                                                                <a href="index9ba9.html?page=3" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-zinc-50 bg-black border border-zinc-50/30 leading-5 hover:bg-zinc-800 focus:z-10 focus:outline-none focus:ring ring-amber-300 focus:border-amber-300 active:bg-zinc-700 active:text-zinc-100 transition ease-in-out duration-150" aria-label="Go to page 3">
                                        3
                                    </a>
                                                                                                                                <a href="indexfdb0.html?page=4" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-zinc-50 bg-black border border-zinc-50/30 leading-5 hover:bg-zinc-800 focus:z-10 focus:outline-none focus:ring ring-amber-300 focus:border-amber-300 active:bg-zinc-700 active:text-zinc-100 transition ease-in-out duration-150" aria-label="Go to page 4">
                                        4
                                    </a>
                                                                                                                                <a href="indexaf4d.html?page=5" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-zinc-50 bg-black border border-zinc-50/30 leading-5 hover:bg-zinc-800 focus:z-10 focus:outline-none focus:ring ring-amber-300 focus:border-amber-300 active:bg-zinc-700 active:text-zinc-100 transition ease-in-out duration-150" aria-label="Go to page 5">
                                        5
                                    </a>
                                                                                                                                <a href="indexc575.html?page=6" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-zinc-50 bg-black border border-zinc-50/30 leading-5 hover:bg-zinc-800 focus:z-10 focus:outline-none focus:ring ring-amber-300 focus:border-amber-300 active:bg-zinc-700 active:text-zinc-100 transition ease-in-out duration-150" aria-label="Go to page 6">
                                        6
                                    </a>
                                                                                                        
                    
                                            <a href="index4658.html?page=2" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-zinc-50 bg-black border border-zinc-50/30 rounded-r-md leading-5 hover:bg-zinc-800 focus:z-10 focus:outline-none focus:ring ring-amber-300 focus:border-amber-300 active:bg-zinc-700 active:text-zinc-100 transition ease-in-out duration-150" aria-label="Next &amp;raquo;">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                                    </span>
            </div>
        </div>
    </nav>

        </div>
</div>
@endsection




