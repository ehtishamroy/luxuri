@extends('layouts.app')
@section('content')
<div class="bg-black text-white relative z-10">
    <div class="relative isolate pt-14 min-h-[90vh] md:min-h-[70vh] flex items-center">
        
        
        
        <div x-data="videoAutoplay()" x-init="init()" x-intersect:enter="startLazyLoad()" x-intersect:leave="pauseVideos()" class="absolute inset-0 -z-10 size-full overflow-hidden">
    
    <div class="relative size-full">
        
        <img x-show="!isReady && videos[0].poster" :src="videos[0].poster" alt="Hero video preview" class="absolute inset-0 size-full object-cover" loading="eager" src="https://media.luxuri.com/video/luxury-new-video-preview.jpg" style="display: none;">

        
        <video x-ref="mainVideo" x-show="isReady" class="size-full object-cover" muted playsinline preload="auto" :poster="videos[currentVideo].poster || ''" @loadeddata="onVideoLoaded" @ended="nextVideo" x-on:error="handleVideoError" poster="https://media.luxuri.com/video/luxury-new-video-preview.jpg" style="">
            <source :src="videos[currentVideo].src" type="video/mp4" src="https://media.luxuri.com/video/luxury-new-video.mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('videoAutoplay', () => ({
                videos: [
                    {
                        src: 'https://media.luxuri.com/video/luxury-new-video.mp4',
                        poster: 'https://media.luxuri.com/video/luxury-new-video-preview.jpg',
                    },
                    {
                        src: 'https://media.luxuri.com/video/Fort_lauderdale_video.mp4',
                        poster: null,
                    },
                    {
                        src: 'https://media.luxuri.com/video/miami-video.mp4',
                        poster: null,
                    },
                ],
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
        Discover Your Luxury Villa Rental
    </h1>
    <p class="text-lg font-normal text-pretty text-center ">
        Choose from Luxuri’s handpicked collection of high-end villas.
    </p>
</div>


            @livewire('site.planner')
        </div>
    </div>
        </div>
    </div>
</div>
            <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="flex justify-between">
    <h2 class="text-3xl uppercase font-normal">Popular Destinations</h2>
    <div class="py-2 flex gap-2">
        <button id="section-11-carousel-prev" class="px-1" type="button"><i class="fa-sharp fa-light fa-arrow-left fa-xl"></i>
</button>
<button id="section-11-carousel-next" class="px-1" type="button"><i class="fa-sharp fa-light fa-arrow-right fa-xl"></i>
</button>
    </div>
