<!doctype html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $siteName = $settings->site_name ?? 'Luxteria';
        $seoTitle = app('seotools.metatags')->getTitle();
        $seoDesc = app('seotools.metatags')->getDescription();
        $defaultTitle = 'Luxury Concierge & Villa Experiences in Miami';
        $defaultDesc = 'From private villas and yachts to VIP lifestyle services LUXTERIA handles every detail with discretion, speed, and luxury.';

        $pageTitle = $seoTitle ?: $defaultTitle;
        $pageTitle = str_replace('Luxteria Magazine', $siteName . ' Magazine', $pageTitle);
        $pageTitle = str_replace([' | Luxteria Magazine', ' | Luxteria', 'Hand-Picked Luxteria'], [' | ' . $siteName . ' Magazine', ' | ' . $siteName, 'Hand-Picked ' . $siteName], $pageTitle);

        $pageDesc = $seoDesc ?: $defaultDesc;
        $pageDesc = str_replace('Luxteria', $siteName, $pageDesc);

        // Determine best image for social sharing (WhatsApp/Facebook/Twitter)
        if ($settings && $settings->favicon) {
            $ogImage = asset('storage/' . $settings->favicon);
        } elseif ($settings && $settings->logo) {
            $ogImage = asset('storage/' . $settings->logo);
        } else {
            $ogImage = asset('apple-touch-icon.png');
        }
    @endphp

    <title>{{ $pageTitle }}</title>

    <meta name="author" content="{{ $siteName }}">
    <meta name="description" content="{{ $pageDesc }}">
    <meta name="robots" content="index,follow">
    <meta name="theme-color" content="#303030">


    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDesc }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:alt" content="{{ $pageTitle }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:locale" content="en_US">
    @if($settings->facebook_app_id)
    <meta property="fb:app_id" content="{{ $settings->facebook_app_id }}">
    @endif




    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/') }}">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDesc }}">
    <meta name="twitter:image" content="{{ $ogImage }}">




    @if($settings && $settings->favicon)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $settings->favicon) }}?v=2" />
        <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="{{ asset('storage/' . $settings->favicon) }}?v=2" />
        <link rel="shortcut icon" href="{{ asset('storage/' . $settings->favicon) }}?v=2" />
    @else
        <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}?v=2" />
        <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=2" />
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=2" />
    @endif
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />
    <link rel="canonical" href="{{ url('/') }}">
    <meta name="theme-color" content="#fafafa">

    <link rel="stylesheet" href="{{ asset('build/assets/site-Nzwp7GqH.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/fontawesome-CugkwPiR.css') }}" />
    <link rel="modulepreload" href="{{ asset('build/assets/chunk-BPk1wpSm.js') }}" />
    <script type="module" src="{{ asset('build/assets/site-Dw_9KyND.js') }}"></script>
    @livewireStyles
    <style>
        [x-cloak] {
            display: none !important
        }
    </style>

    <script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Organization",
    "name": "{{ $siteName }}",
    "url": "{{ url('/') }}",
    "logo": {
        "@@type": "ImageObject",
        "url": "{{ $settings && $settings->logo ? asset('storage/' . $settings->logo) : asset('images/logo.png') }}"
    },
    "sameAs": []
}
</script>

    <script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "WebSite",
    "name": "{{ $siteName }}",
    "url": "{{ url('/') }}",
    "potentialAction": {
        "@@type": "SearchAction",
        "target": {
            "@@type": "EntryPoint",
            "urlTemplate": "{{ url('/properties?search={search_term_string}') }}"
        },
        "query-input": "required name=search_term_string"
    }
}
</script>
    <style>
        @font-face {
            font-family: "Helvetica Regular";
            src: url("https://db.onlinewebfonts.com/t/a64ff11d2c24584c767f6257e880dc65.eot");
            src: url("https://db.onlinewebfonts.com/t/a64ff11d2c24584c767f6257e880dc65.eot?#iefix") format("embedded-opentype"),
                url("https://db.onlinewebfonts.com/t/a64ff11d2c24584c767f6257e880dc65.woff2") format("woff2"),
                url("https://db.onlinewebfonts.com/t/a64ff11d2c24584c767f6257e880dc65.woff") format("woff"),
                url("https://db.onlinewebfonts.com/t/a64ff11d2c24584c767f6257e880dc65.ttf") format("truetype"),
                url("https://db.onlinewebfonts.com/t/a64ff11d2c24584c767f6257e880dc65.svg#Helvetica Regular") format("svg");
        }

        @keyframes fadeSlideUp {
            0% {
                opacity: 0;
                transform: translateY(40px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-slide-up {
            animation: fadeSlideUp 1s ease-out 0.4s both;
        }

        /* Dark Liquid Glossy Overlay */
        .liquid-bg {
            position: fixed;
            inset: 0;
            z-index: 9999;
            overflow: hidden;
            pointer-events: none;
            mix-blend-mode: soft-light;
            opacity: 0.5;
        }
        .liquid-bg .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(50px);
            opacity: 0.85;
            animation: liquidMove 18s ease-in-out infinite alternate;
        }
        .liquid-bg .blob:nth-child(1) {
            width: 800px; height: 800px;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,1), rgba(120,160,255,0.5) 55%, transparent 80%);
            top: -20%; left: -15%;
            animation-duration: 22s;
        }
        .liquid-bg .blob:nth-child(2) {
            width: 700px; height: 700px;
            background: radial-gradient(circle at 70% 70%, rgba(255,220,180,0.95), rgba(255,180,100,0.4) 55%, transparent 80%);
            bottom: -20%; right: -15%;
            animation-duration: 28s;
            animation-delay: -6s;
        }
        .liquid-bg .blob:nth-child(3) {
            width: 600px; height: 600px;
            background: radial-gradient(circle at 50% 50%, rgba(180,220,255,1), rgba(100,180,255,0.45) 55%, transparent 80%);
            top: 25%; left: 35%;
            animation-duration: 20s;
            animation-delay: -12s;
        }
        .liquid-bg .blob:nth-child(4) {
            width: 550px; height: 550px;
            background: radial-gradient(circle at 40% 60%, rgba(255,255,255,0.9), rgba(200,200,255,0.4) 55%, transparent 80%);
            top: 0%; right: 5%;
            animation-duration: 26s;
            animation-delay: -18s;
        }
        .liquid-bg .gloss-overlay {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 50% at 20% 30%, rgba(255,255,255,0.15), transparent 55%),
                radial-gradient(ellipse 70% 45% at 80% 70%, rgba(255,255,255,0.1), transparent 50%);
        }
        .liquid-bg .shine {
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, transparent 30%, rgba(255,255,255,0.22) 50%, transparent 70%);
            background-size: 200% 200%;
            animation: shineSweep 5s ease-in-out infinite;
        }
        @keyframes liquidMove {
            0% { transform: translate(0, 0) scale(1) rotate(0deg); }
            33% { transform: translate(60px, -50px) scale(1.2) rotate(10deg); }
            66% { transform: translate(-40px, 30px) scale(0.85) rotate(-6deg); }
            100% { transform: translate(50px, -20px) scale(1.1) rotate(4deg); }
        }

        img {
            image-rendering: auto;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }
        .liquid-bg .cursor-blob {
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.9;
            pointer-events: none;
            background: radial-gradient(circle at 50% 50%, rgba(255,255,255,1), rgba(140,200,255,0.6) 45%, transparent 70%);
            transform: translate(calc(var(--x, -50%) - 50%), calc(var(--y, -50%) - 50%));
            transition: transform 0.15s ease-out;
            will-change: transform;
            z-index: 10;
        }
    </style>
