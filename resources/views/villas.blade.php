@extends('layouts.app')

@section('content')

{{-- Hero Section with Video --}}
<div class="bg-black text-white relative z-10">
    <div class="relative isolate pt-14 min-h-[90vh] md:min-h-[70vh] flex items-center">

        {{-- Video Background --}}
        <div x-data="videoAutoplay()" x-init="init()" x-intersect:enter="startLazyLoad()" x-intersect:leave="pauseVideos()" class="absolute inset-0 -z-10 size-full overflow-hidden">
            <div class="relative size-full">
                <img x-show="!isReady && videos[0].poster" :src="videos[0].poster" alt="Hero video preview" class="absolute inset-0 size-full object-cover" loading="eager" style="display: none;"
                    src="{{ isset($homepageMedia['hero_video_2']) && $homepageMedia['hero_video_2']->poster_path ? asset('storage/' . $homepageMedia['hero_video_2']->poster_path) : 'https://media.luxteria.co/video/luxury-new-video-preview.jpg' }}">
                <video x-ref="mainVideo" class="size-full object-cover transition-opacity duration-500" :class="isReady ? 'opacity-100' : 'opacity-0'" muted playsinline preload="auto" :poster="videos[currentVideo].poster || ''" @loadeddata="onVideoLoaded" @ended="nextVideo" x-on:error="handleVideoError"
                    poster="{{ isset($homepageMedia['hero_video_2']) && $homepageMedia['hero_video_2']->poster_path ? asset('storage/' . $homepageMedia['hero_video_2']->poster_path) : 'https://media.luxteria.co/video/luxury-new-video-preview.jpg' }}">
                    <source :src="videos[currentVideo].src" type="video/mp4"
                        src="{{ isset($homepageMedia['hero_video_2']) ? asset('storage/' . $homepageMedia['hero_video_2']->file_path) : 'https://media.luxteria.co/video/luxury-new-video.mp4' }}">
                    Your browser does not support the video tag.
                </video>
            </div>

            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('videoAutoplay', () => ({
                        videos: [
                            @if(isset($homepageMedia['hero_video_2']))
                            {
                                src: '{{ asset('storage/' . $homepageMedia['hero_video_2']->file_path) }}',
                                poster: '{{ $homepageMedia['hero_video_2']->poster_path ? asset('storage/' . $homepageMedia['hero_video_2']->poster_path) : '' }}'
                            },
                            @else
                            { src: 'https://media.luxteria.co/video/luxury-new-video.mp4', poster: 'https://media.luxteria.co/video/luxury-new-video-preview.jpg' },
                            { src: 'https://media.luxteria.co/video/Fort_lauderdale_video.mp4', poster: null },
                            { src: 'https://media.luxteria.co/video/miami-video.mp4', poster: null },
                            @endif
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
                    <div class="relative z-50 w-full max-w-2xl mx-auto">
                        @livewire('site.planner')
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- All Villas --}}
<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="flex justify-between">
        <h2 class="text-3xl uppercase font-normal">All Villas</h2>
        <div class="py-2 flex gap-2"></div>
    </div>
    <ul class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse($villas as $index => $villa)
        <li class="wow fadeInUp" data-wow-delay="{{ ($index % 4) * 50 }}ms">
            <article class="relative text-sm group flex flex-col h-full">
                <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7">
                    <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 " loading="lazy" src="{{ $villa->first_image ?? asset('assets/images/placeholder.jpg') }}" alt="{{ $villa->title }}">
                </div>
                <div class="flex gap-2">
                    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                        <a href="{{ route('villas.show', $villa->slug) }}">{{ $villa->title }}<div class="absolute inset-0"></div></a>
                    </h3>
                </div>
                <div class="text-zinc-200 flex justify-between gap-2">
                    <div class="italic">{{ $villa->location ?? ($villa->destination ? $villa->destination->name : '') }}</div>
                    <div class="flex flex-wrap gap-1.5">
                        @if($villa->bedrooms)<div><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> {{ $villa->bedrooms }}</div>@endif
                        @if($villa->max_guests)· <div><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> {{ $villa->max_guests }}</div>@endif
                        @if($villa->bathrooms)· <div><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>{{ $villa->bathrooms }}</div>@endif
                    </div>
                </div>
                <div class="flex gap-2 justify-between items-center mt-2">
                    <div class="relative text-sm">
                        @if($villa->price_per_night > 0)
                            <span class="font-semibold">${{ number_format($villa->price_per_night, 0) }}</span><span class="text-zinc-400">/night</span>
                        @else
                            <span class="font-semibold text-zinc-300">Price on request</span>
                        @endif
                    </div>
                </div>
            </article>
        </li>
        @empty
        <li class="col-span-full text-zinc-400">No villas available at the moment.</li>
        @endforelse
    </ul>
    
    @if($villas->hasPages())
    <div class="mt-8">
        {{ $villas->links() }}
    </div>
    @endif
</div>

@endsection