</div>
            
            <div id="section-11" class="swiper swiper-initialized swiper-horizontal swiper-watch-progress swiper-backface-hidden">
    <div class="swiper-wrapper">
        <div class="swiper-slide wow fadeInUp swiper-slide-visible swiper-slide-fully-visible swiper-slide-active" data-wow-delay="0ms" data-swiper-slide-index="0" style="width: 224px; visibility: visible; animation-delay: 0ms; animation-name: fadeInUp; margin-right: 24px;">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore="">
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_3442_1926.png 3442w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_2879_1611.png 2879w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_2409_1348.png 2409w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_2015_1128.png 2015w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_1686_943.png 1686w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_1411_790.png 1411w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_1180_660.png 1180w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_987_552.png 987w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_826_462.png 826w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_691_387.png 691w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_578_323.png 578w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_484_271.png 484w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_404_226.png 404w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_338_189.png 338w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_283_158.png 283w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_237_133.png 237w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_198_111.png 198w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_166_93.png 166w, https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/responsive-images/Miami___media_library_original_138_77.png 138w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMzQ0MiAxOTI2Ij4KCTxpbWFnZSB3aWR0aD0iMzQ0MiIgaGVpZ2h0PSIxOTI2IiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FFZ0FnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEEzLzdRc1pINmlyaHZJMWd5b3l0Y1ZIdEdNVjJtazJ5dllEY001RmIxSzFrY0dHanpzeHIyN2dkdVJpbTI2UVRkSEg1MXV6YVRaM0FJa0FCckZ1L0NybHQxcE9RUFROSllxYVJ0TEN3YnVjOUY5NGZXdlFkRi93Q1BKZnBSUldGUVdDMllYZlJxTk9KUGVpaWhiSFc5ei8vWiI+Cgk8L2ltYWdlPgo8L3N2Zz4= 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="12vw" src="https://media.luxuri.com/b98bd7c3ed631d5533a310723913d412/Miami.png" width="3442" height="1926" alt="Miami.png">

    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="https://luxuri.com/destinations/miami ">
                Miami
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
</article>
</div>
                            <div class="swiper-slide wow fadeInUp swiper-slide-visible swiper-slide-fully-visible swiper-slide-next" data-wow-delay="50ms" data-swiper-slide-index="1" style="width: 224px; visibility: visible; animation-delay: 50ms; animation-name: fadeInUp; margin-right: 24px;">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore="">
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="https://media.luxuri.com/22696e565bd848d8cf54bb0230c92d6d/ft.jpg" alt="ft.jpg">
    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="https://luxuri.com/destinations/fort-lauderdale ">
                Fort Lauderdale
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
</article>
</div>
                            <div class="swiper-slide wow fadeInUp swiper-slide-visible swiper-slide-fully-visible" data-wow-delay="100ms" data-swiper-slide-index="2" style="width: 224px; visibility: visible; animation-delay: 100ms; animation-name: fadeInUp; margin-right: 24px;">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore="">
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="https://media.luxuri.com/83926f30daa706ee9a210a080639d387/Aspen.png" alt="Aspen.png">
    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="https://luxuri.com/destinations/aspen ">
                Aspen
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
</article>
</div>
                            <div class="swiper-slide wow fadeInUp swiper-slide-visible swiper-slide-fully-visible" data-wow-delay="150ms" data-swiper-slide-index="3" style="width: 224px; visibility: visible; animation-delay: 150ms; animation-name: fadeInUp; margin-right: 24px;">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore="">
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="https://media.luxuri.com/47d7a9bd4fe2081026fcfde3895ba1c1/LA.png" alt="LA.png">
    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="https://luxuri.com/destinations/los-angeles ">
                Los Angeles
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
</article>
</div>
                            <div class="swiper-slide wow fadeInUp swiper-slide-visible swiper-slide-fully-visible" data-wow-delay="200ms" data-swiper-slide-index="4" style="width: 224px; visibility: visible; animation-delay: 200ms; animation-name: fadeInUp; margin-right: 24px;">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore="">
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="https://media.luxuri.com/8c4cb49a35c6bd10339fe5cccf553c09/Capetown.png" alt="Capetown.png">
    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="https://luxuri.com/destinations/cape-town ">
                Cape Town
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
</article>
</div>
                            <div class="swiper-slide wow fadeInUp" data-wow-delay="250ms" data-swiper-slide-index="5" style="width: 224px; visibility: visible; animation-delay: 250ms; animation-name: fadeInUp; margin-right: 24px;">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore="">
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_5464_3640.jpeg 5464w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_4571_3045.jpeg 4571w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_3824_2547.jpeg 3824w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_3200_2132.jpeg 3200w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_2677_1783.jpeg 2677w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_2240_1492.jpeg 2240w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_1874_1248.jpeg 1874w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_1568_1045.jpeg 1568w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_1311_873.jpeg 1311w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_1097_731.jpeg 1097w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_918_612.jpeg 918w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_768_512.jpeg 768w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_642_428.jpeg 642w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_537_358.jpeg 537w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_449_299.jpeg 449w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_376_250.jpeg 376w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_314_209.jpeg 314w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgNTQ2NCAzNjQwIj4KCTxpbWFnZSB3aWR0aD0iNTQ2NCIgaGVpZ2h0PSIzNjQwIiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEE0TzJnQllLU0swREFZV1VJM1h0WE9mYUdFZzhza24ycld0WHVaU0NGSmFoMDVwa09yVHNkQklpMnR1ck9jbHFvdklzcDZnQ3FVcjNFakZicHlvSFNzUzd2MmhrS28rUld0T0hjeG5VN0lvYVpkUEZNRGdOOWEyeHJGeERPQ2dVVVVWcXRqTnJVb2FscXR4Y1NmTWZ5ckhrZG01Sm9vcVJvLzlrPSI+Cgk8L2ltYWdlPgo8L3N2Zz4= 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="12vw" src="https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc.jpeg" width="5464" height="3640" alt="beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc.jpeg">

    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="https://luxuri.com/destinations/bali ">
                Bali
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>
</article>
</div>
                            <div class="swiper-slide wow fadeInUp" data-wow-delay="300ms" data-swiper-slide-index="6" style="width: 224px; visibility: visible; animation-delay: 300ms; animation-name: fadeInUp; margin-right: 24px;">
    <article class="relative text-sm group">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore="">
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="https://media.luxuri.com/042945ba4d80ea1e9d6c20e8db6ec3d4/Costa-Rica.png" alt="Costa Rica.png">
    </div>

    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="text-base" href="https://luxuri.com/destinations/costa-rica ">
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
    <div class="py-2 flex gap-2"></div>
