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

                        src: 'https:/{{ asset('media.luxuri.com/video/luxury-new-video.mp4') }}',

                        poster: 'https:/{{ asset('media.luxuri.com/video/luxury-new-video-preview.jpg') }}',

                    },

                    {

                        src: 'https:/{{ asset('media.luxuri.com/video/Fort_lauderdale_video.mp4') }}',

                        poster: null,

                    },

                    {

                        src: 'https:/{{ asset('media.luxuri.com/video/miami-video.mp4') }}',

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

        Luxuri Villas

    </h1>

    <p class="text-lg font-normal text-pretty text-center ">

        Rent your villa today

    </p>

</div>





    @livewire('site.villa-list')



@endsection

