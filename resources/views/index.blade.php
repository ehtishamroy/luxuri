@extends('layouts.app')
@section('content')
    <div class="bg-black text-white relative z-10">
        <div class="relative isolate pt-14 min-h-[90vh] md:min-h-[70vh] flex items-center">



            <div x-data="videoAutoplay()" x-init="init()" x-intersect:enter="startLazyLoad()"
                x-intersect:leave="pauseVideos()" class="absolute inset-0 -z-10 size-full overflow-hidden">

                <div class="relative size-full">

                    <img x-show="!isReady && videos[0].poster" :src="videos[0].poster" alt="Hero video preview"
                        class="absolute inset-0 size-full object-cover" loading="eager"
                        src="https://media.luxteria.co/video/luxury-new-video-preview.jpg" style="display: none;">


                    <video x-ref="mainVideo" x-show="isReady" class="size-full object-cover" muted playsinline
                        preload="auto" :poster="videos[currentVideo].poster || ''" @loadeddata="onVideoLoaded"
                        @ended="nextVideo" x-on:error="handleVideoError"
                        poster="https://media.luxteria.co/video/luxury-new-video-preview.jpg" style="">
                        <source :src="videos[currentVideo].src" type="video/mp4"
                            src="https://media.luxteria.co/video/luxury-new-video.mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <script>
                                document.addEventListener('alpine:ini                                            t', () => {
                            Alpine.data('videoAutoplay', () => ({
                                videos: [
                                    {
                                        src: 'https://media.luxteria.co/video/luxury-new-video.mp4',
                                        poster: 'https://media.luxteria.co/video/luxury-new-video-preview.jpg',
                                    },
                                    {
                                        src: 'https://media.luxteria.co/video/Fort_lauderdale_video.mp4',
                                        poster: null,
                                    },
                                    {
                                        src: 'https://media.luxteria.co/video/miami-video.mp4',
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
                </div>
                <div class="absolute inset-0 -z-10 size-full object-cover bg-black/20 bg-blend-multiply"></div>
                <div
                    class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay">
                </div>
                <div class="mx-auto max-w-7xl px-4 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0">
                    <div class="mx-auto py-18 max-w-5xl my-12">
                        <div class="space-y-6">
                            <div class="space-y-4 text-shadow-lg/10">
                                <h1
                                    class="text-3xl font-semibold tracking-wide text-center text-balance uppercase font-accent sm:text-5xl">
                                    {{ $homepageSettings->hero_title ?? 'Discover Your Luxury Villa Rental' }}
                                </h1>
                                <p class="text-lg font-normal text-pretty text-center ">
                                    {{ $homepageSettings->hero_subtitle ?? "Choose from luxteria's handpicked collection of high-end villas." }}
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
                <h2 class="text-3xl uppercase font-normal">{{ $homepageSettings->featured_villas_title ?? 'Featured Villas' }}
                </h2>
                <div class="py-2 flex gap-2"></div>
            </div>
            <ul class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($featuredVillas as $loop_i => $villa)
                    <li class="wow fadeInUp" data-wow-delay="{{ $loop_i * 50 }}ms">
                        <article class="relative text-sm group">
                            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
                                @if ($villa->first_image)
                                    <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110"
                                        loading="lazy" src="{{ $villa->first_image }}" alt="{{ $villa->title }}">
                                @else
                                    <div class="size-full bg-zinc-800 rounded-lg"></div>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <h3
                                    class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                                    <a class="" href="{{ route('villas.show', $villa) }}">{{ $villa->title }}
                                        <div class="absolute inset-0"></div>
                                    </a></h3>
                            </div>
                            <div class="text-zinc-200 flex justify-between gap-2">
                                <div class="italic mb-2">
                                    {{ $villa->destination?->name }}{{ $villa->location ? ", " . $villa->location : "" }}</div>
                                <div class="flex flex-wrap gap-1.5 mb-2">@if($villa->bedrooms)
                                    <div class=""><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> {{ $villa->bedrooms }}</div>
                                @endif @if($villa->max_guests) &middot; <div class=""><i
                                class="fa-sharp fa-light fa-person fa-sm me-1"></i> {{ $villa->max_guests }}</div>@endif
                                    @if($villa->bathrooms) &middot; <div class=""><i
                                    class="fa-sharp fa-light fa-sink fa-sm me-1"></i>{{ $villa->bathrooms }}</div>@endif
                                </div>
                            </div>
                            @if ($villa->price_per_night)
                                <div class="flex gap-2 justify-between items-center">
                                    <div class="relative">
                                        <div class="text-sm"><span
                                                class="font-semibold">${{ number_format($villa->price_per_night) }}</span><span
                                                class="text-zinc-400">/night</span></div>
                                    </div>
                                </div>
                            @endif
                        </article>
                    </li>
                @endforeach
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
                <div class="marquee-container">
                    <div class="marquee-track">
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/AIRBNB.png') }}" alt="Airbnb" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/VRBO.png') }}" alt="VRBO" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/One fine stay.png') }}" alt="One Fine Stay"
                                loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Plum guide.png') }}" alt="Plum Guide" loading="lazy" />
                        </div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Luxe.png') }}" alt="Luxe" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Oliver travels.png') }}" alt="Oliver Travels"
                                loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Stay one.png') }}" alt="Stay One" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Quintess.png') }}" alt="Quintess" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/FAVR.png') }}" alt="FAVR" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/BBB.png') }}" alt="Better Business Bureau"
                                loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Visit lauderdale.png') }}" alt="Visit Lauderdale"
                                loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/VRMA.png') }}" alt="VRMA" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/American express.png') }}" alt="American Express"
                                loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Visa.png') }}" alt="Visa" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Mastercard.png') }}" alt="Mastercard" loading="lazy" />
                        </div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Discover.png') }}" alt="Discover" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/AIRBNB.png') }}" alt="Airbnb" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/VRBO.png') }}" alt="VRBO" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/One fine stay.png') }}" alt="One Fine Stay"
                                loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Plum guide.png') }}" alt="Plum Guide" loading="lazy" />
                        </div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Luxe.png') }}" alt="Luxe" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Oliver travels.png') }}" alt="Oliver Travels"
                                loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Stay one.png') }}" alt="Stay One" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Quintess.png') }}" alt="Quintess" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/FAVR.png') }}" alt="FAVR" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/BBB.png') }}" alt="Better Business Bureau"
                                loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Visit lauderdale.png') }}" alt="Visit Lauderdale"
                                loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/VRMA.png') }}" alt="VRMA" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/American express.png') }}" alt="American Express"
                                loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Visa.png') }}" alt="Visa" loading="lazy" /></div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Mastercard.png') }}" alt="Mastercard" loading="lazy" />
                        </div>
                        <div class="flex-shrink-0 flex items-center justify-center max-w-48"><img
                                class="max-h-12 w-auto object-contain brightness-0 invert opacity-60 transition-opacity duration-300 select-none"
                                src="{{ asset('assets/media/partners/Discover.png') }}" alt="Discover" loading="lazy" /></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-black text-white relative -mb-8">
            <div class="relative isolate pt-14 min-h-[70vh] flex items-center">
                <img class="absolute inset-0 -z-10 size-full object-cover"
                    src="https://media.luxteria.co/b7cfd06c1d9d677f1e2943af6e51a36b/126.jpg" alt="Concierge">
                <div
                    class="absolute top-0 left-0 pointer-events-none w-full h-26 -z-10 bg-gradient-to-b from-black from-0% via-black/15 via-70% to-black/0 to-95% bg-blend-overlay">
                </div>
                <div
                    class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay">
                </div>
                <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0"></div>
            </div>
        </div>

        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
      .luxteria-features {
        --bg:#0a0a0a;
        --ink:#eeeeee;          /* soft white, not harsh #fff */
        --muted:#8c8c8c;        /* dimmed grey body copy */
        --gold:#ffffff;         /* accent is now pure white */
        --gold-soft:rgba(255,255,255,.22);
        --hair:rgba(255,255,255,.12); /* hairline dividers */
        --fs-body:16px;
        --fs-mid:24px;
        --fs-lead:32px;
      }

      .luxteria-features * {
        box-sizing:border-box;
        margin:0;
        padding:0;
      }

      .luxteria-features {
        color:var(--ink);
        font-family:'Noto Sans',sans-serif;
        font-size:var(--fs-body);
        line-height:1.7;
        font-weight:300;
        -webkit-font-smoothing:antialiased;
        /* subtle vignette so the black has depth instead of being flat */
        background-image:radial-gradient(120% 90% at 50% -10%, rgba(255,255,255,.05) 0%, transparent 55%);
      }

      .luxteria-features .section {
        width:100%;
        max-width:1240px;
        margin:0 auto;
        padding:120px 32px;
      }

      /* ---- Header ---- */
      .luxteria-features .head {
        text-align:center;
        max-width:680px;
        margin:0 auto 96px;
      }
      .luxteria-features .eyebrow {
        font-size:13px;
        text-transform:uppercase;
        letter-spacing:.42em;        /* wide tracking reads expensive */
        color:var(--gold);
        font-weight:500;
        margin-bottom:22px;
        display:inline-block;
      }
      .luxteria-features .head h2 {
        font-size:var(--fs-lead);    /* 32px */
        text-transform:uppercase;
        letter-spacing:.06em;
        font-weight:500;
        line-height:1.25;
        margin-bottom:26px;
      }
      .luxteria-features .head h2 .accent { color:var(--gold); font-weight:600; }
      .luxteria-features .head p {
        color:var(--muted);
        font-size:var(--fs-body);    /* 16px */
        max-width:560px;
        margin:0 auto;
      }

      /* thin gold rule under the header */
      .luxteria-features .rule {
        width:64px; height:1px;
        background:linear-gradient(90deg,transparent,var(--gold),transparent);
        margin:34px auto 0;
      }

      /* ---- Grid ---- */
      .luxteria-features .grid {
        display:grid;
        grid-template-columns:repeat(3,1fr);
        /* hairline column + row separators, the editorial luxury look */
        gap:1px;
        background:var(--hair);
        border:1px solid var(--hair);
        border-radius:16px;
        overflow:hidden;
      }
      .luxteria-features .card {
        background:var(--bg);
        padding:54px 42px;
        position:relative;
        transition:background .5s ease;
      }
      .luxteria-features .card:hover { background:#0f0e0c; }

      /* icon */
      .luxteria-features .icon {
        width:40px; height:40px;
        color:var(--gold);
        margin-bottom:28px;
        transition:transform .5s cubic-bezier(.2,.8,.2,1);
      }
      .luxteria-features .icon svg { width:100%; height:100%; stroke:currentColor; stroke-width:1.1; fill:none; }
      .luxteria-features .card:hover .icon { transform:translateY(-4px); }

      .luxteria-features .card h3 {
        font-size:var(--fs-mid);     /* 24px */
        font-weight:400;
        letter-spacing:.01em;
        line-height:1.3;
        margin-bottom:18px;
      }
      .luxteria-features .card p {
        color:var(--muted);
        font-size:var(--fs-body);    /* 16px */
        line-height:1.75;
      }

      /* gold index numeral, faint, behind the title — subtle couture detail */
      .luxteria-features .num {
        position:absolute;
        top:40px; right:42px;
        font-size:13px;
        letter-spacing:.2em;
        color:var(--gold);
        opacity:.45;
        font-weight:400;
      }

      /* staggered entrance */
      .luxteria-features .card { opacity:0; transform:translateY(18px); animation:rise .8s forwards; }
      .luxteria-features .card:nth-child(1) { animation-delay:.05s }
      .luxteria-features .card:nth-child(2) { animation-delay:.12s }
      .luxteria-features .card:nth-child(3) { animation-delay:.19s }
      .luxteria-features .card:nth-child(4) { animation-delay:.26s }
      .luxteria-features .card:nth-child(5) { animation-delay:.33s }
      .luxteria-features .card:nth-child(6) { animation-delay:.40s }
      @keyframes rise { to { opacity:1; transform:none } }

      @media(max-width:960px){
        .luxteria-features .grid { grid-template-columns:repeat(2,1fr); }
        .luxteria-features .section { padding:88px 24px; }
        .luxteria-features .head { margin-bottom:64px; }
      }
      @media(max-width:600px){
        .luxteria-features .grid { grid-template-columns:1fr; }
        .luxteria-features .card { padding:44px 30px; }
      }
    </style>

    <div class="luxteria-features">
      <section class="section">
        <div class="head">
          <span class="eyebrow">Vacation Made Easy</span>
          <h2>Fully Operated by <span class="accent">luxteria</span></h2>
          <p>Every villa in our collection is personally managed by our team — blending five-star hospitality with the privacy, space, and comfort of a true home.</p>
          <div class="rule"></div>
        </div>

        <div class="grid">

          <div class="card">
            <span class="num">01</span>
            <div class="icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8 12.5l2.5 2.5L16 9"/></svg></div>
            <h3>Handpicked &amp; luxteria-Approved</h3>
            <p>Each residence is thoughtfully chosen and maintained to our exacting standards, ensuring every stay is as seamless as it is memorable.</p>
          </div>

          <div class="card">
            <span class="num">02</span>
            <div class="icon"><svg viewBox="0 0 24 24"><path d="M12 3l1.8 6.2L20 11l-6.2 1.8L12 19l-1.8-6.2L4 11l6.2-1.8z"/></svg></div>
            <h3>Flawless from the Moment You Arrive</h3>
            <p>Our meticulous 302-point cleaning process ensures each villa is pristine upon arrival — no chores, no surprises, and no to-do lists at departure.</p>
          </div>

          <div class="card">
            <span class="num">03</span>
            <div class="icon"><svg viewBox="0 0 24 24"><path d="M4 20c4-3 12-3 16 0"/><path d="M5 16c2.5-5 11.5-5 14 0"/><path d="M12 4c1.5 2 1.5 4 0 6c-1.5-2-1.5-4 0-6z"/></svg></div>
            <h3>Premium Amenities for Work &amp; Play</h3>
            <p>From high-speed connectivity and serene workspaces to heated pools and in-home spa experiences, every home is prepared for both productivity and pleasure.</p>
          </div>

          <div class="card">
            <span class="num">04</span>
            <div class="icon"><svg viewBox="0 0 24 24"><path d="M10.5 3.5a1.5 1.5 0 013 0V10l8 4.5v2l-8-2.5v4l2 1.5v1.5l-3.5-1-3.5 1V19l2-1.5v-4l-8 2.5v-2l8-4.5z"/></svg></div>
            <h3>Inspiring Destinations</h3>
            <p>Whether waking to oceanfront sunrises or unwinding at golden hour from a hillside terrace, every location is chosen to evoke connection, wonder, and peace.</p>
          </div>

          <div class="card">
            <span class="num">05</span>
            <div class="icon"><svg viewBox="0 0 24 24"><path d="M3 11l9-7 9 7"/><path d="M5 9.5V20h14V9.5"/><path d="M10 20v-5h4v5"/></svg></div>
            <h3>Beauty Beyond the Photograph</h3>
            <p>Our villas are not just picture-perfect — they are curated to feel even more exquisite in person, with every detail considered for comfort and style.</p>
          </div>

          <div class="card">
            <span class="num">06</span>
            <div class="icon"><svg viewBox="0 0 24 24"><path d="M6 16V11a6 6 0 1112 0v5l2 2H4z"/><path d="M10 20a2 2 0 004 0"/></svg></div>
            <h3>24/7 Personalized Concierge</h3>
            <p>From private chefs and spa treatments to sunset cruises and last-minute reservations, our concierge team tailors every detail of your stay — day or night.</p>
          </div>

        </div>
      </section>
    </div>

        <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
            <div class="flex justify-between">
                <h2 class="text-3xl uppercase font-normal">Recent Reviews</h2>
                <div class="py-2 flex gap-2">
                    <button id="reviews-carousel-prev" class="px-1" type="button"><i
                            class="fa-sharp fa-light fa-arrow-left fa-xl"></i></button>
                    <button id="reviews-carousel-next" class="px-1" type="button"><i
                            class="fa-sharp fa-light fa-arrow-right fa-xl"></i></button>
                </div>
            </div>
            <style>
                #reviews .swiper-slide {
                    height: auto;
                }
            </style>
            <div id="reviews" class="swiper swiper-initialized swiper-horizontal swiper-watch-progress">
                <div class="swiper-wrapper">
                    <div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible swiper-slide-active"
                        data-swiper-slide-index="0" style="width: 286px; margin-right: 24px;">
                        <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
                            <figure class="h-full">
                                <div class="p-6 space-y-1 flex flex-col h-full">
                                    <figcaption class="space-y-6">
                                        <div
                                            class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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
                                                You for hosting my client and their guests. They thoroughly enjoyed their stay
                                                there.</span>
                                        </p>
                                    </blockquote>

                                    <a href="https://luxteria.co/properties/fl/fort-lauderdale/boardwalk-mansion"
                                        class="text-base uppercase font-normal self-end tracking-wide">Boardwalk Mansion</a>
                                </div>
                            </figure>
                        </article>
                    </div>
                    <div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible swiper-slide-next"
                        data-swiper-slide-index="1" style="width: 286px; margin-right: 24px;">
                        <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
                            <figure class="h-full">
                                <div class="p-6 space-y-1 flex flex-col h-full">
                                    <figcaption class="space-y-6">
                                        <div
                                            class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                                    <a href="https://luxteria.co/properties/fl/fort-lauderdale/park-place-mansion"
                                        class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
                                </div>
                            </figure>
                        </article>
                    </div>
                    <div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible" data-swiper-slide-index="2"
                        style="width: 286px; margin-right: 24px;">
                        <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
                            <figure class="h-full">
                                <div class="p-6 space-y-1 flex flex-col h-full">
                                    <figcaption class="space-y-6">
                                        <div
                                            class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                                    <a href="https://luxteria.co/properties/fl/fort-lauderdale/park-place-mansion"
                                        class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
                                </div>
                            </figure>
                        </article>
                    </div>
                    <div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible" data-swiper-slide-index="3"
                        style="width: 286px; margin-right: 24px;">
                        <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
                            <figure class="h-full">
                                <div class="p-6 space-y-1 flex flex-col h-full">
                                    <figcaption class="space-y-6">
                                        <div
                                            class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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
                                            <span>We had a great time! The house was awesome.</span>
                                        </p>
                                    </blockquote>

                                    <a href="https://luxteria.co/properties/fl/fort-lauderdale/park-place-mansion"
                                        class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
                                </div>
                            </figure>
                        </article>
                    </div>
                    <div class="swiper-slide" data-swiper-slide-index="4" style="width: 286px; margin-right: 24px;">
                        <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
                            <figure class="h-full">
                                <div class="p-6 space-y-1 flex flex-col h-full">
                                    <figcaption class="space-y-6">
                                        <div
                                            class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                                    <a href="https://luxteria.co/properties/fl/fort-lauderdale/boardwalk-mansion"
                                        class="text-base uppercase font-normal self-end tracking-wide">Boardwalk Mansion</a>
                                </div>
                            </figure>
                        </article>
                    </div>
                    <div class="swiper-slide" data-swiper-slide-index="5" style="width: 286px; margin-right: 24px;">
                        <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
                            <figure class="h-full">
                                <div class="p-6 space-y-1 flex flex-col h-full">
                                    <figcaption class="space-y-6">
                                        <div
                                            class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                                    <a href="https://luxteria.co/properties/fl/fort-lauderdale/las-palmas-royal-estate"
                                        class="text-base uppercase font-normal self-end tracking-wide">Las Palmas Royal
                                        Estate</a>
                                </div>
                            </figure>
                        </article>
                    </div>
                    <div class="swiper-slide" data-swiper-slide-index="6" style="width: 286px; margin-right: 24px;">
                        <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
                            <figure class="h-full">
                                <div class="p-6 space-y-1 flex flex-col h-full">
                                    <figcaption class="space-y-6">
                                        <div
                                            class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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
                                            <span>Loved the property… bubbles didn't work in hot tub… pool was cold… recommend a
                                                booklet of checkin rules.. how to work appliances.. hot tub.. air conditioning
                                                etc. asked and agreed to late. Ch...</span>
                                        </p>
                                    </blockquote>

                                    <a href="https://luxteria.co/properties/fl/fort-lauderdale/park-place-mansion"
                                        class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
                                </div>
                            </figure>
                        </article>
                    </div>
                    <div class="swiper-slide" data-swiper-slide-index="7" style="width: 286px; margin-right: 24px;">
                        <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
                            <figure class="h-full">
                                <div class="p-6 space-y-1 flex flex-col h-full">
                                    <figcaption class="space-y-6">
                                        <div
                                            class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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
                                            <span>We were 16 people on a golf trip. The house was great and the service was even
                                                better. We booked the night before our arrival and the house was clean and ready
                                                to go by 4:00pm check in. Thank you Kath...</span>
                                        </p>
                                    </blockquote>

                                    <a href="https://luxteria.co/properties/fl/southwest-ranches/new-2-acre-modern-compound-modani-estates"
                                        class="text-base uppercase font-normal self-end tracking-wide">Modani Estates</a>
                                </div>
                            </figure>
                        </article>
                    </div>
                    <div class="swiper-slide" data-swiper-slide-index="8" style="width: 286px; margin-right: 24px;">
                        <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
                            <figure class="h-full">
                                <div class="p-6 space-y-1 flex flex-col h-full">
                                    <figcaption class="space-y-6">
                                        <div
                                            class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                                    <a href="https://luxteria.co/properties/fl/fort-lauderdale/las-palmas-royal-estate"
                                        class="text-base uppercase font-normal self-end tracking-wide">Las Palmas Royal
                                        Estate</a>
                                </div>
                            </figure>
                        </article>
                    </div>
                    <div class="swiper-slide" data-swiper-slide-index="9" style="width: 286px; margin-right: 24px;">
                        <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
                            <figure class="h-full">
                                <div class="p-6 space-y-1 flex flex-col h-full">
                                    <figcaption class="space-y-6">
                                        <div
                                            class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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
                                            <span>What an incredible home for a family vacation! Conveniently located, very
                                                clean, great pool and hot tub and plenty of space for everyone to spread out! We
                                                met Kathy, the manager at check in and she wa...</span>
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
                                        <div
                                            class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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

                                    <a href="https://luxteria.co/properties/fl/fort-lauderdale/park-place-mansion"
                                        class="text-base uppercase font-normal self-end tracking-wide">Park Place Mansion</a>
                                </div>
                            </figure>
                        </article>
                    </div>
                    <div class="swiper-slide" data-swiper-slide-index="11" style="width: 286px; margin-right: 24px;">
                        <article class="relative text-sm group rounded-xl bg-zinc-800 h-full">
                            <figure class="h-full">
                                <div class="p-6 space-y-1 flex flex-col h-full">
                                    <figcaption class="space-y-6">
                                        <div
                                            class="[:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white">
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
                                            <span>This place was great and Elly and Kathy were very responsive leading up to and
                                                during our stay. I'd recommend this place to anyone!</span>
                                        </p>
                                    </blockquote>
                                </div>
                            </figure>
                        </article>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
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
                    <article class="relative text-sm group rounded-xl bg-zinc-800">
                        <div class="p-6">
                            <dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left"
                                    aria-controls="faq-0" :aria-expanded="openFaq === 0"
                                    @click="openFaq = openFaq === 0 ? null : 0">
                                    <h3 class="text-base font-semibold">What is the minimum age requirement to book a stay with
                                        luxteria?</h3><span class="flex size-6 items-center"><i
                                            class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                                            :class="{ 'rotate-45': openFaq === 0 }"></i></span>
                                </button></dt>
                            <dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-0"
                                x-show="openFaq === 0" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0">
                                <p class="">Guests must be at least 21 years old to book a luxteria villa.</p>
                            </dd>
                        </div>
                    </article>
                    <article class="relative text-sm group rounded-xl bg-zinc-800">
                        <div class="p-6">
                            <dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left"
                                    aria-controls="faq-1" :aria-expanded="openFaq === 1"
                                    @click="openFaq = openFaq === 1 ? null : 1">
                                    <h3 class="text-base font-semibold">How can I reserve a luxteria property?</h3><span
                                        class="flex size-6 items-center"><i
                                            class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                                            :class="{ 'rotate-45': openFaq === 1 }"></i></span>
                                </button></dt>
                            <dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-1"
                                x-show="openFaq === 1" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0">
                                <p class="">You can reserve a property by submitting an inquiry or contacting our reservations
                                    team at 786-981-0924 or info@luxteria.co. Due to high demand, a 50% deposit is required to
                                    secure your booking.</p>
                            </dd>
                        </div>
                    </article>
                    <article class="relative text-sm group rounded-xl bg-zinc-800">
                        <div class="p-6">
                            <dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left"
                                    aria-controls="faq-2" :aria-expanded="openFaq === 2"
                                    @click="openFaq = openFaq === 2 ? null : 2">
                                    <h3 class="text-base font-semibold">Can I host an event at a luxteria property?</h3><span
                                        class="flex size-6 items-center"><i
                                            class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                                            :class="{ 'rotate-45': openFaq === 2 }"></i></span>
                                </button></dt>
                            <dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-2"
                                x-show="openFaq === 2" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0">
                                <p class="">Event availability varies by property. Additional event fees may apply in addition
                                    to the nightly rate. Please contact us at 786-981-0924 for personalized assistance.</p>
                            </dd>
                        </div>
                    </article>
                    <article class="relative text-sm group rounded-xl bg-zinc-800">
                        <div class="p-6">
                            <dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left"
                                    aria-controls="faq-3" :aria-expanded="openFaq === 3"
                                    @click="openFaq = openFaq === 3 ? null : 3">
                                    <h3 class="text-base font-semibold">What is luxteria's cancellation policy?</h3><span
                                        class="flex size-6 items-center"><i
                                            class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                                            :class="{ 'rotate-45': openFaq === 3 }"></i></span>
                                </button></dt>
                            <dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-3"
                                x-show="openFaq === 3" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0">
                                <p class="">Cancellations must be made at least 30 days prior to check-in for a partial refund,
                                    minus a 25% cancellation fee. Cancellations made 13 days or fewer before check-in are
                                    non-refundable, though the security deposit will be returned.</p>
                            </dd>
                        </div>
                    </article>
                    <article class="relative text-sm group rounded-xl bg-zinc-800">
                        <div class="p-6">
                            <dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left"
                                    aria-controls="faq-4" :aria-expanded="openFaq === 4"
                                    @click="openFaq = openFaq === 4 ? null : 4">
                                    <h3 class="text-base font-semibold">Are pets allowed at luxteria properties?</h3><span
                                        class="flex size-6 items-center"><i
                                            class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                                            :class="{ 'rotate-45': openFaq === 4 }"></i></span>
                                </button></dt>
                            <dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-4"
                                x-show="openFaq === 4" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0">
                                <p class="">Some luxteria homes are pet-friendly. Check the individual listing details or reach
                                    out to our team to confirm if a property can accommodate your pet.</p>
                            </dd>
                        </div>
                    </article>
                    <article class="relative text-sm group rounded-xl bg-zinc-800">
                        <div class="p-6">
                            <dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left"
                                    aria-controls="faq-5" :aria-expanded="openFaq === 5"
                                    @click="openFaq = openFaq === 5 ? null : 5">
                                    <h3 class="text-base font-semibold">Does luxteria offer personalized services during my
                                        stay?</h3><span class="flex size-6 items-center"><i
                                            class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                                            :class="{ 'rotate-45': openFaq === 5 }"></i></span>
                                </button></dt>
                            <dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-5"
                                x-show="openFaq === 5" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0">
                                <p class="">Absolutely. We provide a range of luxury concierge services, including private
                                    chefs, in-villa spa treatments, and custom itinerary planning to enhance your stay.</p>
                            </dd>
                        </div>
                    </article>
                    <article class="relative text-sm group rounded-xl bg-zinc-800">
                        <div class="p-6">
                            <dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left"
                                    aria-controls="faq-6" :aria-expanded="openFaq === 6"
                                    @click="openFaq = openFaq === 6 ? null : 6">
                                    <h3 class="text-base font-semibold">Can I use luxteria concierge services without booking a
                                        villa?</h3><span class="flex size-6 items-center"><i
                                            class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                                            :class="{ 'rotate-45': openFaq === 6 }"></i></span>
                                </button></dt>
                            <dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-6"
                                x-show="openFaq === 6" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0">
                                <p class="">Yes. Our concierge services are available independently of villa bookings and can be
                                    arranged worldwide. Explore our offerings on the Concierge page.</p>
                            </dd>
                        </div>
                    </article>
                    <article class="relative text-sm group rounded-xl bg-zinc-800">
                        <div class="p-6">
                            <dt><button type="button" class="flex w-full items-start justify-between gap-6 text-left"
                                    aria-controls="faq-7" :aria-expanded="openFaq === 7"
                                    @click="openFaq = openFaq === 7 ? null : 7">
                                    <h3 class="text-base font-semibold">How does luxteria ensure guest privacy and discretion?
                                    </h3><span class="flex size-6 items-center"><i
                                            class="fa-sharp fa-light fa-plus fa-fw fa-lg transition-transform duration-200"
                                            :class="{ 'rotate-45': openFaq === 7 }"></i></span>
                                </button></dt>
                            <dd class="mt-2 pr-12 overflow-hidden transition-all duration-300 ease-in-out" id="faq-7"
                                x-show="openFaq === 7" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0">
                                <p class="">We prioritize complete discretion and privacy. Many of our villas offer private
                                    entrances, gated access, and exclusive amenities to ensure your experience is both luxurious
                                    and confidential.</p>
                            </dd>
                        </div>
                    </article>
                </dl>
            </div>
        </div>

        <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
            <div class="flex justify-between">
                <h2 class="text-3xl uppercase font-normal">{{ $homepageSettings->latest_articles_title ?? 'Latest Articles' }}
                </h2>
                <div class="py-2 flex gap-2"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-8">
                @forelse ($recentPosts as $loop_i => $post)
                    <div class="wow fadeInUp" data-wow-delay="{{ $loop_i * 50 }}ms">
                        <article class="relative group puffIn text-sm">
                            <div class="mb-4">
                                <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-[4/3]" wire:ignore>
                                    @if ($post->featured_image)<img
                                        class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110"
                                    loading="lazy" src="{{ $post->featured_image }}" alt="{{ $post->title }}">@else<div
                                    class="size-full bg-zinc-800 rounded-lg"></div>@endif</div>
                            </div>
                            <div class="flex-1">
                                <div class="flex gap-2">
                                    <h3
                                        class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                                        <a class="" href="{{ route('magazine.show', $post) }}">{{ $post->title }}
                                            <div class="absolute inset-0"></div>
                                        </a></h3>
                                </div>
                                <div class="text-zinc-400 mt-3 text-xs">{{ $post->published_at->format('F j, Y') }}</div>
                            </div>
                        </article>
                    </div>
                @empty
                    <p class="col-span-4 text-zinc-400">No articles published yet.</p>
                @endforelse
            </div>
        </div>

@endsection