</div>
            <ul class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    <li wire:key="property-279" class="wow fadeInUp" data-wow-delay="0ms">
        <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_640_427.jpg 640w, https://media.luxuri.com/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_1024_684.jpg 1024w, https://media.luxuri.com/9f85a6c93db24466772b5cb0498610be/responsive-images/property-279-hostaway-335765230-order-26___media_library_original_1280_855.jpg 1280w" alt="Casa Blanca">
        </div>
        <div class="flex gap-2"><h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow"><a class="" href="properties/florida/miami/casa-blanca.html">Casa Blanca<div class="absolute inset-0"></div></a></h3></div>
        <div class="text-zinc-200 flex justify-between gap-2"><div class="italic mb-2">Miami, Florida</div><div class="flex flex-wrap gap-1.5 mb-2"><div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 4 </div>·<div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 10</div>·<div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>3</div></div></div>
        <div class="flex gap-2 justify-between items-center"><div class="relative"><div class="text-sm"><span class="font-semibold">$425</span><span class="text-zinc-400">/night</span></div></div></div>
        </article>
    </li>
    <li wire:key="property-274" class="wow fadeInUp" data-wow-delay="50ms">
        <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_640_429.png 640w, https://media.luxuri.com/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_1024_687.png 1024w, https://media.luxuri.com/82b7ba6ed315edbb4ca8590b1abc5f0e/responsive-images/hf_20260509_120338_0b7ae1be-27f1-48b8-aca0-32e1cec74f1d___media_library_original_1280_859.png 1280w" alt="Villa Lexi">
        </div>
        <div class="flex gap-2"><h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow"><a class="" href="properties/fl/miami/villa-lexi.html">Villa Lexi<div class="absolute inset-0"></div></a></h3></div>
        <div class="text-zinc-200 flex justify-between gap-2"><div class="italic mb-2">Miami, Florida</div><div class="flex flex-wrap gap-1.5 mb-2"><div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 6 </div>·<div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 14</div>·<div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>5</div></div></div>
        <div class="flex gap-2 justify-between items-center"><div class="relative"><div class="text-sm"><span class="font-semibold">$1,111</span><span class="text-zinc-400">/night</span></div></div></div>
        </article>
    </li>
    <li wire:key="property-271" class="wow fadeInUp" data-wow-delay="100ms">
        <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_640_424.jpg 640w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1024_678.jpg 1024w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1280_848.jpg 1280w" alt="Villa Barcelona">
        </div>
        <div class="flex gap-2"><h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow"><a class="" href="properties/villa-barcelona.html">Villa Barcelona<div class="absolute inset-0"></div></a></h3></div>
        <div class="text-zinc-200 flex justify-between gap-2"><div class="italic mb-2">, Florida</div><div class="flex flex-wrap gap-1.5 mb-2"><div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 6 </div>·<div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 12</div>·<div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>8</div></div></div>
        <div class="flex gap-2 justify-between items-center"><div class="relative"><div class="text-sm"><span class="font-semibold">$7,500</span><span class="text-zinc-400">/night</span></div></div></div>
        </article>
    </li>
    <li wire:key="property-270" class="wow fadeInUp" data-wow-delay="150ms">
        <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/d818c7f3b6fd78e4adf8191cccd9761d/responsive-images/property-270-hostaway-335389803-order-1___media_library_original_640_477.jpg 640w, https://media.luxuri.com/d818c7f3b6fd78e4adf8191cccd9761d/responsive-images/property-270-hostaway-335389803-order-1___media_library_original_1024_764.jpg 1024w, https://media.luxuri.com/d818c7f3b6fd78e4adf8191cccd9761d/responsive-images/property-270-hostaway-335389803-order-1___media_library_original_1280_955.jpg 1280w" alt="Villa Contempa">
        </div>
        <div class="flex gap-2"><h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow"><a class="" href="properties/florida/fort-lauderdale/villa-contempa.html">Villa Contempa<div class="absolute inset-0"></div></a></h3></div>
        <div class="text-zinc-200 flex justify-between gap-2"><div class="italic mb-2">Fort Lauderdale, Florida</div><div class="flex flex-wrap gap-1.5 mb-2"><div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 7 </div>·<div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 18</div>·<div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>6</div></div></div>
        <div class="flex gap-2 justify-between items-center"><div class="relative"><div class="text-sm"><span class="font-semibold">$2,750</span><span class="text-zinc-400">/night</span></div></div></div>
        </article>
    </li>
    <li wire:key="property-267" class="wow fadeInUp" data-wow-delay="200ms">
        <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_640_427.jpg 640w, https://media.luxuri.com/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_1024_684.jpg 1024w, https://media.luxuri.com/96bd15233bb4ee9008469b6df3b852dc/responsive-images/property-267-hostaway-335113589-order-1___media_library_original_1280_855.jpg 1280w" alt="Sanctuary Manor">
        </div>
        <div class="flex gap-2"><h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow"><a class="" href="properties/sanctuary-manor.html">Sanctuary Manor<div class="absolute inset-0"></div></a></h3></div>
        <div class="text-zinc-200 flex justify-between gap-2"><div class="italic mb-2">, Florida</div><div class="flex flex-wrap gap-1.5 mb-2"><div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 6 </div>·<div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 12</div>·<div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>6</div></div></div>
        <div class="flex gap-2 justify-between items-center"><div class="relative"><div class="text-sm"><span class="font-semibold">$3,000</span><span class="text-zinc-400">/night</span></div></div></div>
        </article>
    </li>
    <li wire:key="property-265" class="wow fadeInUp" data-wow-delay="250ms">
        <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_640_427.jpeg 640w, https://media.luxuri.com/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_1024_683.jpeg 1024w, https://media.luxuri.com/2927e02c07686531b53b5a587cbea3ab/responsive-images/property-265-hostaway-333664708-order-140___media_library_original_1280_853.jpeg 1280w" alt="La Maison">
        </div>
        <div class="flex gap-2"><h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow"><a class="" href="properties/fl/palmetto-bay/miami-escape-9-bed-villa-wsports-court.html">La Maison<div class="absolute inset-0"></div></a></h3></div>
        <div class="text-zinc-200 flex justify-between gap-2"><div class="italic mb-2">Palmetto Bay, Florida</div><div class="flex flex-wrap gap-1.5 mb-2"><div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 8 </div>·<div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 16</div>·<div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>9</div></div></div>
        <div class="flex gap-2 justify-between items-center"><div class="relative"><div class="text-sm"><span class="font-semibold">$3,200</span><span class="text-zinc-400">/night</span></div></div></div>
        </article>
    </li>
    <li wire:key="property-264" class="wow fadeInUp" data-wow-delay="300ms">
        <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_640_427.jpg 640w, https://media.luxuri.com/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_1024_683.jpg 1024w, https://media.luxuri.com/ece078f6b4a76ba57da525e2f1d8141e/responsive-images/property-264-hostaway-333507462-order-1___media_library_original_1280_853.jpg 1280w" alt="Villa Larsa">
        </div>
        <div class="flex gap-2"><h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow"><a class="" href="properties/florida/hallandale-beach/villa-larsa.html">Villa Larsa<div class="absolute inset-0"></div></a></h3></div>
        <div class="text-zinc-200 flex justify-between gap-2"><div class="italic mb-2">Hallandale Beach, Florida</div><div class="flex flex-wrap gap-1.5 mb-2"><div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 5 </div>·<div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 12</div>·<div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>3</div></div></div>
        <div class="flex gap-2 justify-between items-center"><div class="relative"><div class="text-sm"><span class="font-semibold">$1,300</span><span class="text-zinc-400">/night</span></div></div></div>
        </article>
    </li>
    <li wire:key="property-263" class="wow fadeInUp" data-wow-delay="350ms">
        <article class="relative text-sm group">
        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_640_360.jpg 640w, https://media.luxuri.com/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_1024_576.jpg 1024w, https://media.luxuri.com/e4e4a614e00fce5739c7047c8a0834cb/responsive-images/01___media_library_original_1280_720.jpg 1280w" alt="Casa Lumina">
        </div>
        <div class="flex gap-2"><h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow"><a class="" href="properties/casa-lumina.html">Casa Lumina<div class="absolute inset-0"></div></a></h3></div>
        <div class="text-zinc-200 flex justify-between gap-2"><div class="italic mb-2">Fort Lauderdale, Florida</div><div class="flex flex-wrap gap-1.5 mb-2"><div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 4 </div>·<div class=""><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 10</div>·<div class=""><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>5</div></div></div>
        <div class="flex gap-2 justify-between items-center"><div class="relative"><div class="text-sm"><span class="font-semibold">$3,000</span><span class="text-zinc-400">/night</span></div></div></div>
        </article>
    </li>