</head>

<body class="bg-black dark" x-data="{ menuOpen: false }">
    <div class="liquid-bg" aria-hidden="true">
        <div class="blob"></div>
        <div class="blob"></div>
        <div class="blob"></div>
        <div class="blob"></div>
        <div class="gloss-overlay"></div>
        <div class="shine"></div>
        <div class="cursor-blob"></div>
    </div>

    @php
        $menuItems = \App\Models\MenuItem::where('active', true)->orderBy('sort_order')->get();
    @endphp

    <header class="bg-zinc-900/1 relative z-20">

        <nav class="fixed top-0 w-full mx-auto flex gap-6 items-center justify-between p-6 lg:py-8 lg:px-8"
            aria-label="Global">
            <div
                class="absolute top-0 left-0 pointer-events-none w-full h-26 -z-10 bg-gradient-to-b from-black from-0% via-black/15 via-70% to-black/0 to-95% bg-blend-overlay">
            </div>

            <a class="-m-1.5 p-1.5" href="{{ url('/') }}">
                <span class="sr-only">{{ $siteName }}</span>
                @if($settings && $settings->logo)
                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $siteName }}" class="w-auto h-16">
                @else
                    <svg class="w-auto h-16" width="100%" height="100%" viewBox="0 0 104 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M100.609 16.294V0H104V16.294H100.609Z" fill="white" class="fill-black dark:fill-white" />
                        <path
                            d="M80.3086 16.294V0H86.4078C87.6556 0 88.6061 0.157803 89.2593 0.473408C89.9125 0.781673 90.4263 1.25508 90.8006 1.89363C91.1823 2.52484 91.3731 3.24046 91.3731 4.04048C91.3731 4.99464 91.0979 5.89741 90.5474 6.74881C89.9969 7.59288 89.2189 8.23876 88.2134 8.68648L93.542 16.294H89.4134L85.373 9.6333H83.5013V16.294H80.3086ZM83.5013 7.39837H84.283C85.6849 7.39837 86.6501 7.09378 87.1785 6.48459C87.707 5.8754 87.9712 5.18547 87.9712 4.4148C87.9712 3.7469 87.7547 3.21844 87.3216 2.82944C86.8886 2.4331 86.0078 2.23493 84.6794 2.23493H83.5013V7.39837Z"
                            fill="white" class="fill-black dark:fill-white" />
                        <path
                            d="M58.8359 0H62.2269V9.9856C62.2269 11.7912 62.5315 12.9875 63.1406 13.5747C63.7572 14.1619 64.5535 14.4555 65.5297 14.4555C66.4912 14.4555 67.2545 14.1655 67.8197 13.5857C68.3922 13.0059 68.6784 11.8866 68.6784 10.2278V0H71.629V10.0076C71.629 11.8939 71.3904 13.2481 70.9133 14.0701C70.4436 14.8848 69.761 15.527 68.8656 15.9968C67.9701 16.4665 66.8362 16.7014 65.4636 16.7014C64.1132 16.7014 62.9535 16.4849 61.9847 16.0518C61.0158 15.6115 60.2488 14.9619 59.6837 14.1032C59.1185 13.2371 58.8359 11.8609 58.8359 9.97459V0Z"
                            fill="white" class="fill-black dark:fill-white" />
                        <path
                            d="M37.6992 16.294L42.9177 8.26812L37.9304 0H41.8828L45.1967 5.48272L48.7858 0H51.5271L46.5288 7.68462L51.7033 16.294H47.7619L44.2278 10.47L40.4406 16.294H37.6992Z"
                            fill="white" class="fill-black dark:fill-white" />
                        <path
                            d="M17.7266 0H21.1175V9.9856C21.1175 11.7912 21.4221 12.9875 22.0313 13.5747C22.6478 14.1619 23.4442 14.4555 24.4203 14.4555C25.3818 14.4555 26.1452 14.1655 26.7103 13.5857C27.2828 13.0059 27.569 11.8866 27.569 10.2278V0H30.5196V10.0076C30.5196 11.8939 30.281 13.2481 29.804 14.0701C29.3342 14.8848 28.6516 15.527 27.7562 15.9968C26.8608 16.4665 25.7268 16.7014 24.3543 16.7014C23.0038 16.7014 21.8441 16.4849 20.8753 16.0518C19.9064 15.6115 19.1394 14.9619 18.5743 14.1032C18.0091 13.2371 17.7266 11.8609 17.7266 9.97459V0Z"
                            fill="white" class="fill-black dark:fill-white" />
                        <path d="M0 16.294V0H3.39092V13.982H10.7342V16.294H0Z" fill="white"
                            class="fill-black dark:fill-white" />
                    </svg>
                @endif
            </a>

            <div class="hidden lg:flex lg:gap-x-12 text-base font-medium ms-auto">
                @foreach($menuItems as $menuItem)
                    <a href="{{ url($menuItem->url) }}" target="{{ $menuItem->target ?? '_self' }}"
                        class="text-white transition-colors duration-300 hover:text-amber-200">{{ $menuItem->label }}</a>
                @endforeach
            </div>

            <div class="flex ms-4">
                <button type="button" x-on:click="menuOpen = !menuOpen"
                    class="-m-2.5 cursor-pointer inline-flex items-center justify-center rounded-md p-2.5 text-white transition-transform duration-200">
                    <span class="sr-only">Open main menu</span>
                    <div class="relative w-6 h-6">
                        <span
                            class="absolute top-1 left-0 w-6 h-0.5 bg-current transition-all duration-300 transform origin-center"
                            :class="menuOpen ? 'rotate-45 translate-y-2' : ''"></span>
                        <span class="absolute top-2.5 left-0 w-6 h-0.5 bg-current transition-all duration-300"
                            :class="menuOpen ? 'opacity-0' : ''"></span>
                        <span
                            class="absolute top-4 left-0 w-6 h-0.5 bg-current transition-all duration-300 transform origin-center"
                            :class="menuOpen ? '-rotate-45 -translate-y-2' : ''"></span>
                    </div>
                </button>
            </div>
        </nav>

        <div x-show="menuOpen" x-cloak x-transition:enter="duration-300 ease-out" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="duration-200 ease-in"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" role="dialog" aria-modal="true">

            <div class="fixed inset-0 z-20 bg-black/75" x-transition:enter="duration-300 ease-out"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="duration-200 ease-in" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"></div>

            <div x-on:click.outside="menuOpen = false"
                class="fixed w-full sm:w-110 inset-y-0 right-0 z-30 overflow-y-auto dark bg-zinc-900 shadow-2xl"
                x-transition:enter="duration-300 ease-out" x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0" x-transition:leave="duration-200 ease-in"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">

                <div class="py-6 px-6 lg:px-8">
                    <div class="flex items-center justify-end">
                        <a class="-m-1.5 p-1.5 sm:hidden" href="{{ url('/') }}">
                            <span class="sr-only">{{ $siteName }}</span>
                            @if($settings && $settings->logo)
                                <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $siteName }}" class="w-auto h-16">
                            @else
                                <svg class="w-auto h-16" width="100%" height="100%" viewBox="0 0 104 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100.609 16.294V0H104V16.294H100.609Z" fill="white"
                                        class="fill-black dark:fill-white" />
                                    <path
                                        d="M80.3086 16.294V0H86.4078C87.6556 0 88.6061 0.157803 89.2593 0.473408C89.9125 0.781673 90.4263 1.25508 90.8006 1.89363C91.1823 2.52484 91.3731 3.24046 91.3731 4.04048C91.3731 4.99464 91.0979 5.89741 90.5474 6.74881C89.9969 7.59288 89.2189 8.23876 88.2134 8.68648L93.542 16.294H89.4134L85.373 9.6333H83.5013V16.294H80.3086ZM83.5013 7.39837H84.283C85.6849 7.39837 86.6501 7.09378 87.1785 6.48459C87.707 5.8754 87.9712 5.18547 87.9712 4.4148C87.9712 3.7469 87.7547 3.21844 87.3216 2.82944C86.8886 2.4331 86.0078 2.23493 84.6794 2.23493H83.5013V7.39837Z"
                                        fill="white" class="fill-black dark:fill-white" />
                                    <path
                                        d="M58.8359 0H62.2269V9.9856C62.2269 11.7912 62.5315 12.9875 63.1406 13.5747C63.7572 14.1619 64.5535 14.4555 65.5297 14.4555C66.4912 14.4555 67.2545 14.1655 67.8197 13.5857C68.3922 13.0059 68.6784 11.8866 68.6784 10.2278V0H71.629V10.0076C71.629 11.8939 71.3904 13.2481 70.9133 14.0701C70.4436 14.8848 69.761 15.527 68.8656 15.9968C67.9701 16.4665 66.8362 16.7014 65.4636 16.7014C64.1132 16.7014 62.9535 16.4849 61.9847 16.0518C61.0158 15.6115 60.2488 14.9619 59.6837 14.1032C59.1185 13.2371 58.8359 11.8609 58.8359 9.97459V0Z"
                                        fill="white" class="fill-black dark:fill-white" />
                                    <path
                                        d="M37.6992 16.294L42.9177 8.26812L37.9304 0H41.8828L45.1967 5.48272L48.7858 0H51.5271L46.5288 7.68462L51.7033 16.294H47.7619L44.2278 10.47L40.4406 16.294H37.6992Z"
                                        fill="white" class="fill-black dark:fill-white" />
                                    <path
                                        d="M17.7266 0H21.1175V9.9856C21.1175 11.7912 21.4221 12.9875 22.0313 13.5747C22.6478 14.1619 23.4442 14.4555 24.4203 14.4555C25.3818 14.4555 26.1452 14.1655 26.7103 13.5857C27.2828 13.0059 27.569 11.8866 27.569 10.2278V0H30.5196V10.0076C30.5196 11.8939 30.281 13.2481 29.804 14.0701C29.3342 14.8848 28.6516 15.527 27.7562 15.9968C26.8608 16.4665 25.7268 16.7014 24.3543 16.7014C23.0038 16.7014 21.8441 16.4849 20.8753 16.0518C19.9064 15.6115 19.1394 14.9619 18.5743 14.1032C18.0091 13.2371 17.7266 11.8609 17.7266 9.97459V0Z"
                                        fill="white" class="fill-black dark:fill-white" />
                                    <path d="M0 16.294V0H3.39092V13.982H10.7342V16.294H0Z" fill="white"
                                        class="fill-black dark:fill-white" />
                                </svg>
                            @endif
                        </a>

                        <button type="button" x-on:click="menuOpen = false"
                            class="-m-2.5 ms-auto rounded-md p-2.5 text-zinc-50 hover:bg-zinc-700 transition-colors duration-200">
                            <span class="sr-only">Close menu</span>
                            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-zinc-100/30">
                            <ul role="list" class="space-y-2 py-6">
                                <li class="space-y-4" x-data="{ expanded: true }">
                                    <button type="button"
                                        class="flex w-full items-start justify-between text-left text-zinc-50 transition-all duration-200"
                                        x-show="menuOpen" x-on:click="expanded = !expanded"
                                        x-transition:enter="duration-300 delay-150 ease-out"
                                        x-transition:enter-start="opacity-0 translate-x-4"
                                        x-transition:enter-end="opacity-100 translate-x-0" aria-controls="faq-0"
                                        :aria-expanded="expanded">
                                        <span class="ml-auto flex h-7 items-center relative">
                                            <svg class="size-6 transition-all duration-300 ease-in-out"
                                                :class="{ 'opacity-0 rotate-90': expanded, 'opacity-100 rotate-0': !expanded }"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true" data-slot="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6v12m6-6H6" />
                                            </svg>
                                            <svg class="size-6 absolute transition-all duration-300 ease-in-out"
                                                :class="{ 'opacity-100 rotate-0': expanded, 'opacity-0 -rotate-90': !expanded }"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true" data-slot="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                            </svg>
                                        </span>
                                    </button>
                                    <div x-show="expanded" x-transition:enter="transition-all ease-out duration-500"
                                        x-transition:enter-start="opacity-0 max-h-0"
                                        x-transition:enter-end="opacity-100 max-h-screen"
                                        x-transition:leave="transition-all ease-in duration-300"
                                        x-transition:leave-start="opacity-100 max-h-screen"
                                        x-transition:leave-end="opacity-0 max-h-0" class="overflow-hidden">

                                        <div class="mb-4 border-top border-zinc-200">
                                            @foreach($menuItems as $menuItem)
                                                <a href="{{ url($menuItem->url) }}" target="{{ $menuItem->target ?? '_self' }}"
                                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-normal text-zinc-300 hover:bg-zinc-800 transition-all duration-200 delay-300"
                                                    style="transition-delay: {{ 350 + ($loop->index * 100) }}ms"
                                                    x-show="menuOpen" x-transition:enter="duration-300 ease-out"
                                                    x-transition:enter-start="opacity-0 translate-x-4"
                                                    x-transition:enter-end="opacity-100 translate-x-0">{{ $menuItem->label }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="z-0 text-zinc-50 font-light">
        @yield('content')
    </main>
    <footer class="pt-12 text-white font-light">
        <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
            <div class="grid md:grid-cols-3 lg:grid-cols-12 gap-x-4 gap-y-8">
                <div class="md:col-span-3 lg:col-span-6 space-y-12">
                    @if($settings && $settings->logo)
                        <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $siteName }}" class="block w-auto h-20">
                    @else
                        <svg class="block w-auto h-20" width="100%" height="100%" viewBox="0 0 104 17" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M100.609 16.294V0H104V16.294H100.609Z" fill="white"
                                class="fill-black dark:fill-white" />
                            <path
                                d="M80.3086 16.294V0H86.4078C87.6556 0 88.6061 0.157803 89.2593 0.473408C89.9125 0.781673 90.4263 1.25508 90.8006 1.89363C91.1823 2.52484 91.3731 3.24046 91.3731 4.04048C91.3731 4.99464 91.0979 5.89741 90.5474 6.74881C89.9969 7.59288 89.2189 8.23876 88.2134 8.68648L93.542 16.294H89.4134L85.373 9.6333H83.5013V16.294H80.3086ZM83.5013 7.39837H84.283C85.6849 7.39837 86.6501 7.09378 87.1785 6.48459C87.707 5.8754 87.9712 5.18547 87.9712 4.4148C87.9712 3.7469 87.7547 3.21844 87.3216 2.82944C86.8886 2.4331 86.0078 2.23493 84.6794 2.23493H83.5013V7.39837Z"
                                fill="white" class="fill-black dark:fill-white" />
                            <path
                                d="M58.8359 0H62.2269V9.9856C62.2269 11.7912 62.5315 12.9875 63.1406 13.5747C63.7572 14.1619 64.5535 14.4555 65.5297 14.4555C66.4912 14.4555 67.2545 14.1655 67.8197 13.5857C68.3922 13.0059 68.6784 11.8866 68.6784 10.2278V0H71.629V10.0076C71.629 11.8939 71.3904 13.2481 70.9133 14.0701C70.4436 14.8848 69.761 15.527 68.8656 15.9968C67.9701 16.4665 66.8362 16.7014 65.4636 16.7014C64.1132 16.7014 62.9535 16.4849 61.9847 16.0518C61.0158 15.6115 60.2488 14.9619 59.6837 14.1032C59.1185 13.2371 58.8359 11.8609 58.8359 9.97459V0Z"
                                fill="white" class="fill-black dark:fill-white" />
                            <path
                                d="M37.6992 16.294L42.9177 8.26812L37.9304 0H41.8828L45.1967 5.48272L48.7858 0H51.5271L46.5288 7.68462L51.7033 16.294H47.7619L44.2278 10.47L40.4406 16.294H37.6992Z"
                                fill="white" class="fill-black dark:fill-white" />
                            <path
                                d="M17.7266 0H21.1175V9.9856C21.1175 11.7912 21.4221 12.9875 22.0313 13.5747C22.6478 14.1619 23.4442 14.4555 24.4203 14.4555C25.3818 14.4555 26.1452 14.1655 26.7103 13.5857C27.2828 13.0059 27.569 11.8866 27.569 10.2278V0H30.5196V10.0076C30.5196 11.8939 30.281 13.2481 29.804 14.0701C29.3342 14.8848 28.6516 15.527 27.7562 15.9968C26.8608 16.4665 25.7268 16.7014 24.3543 16.7014C23.0038 16.7014 21.8441 16.4849 20.8753 16.0518C19.9064 15.6115 19.1394 14.9619 18.5743 14.1032C18.0091 13.2371 17.7266 11.8609 17.7266 9.97459V0Z"
                                fill="white" class="fill-black dark:fill-white" />
                            <path d="M0 16.294V0H3.39092V13.982H10.7342V16.294H0Z" fill="white"
                                class="fill-black dark:fill-white" />
                        </svg>
                    @endif

                    <div class="space-y-2 max-lg:hidden">
                        <h2 class="text-xl uppercase">Follow Us</h2>
                        <div class="flex gap-1 flex-wrap max-sm:text-sm">
                            @if($settings && $settings->instagram_url)
                                <a href="{{ $settings->instagram_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                    <span class="fa-stack">
                                        <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                        <i class="fa-brands fa-instagram fa-stack-1x text-black"></i>
                                    </span>
                                </a>
                            @endif
                            @if($settings && $settings->facebook_url)
                                <a href="{{ $settings->facebook_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                    <span class="fa-stack">
                                        <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                        <i class="fa-brands fa-facebook fa-stack-1x text-black"></i>
                                    </span>
                                </a>
                            @endif
                            @if($settings && $settings->tiktok_url)
                                <a href="{{ $settings->tiktok_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                    <span class="fa-stack">
                                        <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                        <i class="fa-brands fa-tiktok fa-stack-1x text-black"></i>
                                    </span>
                                </a>
                            @endif
                            @if($settings && $settings->pinterest_url)
                                <a href="{{ $settings->pinterest_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                    <span class="fa-stack">
                                        <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                        <i class="fa-brands fa-pinterest fa-stack-1x text-black"></i>
                                    </span>
                                </a>
                            @endif
                            @if($settings && $settings->google_maps_url)
                                <a href="{{ $settings->google_maps_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                    <span class="fa-stack">
                                        <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                        <i class="fa-brands fa-google fa-stack-1x text-black"></i>
                                    </span>
                                </a>
                            @endif
                            @if($settings && $settings->linkedin_url)
                                <a href="{{ $settings->linkedin_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                    <span class="fa-stack">
                                        <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                        <i class="fa-brands fa-linkedin fa-stack-1x text-black"></i>
                                    </span>
                                </a>
                            @endif
                            @if($settings && $settings->threads_url)
                                <a href="{{ $settings->threads_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                    <span class="fa-stack">
                                        <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                        <i class="fa-brands fa-threads fa-stack-1x text-black"></i>
                                    </span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="uppercase">Links</h3>
                    <ul role="list" class="space-y-2 lg:flex lg:space-x-4 lg:space-y-0">
                        @foreach($menuItems as $menuItem)
                            <li><a href="{{ url($menuItem->url) }}" target="{{ $menuItem->target ?? '_self' }}"
                                    class="text-white transition-colors duration-300 hover:text-amber-200">{{ $menuItem->label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="space-y-2 lg:hidden md:col-span-2">
                    <h2 class="text-xl uppercase">Follow Us</h2>
                    <div class="flex gap-1 flex-wrap max-sm:text-sm">
                        @if($settings && $settings->instagram_url)
                            <a href="{{ $settings->instagram_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                <span class="fa-stack">
                                    <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                    <i class="fa-brands fa-instagram fa-stack-1x text-black"></i>
                                </span>
                            </a>
                        @endif
                        @if($settings && $settings->facebook_url)
                            <a href="{{ $settings->facebook_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                <span class="fa-stack">
                                    <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                    <i class="fa-brands fa-facebook fa-stack-1x text-black"></i>
                                </span>
                            </a>
                        @endif
                        @if($settings && $settings->tiktok_url)
                            <a href="{{ $settings->tiktok_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                <span class="fa-stack">
                                    <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                    <i class="fa-brands fa-tiktok fa-stack-1x text-black"></i>
                                </span>
                            </a>
                        @endif
                        @if($settings && $settings->pinterest_url)
                            <a href="{{ $settings->pinterest_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                <span class="fa-stack">
                                    <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                    <i class="fa-brands fa-pinterest fa-stack-1x text-black"></i>
                                </span>
                            </a>
                        @endif
                        @if($settings && $settings->google_maps_url)
                            <a href="{{ $settings->google_maps_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                <span class="fa-stack">
                                    <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                    <i class="fa-brands fa-google fa-stack-1x text-black"></i>
                                </span>
                            </a>
                        @endif
                        @if($settings && $settings->linkedin_url)
                            <a href="{{ $settings->linkedin_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                <span class="fa-stack">
                                    <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                    <i class="fa-brands fa-linkedin fa-stack-1x text-black"></i>
                                </span>
                            </a>
                        @endif
                        @if($settings && $settings->threads_url)
                            <a href="{{ $settings->threads_url }}" target="_blank" class="transition-colors duration-300 hover:text-amber-200">
                                <span class="fa-stack">
                                    <i class="fa-sharp fa-circle fa-stack-2x text-current"></i>
                                    <i class="fa-brands fa-threads fa-stack-1x text-black"></i>
                                </span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-12 border-t border-white/30 ">
                <div class="flex max-md:text-center max-md:flex-col justify-center gap-x-8 gap-y-4">
                    @if($settings && $settings->phone)
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->phone) }}" class="transition-colors duration-300 hover:text-amber-200">
                            <i class="fa-sharp fa-light fa-phone"></i> {{ $settings->phone }}
                        </a>
                    @endif
                    @if($settings && $settings->email)
                        <a href="mailto:{{ $settings->email }}" class="transition-colors duration-300 hover:text-amber-200">
                            <i class="fa-sharp fa-light fa-envelope"></i> {{ $settings->email }}
                        </a>
                    @endif
                    @if($settings && $settings->mobile_phone)
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->mobile_phone) }}" class="transition-colors duration-300 hover:text-amber-200">
                            <i class="fa-sharp fa-light fa-mobile"></i> {{ $settings->mobile_phone }}
                        </a>
                    @endif
                </div>
                <div class="flex justify-center text-sm text-zinc-300 py-6">
                    {!! $settings && $settings->copyright_text ? $settings->copyright_text : '&copy; ' . date('Y') . ' ' . strtoupper($siteName) . '. All rights reserved.' !!}
                </div>
            </div>
        </div>
    </footer>
    <script>
        (function() {
            const liquidBg = document.querySelector('.liquid-bg');
            if (!liquidBg) return;
            const w = window.innerWidth;
            const h = window.innerHeight;
            let mx = w / 2;
            let my = h / 2;
            let cx = mx, cy = my;
            let lastMove = Date.now();
            let idlePhase = Math.random() * Math.PI * 2;
            document.addEventListener('mousemove', function(e) {
                mx = e.clientX;
                my = e.clientY;
                lastMove = Date.now();
                const cursorBlob = document.querySelector('.cursor-blob');
                if (cursorBlob) {
                    const isOverImage = e.target.tagName === 'IMG' || e.target.closest('img');
                    cursorBlob.style.opacity = isOverImage ? '0' : '0.9';
                }
            });
            function update() {
                const now = Date.now();
                const idle = now - lastMove > 600;
                if (idle) {
                    idlePhase += 0.008;
                    const ax = w * 0.5 + Math.sin(idlePhase) * w * 0.35 + Math.cos(idlePhase * 0.7) * w * 0.15;
                    const ay = h * 0.5 + Math.cos(idlePhase * 0.8) * h * 0.3 + Math.sin(idlePhase * 1.2) * h * 0.15;
                    cx += (ax - cx) * 0.025;
                    cy += (ay - cy) * 0.025;
                } else {
                    cx += (mx - cx) * 0.08;
                    cy += (my - cy) * 0.08;
                }
                liquidBg.style.setProperty('--x', cx + 'px');
                liquidBg.style.setProperty('--y', cy + 'px');
                requestAnimationFrame(update);
            }
            update();
        })();
    </script>
    @php
        $ctaPhone = $settings->mobile_phone ?? $settings->phone ?? '+1 (786) 981-0924';
        $ctaPhoneDigits = preg_replace('/[^0-9+]/', '', $ctaPhone);
    @endphp
    {{-- Floating Call CTA --}}
    <a href="tel:{{ $ctaPhoneDigits }}"
       class="fixed bottom-4 left-1/2 -translate-x-1/2 md:left-auto md:right-6 md:bottom-6 md:translate-x-0 z-50 inline-flex items-center justify-center gap-2 rounded-full bg-white text-black border-2 border-black px-5 py-3 text-sm font-bold shadow-[0_8px_30px_rgba(0,0,0,0.5)] transition-all hover:bg-zinc-100 hover:scale-105 tracking-wide">
        <i class="fa-sharp fa-solid fa-phone"></i>
        <span class="md:!hidden">Call Now</span>
        <span class="hidden md:!inline">NUMBER LABEL</span>
    </a>

    @livewireScripts
</body>

</html>