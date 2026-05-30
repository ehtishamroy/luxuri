@extends('layouts.app')

@section('content')

{{-- Hero Section with Video --}}
<div class="bg-black text-white relative z-10">
    <div class="relative isolate pt-14 min-h-[90vh] md:min-h-[70vh] flex items-center">

        {{-- Video Background --}}
        <div x-data="videoAutoplay()" x-init="init()" x-intersect:enter="startLazyLoad()" x-intersect:leave="pauseVideos()" class="absolute inset-0 -z-10 size-full overflow-hidden">
            <div class="relative size-full">
                <img x-show="!isReady && videos[0].poster" :src="videos[0].poster" alt="Hero video preview" class="absolute inset-0 size-full object-cover" loading="eager" style="display: none;">
                <video x-ref="mainVideo" x-show="isReady" class="size-full object-cover" muted playsinline preload="auto" :poster="videos[currentVideo].poster || ''" @loadeddata="onVideoLoaded" @ended="nextVideo" x-on:error="handleVideoError">
                    <source :src="videos[currentVideo].src" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('videoAutoplay', () => ({
                        videos: [
                            { src: 'https://media.luxteria.co/video/luxury-new-video.mp4', poster: 'https://media.luxteria.co/video/luxury-new-video-preview.jpg' },
                            { src: 'https://media.luxteria.co/video/Fort_lauderdale_video.mp4', poster: null },
                            { src: 'https://media.luxteria.co/video/miami-video.mp4', poster: null },
                        ],
                        currentVideo: 0,
                        isReady: false,
                        isInViewport: false,

                        init() {
                            if (this.videos[0].poster) {
                                const firstPoster = new Image();
                                firstPoster.src = this.videos[0].poster;
                            }
                            this.respectsReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
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
                            const playOnce = () => { this.$refs.mainVideo.play(); };
                            document.addEventListener('click', playOnce, { once: true });
                            document.addEventListener('touchstart', playOnce, { once: true });
                        },

                        nextVideo() {
                            if (this.respectsReducedMotion) return;
                            this.currentVideo = (this.currentVideo + 1) % this.videos.length;
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
                            setTimeout(() => this.nextVideo(), 100);
                        }
                    }));
                });
            </script>
        </div>

        <div class="absolute inset-0 -z-10 size-full object-cover bg-black/20 bg-blend-multiply"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>
        <div class="mx-auto max-w-7xl px-4 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0">
            <div class="mx-auto py-18 max-w-5xl my-12">
                <div class="space-y-6">
                    <div class="space-y-4 text-shadow-lg/10">
                        <h1 class="text-3xl font-semibold tracking-wide text-center text-balance uppercase font-accent sm:text-5xl">
                            Discover Your Luxury Villa Rental
                        </h1>
                        <p class="text-lg font-normal text-pretty text-center">
                            Choose from luxteria's handpicked collection of high-end villas.
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
                                                        <input type="text" @click="showDestinations = true; showDatepicker = false" x-model="locationName" x-ref="searchInput" placeholder="Destination" class="text-zinc-300 py-1 truncate text-sm max-sm:text-xs focus:outline-none border-1 border-transparent max-w-full w-full block focus-within:border-b-zinc-50">
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
                                                        <div class="grow">Destination</div>
                                                        <div class="text-zinc-300 text-xs" x-text="outputDateFromValue ? new Date(dateFromYmd).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) : ''"></div>
                                                        -
                                                        <div class="text-zinc-300 text-xs" x-text="outputDateToValue ? new Date(dateToYmd).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) : ''"></div>
                                                    </div>
                                                    <div class="text-zinc-300 py-1 text-sm w-full" x-text="locationName || 'Destinations...'">Destinations...</div>
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
                                                            <input type="text" @click="showDestinations = true; showDatepicker = false" x-model="locationName" x-ref="searchInput" placeholder="Destination" class="text-zinc-300 py-1 truncate text-base focus:outline-none border-1 border-transparent max-w-full w-full block focus-within:border-b-zinc-50">
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
                                            <div class="font-medium mb-3 text-zinc-50">Destinations</div>
                                            <ul class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                                <li>
                                                    <article class="relative text-sm group rounded-xl">
                                                        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-7/5 max-md:hidden">
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="eager" src="https://media.luxteria.co/83926f30daa706ee9a210a080639d387/Aspen.png" alt="Aspen">
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
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="eager" src="https://media.luxteria.co/miami-hero.jpg" alt="Miami">
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
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="eager" src="https://media.luxteria.co/bali-hero.jpg" alt="Bali">
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
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="eager" src="https://media.luxteria.co/fort-lauderdale-hero.jpg" alt="Fort Lauderdale">
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
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="eager" src="https://media.luxteria.co/los-angeles-hero.jpg" alt="Los Angeles">
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
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="eager" src="https://media.luxteria.co/cape-town-hero.jpg" alt="Cape Town">
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
                                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="eager" src="https://media.luxteria.co/costa-rica-hero.jpg" alt="Costa Rica">
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
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Featured Villas --}}
<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="flex justify-between">
        <h2 class="text-3xl uppercase font-normal">Featured Villas</h2>
        <div class="py-2 flex gap-2"></div>
    </div>
    <ul class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <li class="wow fadeInUp" data-wow-delay="0ms">
            <article class="relative text-sm group">
                <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7">
                    <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="https://media.luxteria.co/83926f30daa706ee9a210a080639d387/Aspen.png" alt="The Aspen Mountain Chalet">
                </div>
                <div class="flex gap-2">
                    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                        <a href="{{ url('/villas/aspen-mountain-chalet') }}">The Aspen Mountain Chalet<div class="absolute inset-0"></div></a>
                    </h3>
                </div>
                <div class="text-zinc-200 flex justify-between gap-2">
                    <div class="italic mb-2">Aspen, Aspen, Colorado</div>
                    <div class="flex flex-wrap gap-1.5 mb-2">
                        <div><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 5</div>
                        · <div><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 10</div>
                        · <div><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>5</div>
                    </div>
                </div>
                <div class="flex gap-2 justify-between items-center">
                    <div class="relative">
                        <div class="text-sm"><span class="font-semibold">$2,500</span><span class="text-zinc-400">/night</span></div>
                    </div>
                </div>
            </article>
        </li>
        <li class="wow fadeInUp" data-wow-delay="50ms">
            <article class="relative text-sm group">
                <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7">
                    <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="https://media.luxteria.co/617d3f29e822af451277e032f6c82d44/property-279-hostaway-335765205-order-1.jpg" alt="Casa Blanca Miami">
                </div>
                <div class="flex gap-2">
                    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                        <a href="{{ url('/villas/casa-blanca-miami') }}">Casa Blanca Miami<div class="absolute inset-0"></div></a>
                    </h3>
                </div>
                <div class="text-zinc-200 flex justify-between gap-2">
                    <div class="italic mb-2">Miami, Miami, Florida</div>
                    <div class="flex flex-wrap gap-1.5 mb-2">
                        <div><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 4</div>
                        · <div><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 10</div>
                        · <div><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>3</div>
                    </div>
                </div>
                <div class="flex gap-2 justify-between items-center">
                    <div class="relative">
                        <div class="text-sm"><span class="font-semibold">$1,200</span><span class="text-zinc-400">/night</span></div>
                    </div>
                </div>
            </article>
        </li>
        <li class="wow fadeInUp" data-wow-delay="100ms">
            <article class="relative text-sm group">
                <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7">
                    <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="https://media.luxteria.co/bali-hero.jpg" alt="Villa Seminyak Serenity">
                </div>
                <div class="flex gap-2">
                    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                        <a href="{{ url('/villas/villa-seminyak-serenity') }}">Villa Seminyak Serenity<div class="absolute inset-0"></div></a>
                    </h3>
                </div>
                <div class="text-zinc-200 flex justify-between gap-2">
                    <div class="italic mb-2">Bali, Seminyak, Bali</div>
                    <div class="flex flex-wrap gap-1.5 mb-2">
                        <div><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 4</div>
                        · <div><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 8</div>
                        · <div><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>4</div>
                    </div>
                </div>
                <div class="flex gap-2 justify-between items-center">
                    <div class="relative">
                        <div class="text-sm"><span class="font-semibold">$800</span><span class="text-zinc-400">/night</span></div>
                    </div>
                </div>
            </article>
        </li>
        <li class="wow fadeInUp" data-wow-delay="150ms">
            <article class="relative text-sm group">
                <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7">
                    <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="https://media.luxteria.co/fort-lauderdale-hero.jpg" alt="Las Olas Waterfront Estate">
                </div>
                <div class="flex gap-2">
                    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                        <a href="{{ url('/villas/las-olas-waterfront-estate') }}">Las Olas Waterfront Estate<div class="absolute inset-0"></div></a>
                    </h3>
                </div>
                <div class="text-zinc-200 flex justify-between gap-2">
                    <div class="italic mb-2">Fort Lauderdale, Fort Lauderdale, Florida</div>
                    <div class="flex flex-wrap gap-1.5 mb-2">
                        <div><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 6</div>
                        · <div><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 12</div>
                        · <div><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>6</div>
                    </div>
                </div>
                <div class="flex gap-2 justify-between items-center">
                    <div class="relative">
                        <div class="text-sm"><span class="font-semibold">$3,500</span><span class="text-zinc-400">/night</span></div>
                    </div>
                </div>
            </article>
        </li>
    </ul>
</div>

@endsection