</ul>
</div>

<style>
    @keyframes marquee { 0% { transform: translateX(0%); } 100% { transform: translateX(-50%); } }
    .marquee-container { overflow: hidden; position: relative; }
    .marquee-track { display: flex; gap: 5rem; animation: marquee 30s linear infinite; }
    @media (max-width: 1024px) { .marquee-track { gap: 3.75rem; animation-duration: 25s; } }
    @media (max-width: 768px) { .marquee-track { gap: 3rem; animation-duration: 20s; } }
    @media (max-width: 640px) { .marquee-track { gap: 2.5rem; animation-duration: 15s; } }
</style>
<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6 !py-24">
    <h2 class="text-center uppercase text-white mb-10">Trusted By</h2>
    <div class="relative max-w-7xl mx-auto">
        <div class="marquee-container">
            <div class="marquee-track">
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/AIRBNB.png') }}" alt="Airbnb" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/VRBO.png') }}" alt="VRBO" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/One fine stay.png') }}" alt="One Fine Stay" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Plum guide.png') }}" alt="Plum Guide" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Luxe.png') }}" alt="Luxe" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Oliver travels.png') }}" alt="Oliver Travels" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Stay one.png') }}" alt="Stay One" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Quintess.png') }}" alt="Quintess" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/FAVR.png') }}" alt="FAVR" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/BBB.png') }}" alt="Better Business Bureau" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Visit lauderdale.png') }}" alt="Visit Lauderdale" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/VRMA.png') }}" alt="VRMA" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/American express.png') }}" alt="American Express" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Visa.png') }}" alt="Visa" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Mastercard.png') }}" alt="Mastercard" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Discover.png') }}" alt="Discover" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/AIRBNB.png') }}" alt="Airbnb" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/VRBO.png') }}" alt="VRBO" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/One fine stay.png') }}" alt="One Fine Stay" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Plum guide.png') }}" alt="Plum Guide" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Luxe.png') }}" alt="Luxe" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Oliver travels.png') }}" alt="Oliver Travels" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Stay one.png') }}" alt="Stay One" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Quintess.png') }}" alt="Quintess" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/FAVR.png') }}" alt="FAVR" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/BBB.png') }}" alt="Better Business Bureau" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Visit lauderdale.png') }}" alt="Visit Lauderdale" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/VRMA.png') }}" alt="VRMA" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/American express.png') }}" alt="American Express" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Visa.png') }}" alt="Visa" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Mastercard.png') }}" alt="Mastercard" loading="lazy" /></div>
                <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none" src="{{ asset('assets/media/partners/Discover.png') }}" alt="Discover" loading="lazy" /></div>
            </div>
        </div>
    </div>
