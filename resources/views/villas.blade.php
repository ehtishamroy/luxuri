@extends('layouts.app')
@section('content')
<div class="bg-black text-white relative z-10">
    <div class="relative isolate pt-14 min-h-[90vh] md:min-h-[70vh] flex items-center">
        <div
    x-data="videoAutoplay()"
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
                    const playOnce = () => {
                        this.$refs.mainVideo.play();
                    };
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
        Luxuri Villas
    </h1>
    <p class="text-lg font-normal text-pretty text-center ">
        Rent your villa today
    </p>
</div>

    @livewire('site.planner')

        </div>
    </div>
</div>
</div>

<!-- Popular Destinations Section -->
<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="flex justify-between">
    <h2 class="text-3xl uppercase font-normal">Popular Destinations</h2>
    <div class="py-2 flex gap-2">
        <button id="section-11-carousel-prev" class="px-1" type="button"><i class="fa-sharp fa-light fa-arrow-left fa-xl"></i></button>
        <button id="section-11-carousel-next" class="px-1" type="button"><i class="fa-sharp fa-light fa-arrow-right fa-xl"></i></button>
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
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" srcset="https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_5464_3640.jpeg 5464w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_4571_3045.jpeg 4571w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_3824_2547.jpeg 3824w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_3200_2132.jpeg 3200w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_2677_1783.jpeg 2677w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_2240_1492.jpeg 2240w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_1874_1248.jpeg 1874w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_1568_1045.jpeg 1568w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_1311_873.jpeg 1311w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_1097_731.jpeg 1097w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_918_612.jpeg 918w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_768_512.jpeg 768w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_642_428.jpeg 642w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_537_358.jpeg 537w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_449_299.jpeg 449w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_376_250.jpeg 376w, https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/responsive-images/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc___media_library_original_314_209.jpeg 314w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgNTQ2NCAzNjQwIj4KCTxpbWFnZSB3aWR0aD0iNTQ2NCIgaGVpZ2h0PSIzNjQwIiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMezlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEE0TzJnQllLU0swREFZV1VJM1h0WE9mYUdFZzhza24ycld0WHVaU0NGSmFoMDVwa09yVHNkQklpMnR1ck9jbHFvdklzcDZnQ3FVcjNFakZicHlvSFNzUzd2MmhrS28rUld0T0hjeG5VN0lvYVpkUEZNRGdOOWEyeHJGeERPQ2dVVVVWcXRqTnJVb2FscXR4Y1NmTWZ5ckhrZG01Sm9vcVJvLzlrPSI+Cgk8L2ltYWdlPgo8L3N2Zz4= 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="12vw" src="https://media.luxuri.com/be75fb2bbbf526e43575cd5a655da7b7/beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc.jpeg" width="5464" height="3640" alt="beautiful-aerial-view-of-the-blue-point-beach-in-b-2025-02-11-16-45-43-utc.jpeg">
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

<!-- Featured Villas Section -->
<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="flex justify-between">
    <h2 class="text-3xl uppercase font-normal">Featured Villas</h2>
    <div class="py-2 flex gap-2">
        
    </div>
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
        <div class="flex gap-2 justify-between items-center"><div class="relative"><div class="text-sm"><span class="font-semibold">$3,000</span><span class="text-zinc-400">/night</span></div></div></div>
        </article>
    </li>
</ul>
</div>

@endsection
