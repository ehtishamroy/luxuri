@extends('layouts.app')
@section('content')
<main class="z-0 text-zinc-50 font-light">
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "BlogPosting",
        "headline": "{{ $magazinePost->title }}",
        "description": "{{ $magazinePost->meta_description ?: $magazinePost->excerpt }}",
        "image": "{{ $magazinePost->featured_image }}",
        "author": {
            "@type": "Organization",
            "name": "{{ $magazinePost->author ?: 'Luxteria' }}"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Luxteria",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ asset('images/logo.png') }}"
            }
        },
        "datePublished": "{{ $magazinePost->published_at?->toIso8601String() }}",
        "dateModified": "{{ $magazinePost->updated_at?->toIso8601String() }}",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ url('/magazine/'.$magazinePost->slug) }}"
        }
    }
    </script>

    <div class="bg-black text-white relative z-10">
        <div class="relative isolate pt-14 min-h-[40vh] flex items-center">
            @if($magazinePost->featured_image)
                <img class="absolute inset-0 -z-10 size-full object-cover"
                     src="{{ $magazinePost->featured_image }}"
                     alt="{{ $magazinePost->title }}" />
            @endif
            <div class="absolute inset-0 -z-10 size-full object-cover bg-black/20 bg-blend-multiply"></div>
            <div class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>
            <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0">
                <div class="mx-auto py-18 max-w-5xl my-12"></div>
            </div>
        </div>
    </div>

    <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
        <div class="max-w-[90rch] mx-auto space-y-6">
            <div class="flex max-lg:flex-col gap-4 lg:items-end">
                <h1 class="grow">{{ $magazinePost->title }}</h1>
                <div class="font-normal flex-shrink-0 italic">
                    <time datetime="{{ $magazinePost->published_at }}">{{ $magazinePost->published_at?->format('F j, Y') }}</time>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
        <div class="max-w-[90rch] mx-auto">
            <div class="space-y-4 text-left">
                <div class="content-format">
                    {!! $magazinePost->content !!}
                </div>
            </div>
        </div>
    </div>

    <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
        <div class="max-w-[90rch] mx-auto">
            <a href="{{ route('magazine.index') }}" class="text-amber-400 hover:underline text-sm">&larr; Back to Magazine</a>
        </div>
    </div>
</main>
@endsection