</div>

<div class="bg-black text-white relative -mb-8">
    <div class="relative isolate pt-14 min-h-[70vh] flex items-center">
        <img class="absolute inset-0 -z-10 size-full object-cover" src="https://media.luxuri.com/b7cfd06c1d9d677f1e2943af6e51a36b/126.jpg" alt="Concierge">
        <div class="absolute top-0 left-0 pointer-events-none w-full h-26 -z-10 bg-gradient-to-b from-black from-0% via-black/15 via-70% to-black/0 to-95% bg-blend-overlay"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0"></div>
    </div>
</div>

<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="text-center space-y-3 max-w-2xl mx-auto">
        <div class="uppercase text-lg tracking-wider text-balance font-normal">vacation made easy</div>
        <h2 class="uppercase font-semibold">Fully Operated by Luxuri</h2>
        <p>Every villa in our collection is personally managed by our team, blending five-star hospitality with the privacy, space, and comfort of a true home.</p>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-16 my-16">
        <div class="space-y-3"><div><i class="fa-sharp fa-light fa-circle-check fa-xl"></i></div><h3>Handpicked and Luxuri-Approved</h3><div class="content-format"><p>Each residence is thoughtfully chosen and maintained to our exacting standards, ensuring every stay is as seamless as it is memorable.</p></div></div>
        <div class="space-y-3"><div><i class="fa-sharp fa-light fa-sparkle fa-xl"></i></div><h3>Flawless from the Moment You Arrive</h3><div class="content-format"><p>Our meticulous 302-point cleaning process ensures each villa is pristine upon arrival, no chores, no surprises, and no to-do lists at departure.</p></div></div>
        <div class="space-y-3"><div><i class="fa-sharp fa-light fa-spa fa-xl"></i></div><h3>Premium Amenities for Work and Play</h3><div class="content-format"><p>From high-speed connectivity and serene workspaces to heated pools and in-home spa experiences, every home is prepared for both productivity and pleasure.</p></div></div>
        <div class="space-y-3"><div><i class="fa-sharp fa-light fa-plane fa-xl"></i></div><h3>Inspiring Destinations</h3><div class="content-format"><p>Whether waking to oceanfront sunrises or unwinding at golden hour from a hillside terrace, every location is chosen to evoke connection, wonder, and peace.</p></div></div>
        <div class="space-y-3"><div><i class="fa-sharp fa-light fa-house fa-xl"></i></div><h3>Beauty Beyond the Photograph</h3><div class="content-format"><p>Our villas are not just picture-perfect, they are designed and curated to feel even more exquisite in person, with every detail considered for comfort and style.</p></div></div>
        <div class="space-y-3"><div><i class="fa-sharp fa-light fa-bell fa-xl"></i></div><h3>24/7 Personalized Concierge</h3><div class="content-format"><p>From private chefs and spa treatments to sunset cruises and last-minute reservations, our concierge team is always on hand to tailor every detail of your stay, day or night.</p></div></div>
    </div>
</div>

<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="flex justify-between">
        <h2 class="text-3xl uppercase font-normal">Recent Reviews</h2>
        <div class="py-2 flex gap-2">
            <button id="reviews-carousel-prev" class="px-1" type="button"><i class="fa-sharp fa-light fa-arrow-left fa-xl"></i></button>
            <button id="reviews-carousel-next" class="px-1" type="button"><i class="fa-sharp fa-light fa-arrow-right fa-xl"></i></button>
        </div>
    </div>
    <style>#reviews .swiper-slide { height: auto; }</style>
    <div id="reviews" class="swiper swiper-initialized swiper-horizontal swiper-watch-progress">
    <div class="swiper-wrapper">
        <div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible swiper-slide-active" data-swiper-slide-index="0" style="width: 286px; margin-right: 24px;">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                            <a href="https://luxuri.com/properties/fl/fort-lauderdale/boardwalk-mansion" class="text-base uppercase font-normal self-end tracking-wide">Boardwalk Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible swiper-slide-next" data-swiper-slide-index="1" style="width: 286px; margin-right: 24px;">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                            <a href="https://luxuri.com/properties/fl/fort-lauderdale/park-place-mansion" class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible" data-swiper-slide-index="2" style="width: 286px; margin-right: 24px;">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                            <a href="https://luxuri.com/properties/fl/fort-lauderdale/park-place-mansion" class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible" data-swiper-slide-index="3" style="width: 286px; margin-right: 24px;">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                            <a href="https://luxuri.com/properties/fl/fort-lauderdale/park-place-mansion" class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide" data-swiper-slide-index="4" style="width: 286px; margin-right: 24px;">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                            <a href="https://luxuri.com/properties/fl/fort-lauderdale/boardwalk-mansion" class="text-base uppercase font-normal self-end tracking-wide">Boardwalk Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide" data-swiper-slide-index="5" style="width: 286px; margin-right: 24px;">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                            <a href="https://luxuri.com/properties/fl/fort-lauderdale/las-palmas-royal-estate" class="text-base uppercase font-normal self-end tracking-wide">Las Palmas Royal Estate</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide" data-swiper-slide-index="6" style="width: 286px; margin-right: 24px;">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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
                    <span>Loved the property… bubbles didn't work in hot tub… pool was cold… recommend a booklet of checkin rules.. how to work appliances.. hot tub.. air conditioning etc.  asked and agreed to late. Ch...</span>
                </p>
            </blockquote>

                            <a href="https://luxuri.com/properties/fl/fort-lauderdale/park-place-mansion" class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide" data-swiper-slide-index="7" style="width: 286px; margin-right: 24px;">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                            <a href="https://luxuri.com/properties/fl/southwest-ranches/new-2-acre-modern-compound-modani-estates" class="text-base uppercase font-normal self-end tracking-wide">Modani Estates</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide" data-swiper-slide-index="8" style="width: 286px; margin-right: 24px;">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                            <a href="https://luxuri.com/properties/fl/fort-lauderdale/las-palmas-royal-estate" class="text-base uppercase font-normal self-end tracking-wide">Las Palmas Royal Estate</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide" data-swiper-slide-index="9" style="width: 286px; margin-right: 24px;">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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
                                    <div class="swiper-slide" data-swiper-slide-index="10" style="width: 286px; margin-right: 24px;">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                            <a href="https://luxuri.com/properties/fl/fort-lauderdale/park-place-mansion" class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
</div>
    </figure>
</article>
</div>
                                    <div class="swiper-slide" data-swiper-slide-index="11" style="width: 286px; margin-right: 24px;">
    <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
    <figure class="h-full">
        <div class="p-6 space-y-1 flex flex-col h-full">
    <figcaption class="space-y-6">
                <div class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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
                    <span>This place was great and Elly and Kathy were very responsive leading up to and during our stay. I'd recommend this place to anyone!</span>
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
            new window.Swiper('#reviews', {
                modules: [window.SwiperModules.Navigation, window.SwiperModules.Keyboard, window.SwiperModules.HashNavigation],
                slidesPerView: 1,
                breakpoints: { 480: { slidesPerView: 1.2, spaceBetween: 16 }, 640: { slidesPerView: 2, spaceBetween: 20 }, 768: { slidesPerView: 2, spaceBetween: 20 }, 1024: { slidesPerView: 3, spaceBetween: 24 }, 1280: { slidesPerView: 4, spaceBetween: 24 } },
                spaceBetween: 12, navigation: { prevEl: '#reviews-carousel-prev', nextEl: '#reviews-carousel-next' },
                loop: true, keyboard: { enabled: true }, lazy: { enabled: true }, hashNavigation: { enabled: true, watchState: true }, watchSlidesProgress: true, observer: true, observeParents: true,
            });
        });
    </script>
</div>

<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="max-w-4xl mx-auto space-y-6">
        <h2 class="uppercase font-semibold text-center">Frequently Asked Questions</h2>
        <dl class="space-y-3" x-data="{ openFaq: null }">
            <article class="relative text-sm group rounded-xl bg-zinc-800"><div class="p-6"><dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left" aria-controls="faq-0" :aria-expanded="openFaq === 0" @click="openFaq = openFaq === 0 ? null : 0"><h3 class="text-base font-semibold">What is the minimum age requirement to book a stay with Luxuri?</h3><span class="flex size-6 items-center"><i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200" :class="{ 'rotate-45': openFaq === 0 }"></i></span></button></dt><dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-0" x-show="openFaq === 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0"><p class="">Guests must be at least 21 years old to book a Luxuri villa.</p></dd></div></article>
            <article class="relative text-sm group rounded-xl bg-zinc-800"><div class="p-6"><dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left" aria-controls="faq-1" :aria-expanded="openFaq === 1" @click="openFaq = openFaq === 1 ? null : 1"><h3 class="text-base font-semibold">How can I reserve a Luxuri property?</h3><span class="flex size-6 items-center"><i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200" :class="{ 'rotate-45': openFaq === 1 }"></i></span></button></dt><dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-1" x-show="openFaq === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0"><p class="">You can reserve a property by submitting an inquiry or contacting our reservations team at 786-981-0924 or info@luxuri.com. Due to high demand, a 50% deposit is required to secure your booking.</p></dd></div></article>
            <article class="relative text-sm group rounded-xl bg-zinc-800"><div class="p-6"><dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left" aria-controls="faq-2" :aria-expanded="openFaq === 2" @click="openFaq = openFaq === 2 ? null : 2"><h3 class="text-base font-semibold">Can I host an event at a Luxuri property?</h3><span class="flex size-6 items-center"><i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200" :class="{ 'rotate-45': openFaq === 2 }"></i></span></button></dt><dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-2" x-show="openFaq === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0"><p class="">Event availability varies by property. Additional event fees may apply in addition to the nightly rate. Please contact us at 786-981-0924 for personalized assistance.</p></dd></div></article>
            <article class="relative text-sm group rounded-xl bg-zinc-800"><div class="p-6"><dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left" aria-controls="faq-3" :aria-expanded="openFaq === 3" @click="openFaq = openFaq === 3 ? null : 3"><h3 class="text-base font-semibold">What is Luxuri's cancellation policy?</h3><span class="flex size-6 items-center"><i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200" :class="{ 'rotate-45': openFaq === 3 }"></i></span></button></dt><dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-3" x-show="openFaq === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0"><p class="">Cancellations must be made at least 30 days prior to check-in for a partial refund, minus a 25% cancellation fee. Cancellations made 13 days or fewer before check-in are non-refundable, though the security deposit will be returned.</p></dd></div></article>
            <article class="relative text-sm group rounded-xl bg-zinc-800"><div class="p-6"><dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left" aria-controls="faq-4" :aria-expanded="openFaq === 4" @click="openFaq = openFaq === 4 ? null : 4"><h3 class="text-base font-semibold">Are pets allowed at Luxuri properties?</h3><span class="flex size-6 items-center"><i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200" :class="{ 'rotate-45': openFaq === 4 }"></i></span></button></dt><dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-4" x-show="openFaq === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0"><p class="">Some Luxuri homes are pet-friendly. Check the individual listing details or reach out to our team to confirm if a property can accommodate your pet.</p></dd></div></article>
            <article class="relative text-sm group rounded-xl bg-zinc-800"><div class="p-6"><dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left" aria-controls="faq-5" :aria-expanded="openFaq === 5" @click="openFaq = openFaq === 5 ? null : 5"><h3 class="text-base font-semibold">Does Luxuri offer personalized services during my stay?</h3><span class="flex size-6 items-center"><i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200" :class="{ 'rotate-45': openFaq === 5 }"></i></span></button></dt><dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-5" x-show="openFaq === 5" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0"><p class="">Absolutely. We provide a range of luxury concierge services, including private chefs, in-villa spa treatments, and custom itinerary planning to enhance your stay.</p></dd></div></article>
            <article class="relative text-sm group rounded-xl bg-zinc-800"><div class="p-6"><dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left" aria-controls="faq-6" :aria-expanded="openFaq === 6" @click="openFaq = openFaq === 6 ? null : 6"><h3 class="text-base font-semibold">Can I use Luxuri concierge services without booking a villa?</h3><span class="flex size-6 items-center"><i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200" :class="{ 'rotate-45': openFaq === 6 }"></i></span></button></dt><dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-6" x-show="openFaq === 6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0"><p class="">Yes. Our concierge services are available independently of villa bookings and can be arranged worldwide. Explore our offerings on the Concierge page.</p></dd></div></article>
            <article class="relative text-sm group rounded-xl bg-zinc-800"><div class="p-6"><dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left" aria-controls="faq-7" :aria-expanded="openFaq === 7" @click="openFaq = openFaq === 7 ? null : 7"><h3 class="text-base font-semibold">How does Luxuri ensure guest privacy and discretion?</h3><span class="flex size-6 items-center"><i class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200" :class="{ 'rotate-45': openFaq === 7 }"></i></span></button></dt><dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-7" x-show="openFaq === 7" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0"><p class="">We prioritize complete discretion and privacy. Many of our villas offer private entrances, gated access, and exclusive amenities to ensure your experience is both luxurious and confidential.</p></dd></div></article>
        </dl>
    </div>
</div>

<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="flex justify-between">
        <h2 class="text-3xl uppercase font-normal">Latest Articles</h2>
        <div class="py-2 flex gap-2"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-8">
        <div class="wow fadeInUp" data-wow-delay="0ms"><article class="relative group puffIn text-sm"><div class="mb-4"><div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-[4/3]" wire:ignore><img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_640_427.jpg 640w, https://media.luxuri.com/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_750_500.jpg 750w" alt="Top Miami Events in May 2025"></div></div><div class="flex-1"><div class="flex gap-2"><h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow"><a class="" href="blog/top-miami-events-in-may-2025.html">Top Miami Events in May 2025<div class="absolute inset-0"></div></a></h3></div><div class="text-zinc-400 mt-3 text-xs">May 1, 2025</div></div></article></div>
        <div class="wow fadeInUp" data-wow-delay="50ms"><article class="relative group puffIn text-sm"><div class="mb-4"><div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-[4/3]" wire:ignore><img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_640_427.jpg 640w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_1024_683.jpg 1024w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_1280_854.jpg 1280w" alt="Why Now Is the Time to Detox from Stress"></div></div><div class="flex-1"><div class="flex gap-2"><h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow"><a class="" href="blog/why-now-is-the-time-to-detox-from-stress.html">Why Now Is the Time to Detox from Stress (And Maybe Your Stocks)<div class="absolute inset-0"></div></a></h3></div><div class="text-zinc-400 mt-3 text-xs">March 26, 2025</div></div></article></div>
        <div class="wow fadeInUp" data-wow-delay="100ms"><article class="relative group puffIn text-sm"><div class="mb-4"><div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-[4/3]" wire:ignore><img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_720_480.jpg 720w, https://media.luxuri.com/67f697fec3f9f94af593446a9d94246f/responsive-images/featured___media_library_original_1029_686.jpg 1029w" alt="Go Bespoke or Go Home"></div></div><div class="flex-1"><div class="flex gap-2"><h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow"><a class="" href="blog/go-bespoke-or-go-home.html">Go Bespoke or Go Home<div class="absolute inset-0"></div></a></h3></div><div class="text-zinc-400 mt-3 text-xs">August 1, 2024</div></div></article></div>
        <div class="wow fadeInUp" data-wow-delay="150ms"><article class="relative group puffIn text-sm"><div class="mb-4"><div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-[4/3]" wire:ignore><img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_640_427.jpg 640w, https://media.luxuri.com/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_1024_683.jpg 1024w, https://media.luxuri.com/e08401cf19d408bce0ad279a0cf887e9/responsive-images/featured___media_library_original_1280_853.jpg 1280w" alt="3 Luxury Travel Perks You Didn't Know You Needed"></div></div><div class="flex-1"><div class="flex gap-2"><h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow"><a class="" href="blog/3-luxury-travel-perks-you-didn-t-know-you-needed.html">3 Luxury Travel Perks You Didn't Know You Needed<div class="absolute inset-0"></div></a></h3></div><div class="text-zinc-400 mt-3 text-xs">September 1, 2024</div></div></article></div>
    </div>
</div>

@endsection
