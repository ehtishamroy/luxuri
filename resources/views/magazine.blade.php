@extends('layouts.app')
@section('content')
<div class="bg-black text-white relative z-10">
    <div class="relative isolate pt-14 min-h-[60vh] flex items-center">
                    <img class="absolute inset-0 -z-10 size-full object-cover"  srcset="https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_320_214.jpg') }} 320w, https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_375_250.jpg') }} 375w, https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_414_276.jpg') }} 414w, https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_500_334.jpg') }} 500w, https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_640_427.jpg') }} 640w, https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_750_501.jpg') }} 750w, https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_828_553.jpg') }} 828w, https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_1000_668.jpg') }} 1000w, https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_1024_684.jpg') }} 1024w, https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_1280_854.jpg') }} 1280w, https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_1440_961.jpg') }} 1440w, https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_1500_1001.jpg') }} 1500w, https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_1920_1282.jpg') }} 1920w, https:/{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_2000_1335.jpg') }} 2000w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMjAwMCAxMzM1Ij4KCTxpbWFnZSB3aWR0aD0iMjAwMCIgaGVpZ2h0PSIxMzM1IiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEFnL3M1bU9CVVVtbnl4OXEySTQ1RXd6RHZWbWE0dDNRSWNBNHIySVozVlV0ZFVjRXN1aGJRNGk1MDY0dnJqeVlsemlwNC9DZDhCeWhycHJYeWJXVnB3UWExYmZXb3BWNkN2UHhHT2xWcU9UT21saDR3anluQ3hhOWR5T1F4R0twM3VwM0htNURVVVY2a2FGTy93bm56cXo3aklOVHVEQStXcUpOWXVZeDhwb29yREZVb1JwdHBHbEtwTnkxWi85az0iPgoJPC9pbWFnZT4KPC9zdmc+ 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="{{ asset('media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/featured.jpg') }}" width="320" height="214" alt="an aerial view of the outside of Boardwalk Mansion villa">

                <div class="absolute inset-0 -z-10 size-full object-cover bg-black/20 bg-blend-multiply"
        ></div>
        <div
            class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0">
            <div class="mx-auto py-18 max-w-5xl my-12">
                <div class="space-y-6">
                    <div class="space-y-4 text-shadow-lg/10">
    <h1 class="text-3xl font-semibold tracking-wide text-center text-balance uppercase font-accent sm:text-5xl">
        Luxuri Magazine
    </h1>
    <p class="text-lg font-normal text-pretty text-center ">
        Discover curated insights on luxury travel, refined living, and exclusive experiences.
    </p>
</div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8">
                            <div class="wow fadeInUp" data-wow-delay="0ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_187_125.jpg 187w, https://media.luxuri.com/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_320_213.jpg 320w, https://media.luxuri.com/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_375_250.jpg 375w, https://media.luxuri.com/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_414_276.jpg 414w, https://media.luxuri.com/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_562_375.jpg 562w, https://media.luxuri.com/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_640_427.jpg 640w, https://media.luxuri.com/b881777ab725a0f9e84ef26bad1a9968/responsive-images/featured___media_library_original_750_500.jpg 750w" src="https://media.luxuri.com/b881777ab725a0f9e84ef26bad1a9968/featured.jpg" width="750" height="500" alt="featured.jpg">

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
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_320_213.jpg 320w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_375_250.jpg 375w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_400_267.jpg 400w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_414_276.jpg 414w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_640_427.jpg 640w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_750_500.jpg 750w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_800_534.jpg 800w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_828_552.jpg 828w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_1024_683.jpg 1024w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_1200_800.jpg 1200w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_1280_854.jpg 1280w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_1440_960.jpg 1440w, https://media.luxuri.com/531a9942bce12455b447e429d0137442/responsive-images/featured___media_library_original_1600_1067.jpg 1600w" src="https://media.luxuri.com/531a9942bce12455b447e429d0137442/featured.jpg" width="1600" height="1067" alt="featured.jpg">

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
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/8e4df74b47ef2163eb27635463278b77/responsive-images/featured___media_library_original_250_167.jpg 250w, https://media.luxuri.com/8e4df74b47ef2163eb27635463278b77/responsive-images/featured___media_library_original_320_213.jpg 320w, https://media.luxuri.com/8e4df74b47ef2163eb27635463278b77/responsive-images/featured___media_library_original_375_250.jpg 375w, https://media.luxuri.com/8e4df74b47ef2163eb27635463278b77/responsive-images/featured___media_library_original_414_276.jpg 414w, https://media.luxuri.com/8e4df74b47ef2163eb27635463278b77/responsive-images/featured___media_library_original_500_333.jpg 500w, https://media.luxuri.com/8e4df74b47ef2163eb27635463278b77/responsive-images/featured___media_library_original_640_426.jpg 640w, https://media.luxuri.com/8e4df74b47ef2163eb27635463278b77/responsive-images/featured___media_library_original_750_500.jpg 750w, https://media.luxuri.com/8e4df74b47ef2163eb27635463278b77/responsive-images/featured___media_library_original_828_551.jpg 828w, https://media.luxuri.com/8e4df74b47ef2163eb27635463278b77/responsive-images/featured___media_library_original_1000_666.jpg 1000w" src="https://media.luxuri.com/8e4df74b47ef2163eb27635463278b77/featured.jpg" width="1000" height="666" alt="featured.jpg">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/luxury-bachelor-and-bachelorette-villas-in-miami-beach.html">
                Bachelor &amp; Bachelorette Villas in Miami Beach
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                April 16, 2025
            </div>
            </div>
</article>
                </div>
                            <div class="wow fadeInUp" data-wow-delay="150ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/acb6c70b97f64fe6d916a4c70861ff15/responsive-images/featured___media_library_original_250_141.jpg 250w, https://media.luxuri.com/acb6c70b97f64fe6d916a4c70861ff15/responsive-images/featured___media_library_original_320_180.jpg 320w, https://media.luxuri.com/acb6c70b97f64fe6d916a4c70861ff15/responsive-images/featured___media_library_original_375_211.jpg 375w, https://media.luxuri.com/acb6c70b97f64fe6d916a4c70861ff15/responsive-images/featured___media_library_original_414_233.jpg 414w, https://media.luxuri.com/acb6c70b97f64fe6d916a4c70861ff15/responsive-images/featured___media_library_original_500_281.jpg 500w, https://media.luxuri.com/acb6c70b97f64fe6d916a4c70861ff15/responsive-images/featured___media_library_original_640_360.jpg 640w, https://media.luxuri.com/acb6c70b97f64fe6d916a4c70861ff15/responsive-images/featured___media_library_original_750_422.jpg 750w, https://media.luxuri.com/acb6c70b97f64fe6d916a4c70861ff15/responsive-images/featured___media_library_original_828_465.jpg 828w, https://media.luxuri.com/acb6c70b97f64fe6d916a4c70861ff15/responsive-images/featured___media_library_original_1000_562.jpg 1000w" src="https://media.luxuri.com/acb6c70b97f64fe6d916a4c70861ff15/featured.jpg" width="1000" height="562" alt="featured.jpg">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/top-luxury-villa-rentals-in-miami.html">
                Where to Stay in Miami: Top Luxury Villa Rentals in Miami
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                March 31, 2025
            </div>
            </div>
</article>
                </div>
                            <div class="wow fadeInUp" data-wow-delay="200ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_320_214.jpg 320w, https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_375_250.jpg 375w, https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_414_276.jpg 414w, https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_500_334.jpg 500w, https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_640_427.jpg 640w, https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_750_501.jpg 750w, https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_828_553.jpg 828w, https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_1000_668.jpg 1000w, https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_1024_684.jpg 1024w, https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_1280_854.jpg 1280w, https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_1440_961.jpg 1440w, https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_1500_1001.jpg 1500w, https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_1920_1282.jpg 1920w, https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/responsive-images/featured___media_library_original_2000_1335.jpg 2000w" src="https://media.luxuri.com/4d4b19ef720dc8ef7859871647c30dc8/featured.jpg" width="2000" height="1335" alt="featured.jpg">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/top-luxury-villa-rentals-in-fort-lauderdale.html">
                Top Luxury Villa Rentals in Fort Lauderdale: Ultimate Rental Guide
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                March 19, 2025
            </div>
            </div>
</article>
                </div>
                            <div class="wow fadeInUp" data-wow-delay="250ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/ad7eda4bc9ed11918f236046c4b1d4b6/responsive-images/featured___media_library_original_320_180.jpg 320w, https://media.luxuri.com/ad7eda4bc9ed11918f236046c4b1d4b6/responsive-images/featured___media_library_original_375_211.jpg 375w, https://media.luxuri.com/ad7eda4bc9ed11918f236046c4b1d4b6/responsive-images/featured___media_library_original_414_233.jpg 414w, https://media.luxuri.com/ad7eda4bc9ed11918f236046c4b1d4b6/responsive-images/featured___media_library_original_480_270.jpg 480w, https://media.luxuri.com/ad7eda4bc9ed11918f236046c4b1d4b6/responsive-images/featured___media_library_original_640_360.jpg 640w, https://media.luxuri.com/ad7eda4bc9ed11918f236046c4b1d4b6/responsive-images/featured___media_library_original_750_422.jpg 750w, https://media.luxuri.com/ad7eda4bc9ed11918f236046c4b1d4b6/responsive-images/featured___media_library_original_828_466.jpg 828w, https://media.luxuri.com/ad7eda4bc9ed11918f236046c4b1d4b6/responsive-images/featured___media_library_original_960_540.jpg 960w, https://media.luxuri.com/ad7eda4bc9ed11918f236046c4b1d4b6/responsive-images/featured___media_library_original_1024_576.jpg 1024w, https://media.luxuri.com/ad7eda4bc9ed11918f236046c4b1d4b6/responsive-images/featured___media_library_original_1280_720.jpg 1280w, https://media.luxuri.com/ad7eda4bc9ed11918f236046c4b1d4b6/responsive-images/featured___media_library_original_1440_810.jpg 1440w, https://media.luxuri.com/ad7eda4bc9ed11918f236046c4b1d4b6/responsive-images/featured___media_library_original_1920_1080.jpg 1920w" src="https://media.luxuri.com/ad7eda4bc9ed11918f236046c4b1d4b6/featured.jpg" width="1920" height="1080" alt="featured.jpg">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/Villas-to-Stay-for-the-2025-Miami-Grand-Prix.html">
                Where to Stay for the 2025 Miami Grand Prix: The Best Villas for an Exciting Race Weekend
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                March 2, 2025
            </div>
            </div>
</article>
                </div>
                            <div class="wow fadeInUp" data-wow-delay="300ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_320_212.jpg 320w, https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_375_248.jpg 375w, https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_414_274.jpg 414w, https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_500_331.jpg 500w, https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_640_423.jpg 640w, https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_750_496.jpg 750w, https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_828_548.jpg 828w, https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_1000_662.jpg 1000w, https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_1024_677.jpg 1024w, https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_1280_847.jpg 1280w, https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_1440_953.jpg 1440w, https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_1500_992.jpg 1500w, https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_1920_1270.jpg 1920w, https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/responsive-images/featured___media_library_original_2000_1323.jpg 2000w" src="https://media.luxuri.com/127c8d72fbe707451c8d619e2df5bd0e/featured.jpg" width="2000" height="1323" alt="featured.jpg">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/why-villas-are-the-best-way-to-travel-with-friends.html">
                Luxury Group Getaways: Why Villas Are the Best Way to Travel with Friends
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                February 19, 2025
            </div>
            </div>
</article>
                </div>
                            <div class="wow fadeInUp" data-wow-delay="350ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/responsive-images/featured___media_library_original_320_213.jpg 320w, https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/responsive-images/featured___media_library_original_375_250.jpg 375w, https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/responsive-images/featured___media_library_original_400_267.jpg 400w, https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/responsive-images/featured___media_library_original_414_276.jpg 414w, https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/responsive-images/featured___media_library_original_640_427.jpg 640w, https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/responsive-images/featured___media_library_original_750_500.jpg 750w, https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/responsive-images/featured___media_library_original_800_534.jpg 800w, https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/responsive-images/featured___media_library_original_828_552.jpg 828w, https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/responsive-images/featured___media_library_original_1024_683.jpg 1024w, https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/responsive-images/featured___media_library_original_1200_800.jpg 1200w, https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/responsive-images/featured___media_library_original_1280_854.jpg 1280w, https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/responsive-images/featured___media_library_original_1440_960.jpg 1440w, https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/responsive-images/featured___media_library_original_1600_1067.jpg 1600w" src="https://media.luxuri.com/46004ae0d2c4a3a017244fef44da3b7b/featured.jpg" width="1600" height="1067" alt="featured.jpg">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/ultimate-guide-to-miami-music-week-2025.html">
                Your Ultimate Guide to Miami Music Week 2025: Where to Stay, What to Do, and Where to Party
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                January 24, 2025
            </div>
            </div>
</article>
                </div>
                            <div class="wow fadeInUp" data-wow-delay="400ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_320_213.jpg 320w, https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_375_250.jpg 375w, https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_414_276.jpg 414w, https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_500_334.jpg 500w, https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_640_427.jpg 640w, https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_750_500.jpg 750w, https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_828_552.jpg 828w, https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_1000_667.jpg 1000w, https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_1024_683.jpg 1024w, https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_1280_854.jpg 1280w, https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_1440_960.jpg 1440w, https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_1500_1001.jpg 1500w, https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_1920_1281.jpg 1920w, https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/responsive-images/featured___media_library_original_2000_1334.jpg 2000w" src="https://media.luxuri.com/92b86c6938f6139ef636f8a73cd34522/featured.jpg" width="2000" height="1334" alt="featured.jpg">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/family-friendly-luxury-miami-villas-perfect-for-all-ages.html">
                Family-Friendly Luxury: Miami Villas Perfect for All Ages
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                January 15, 2025
            </div>
            </div>
</article>
                </div>
                            <div class="wow fadeInUp" data-wow-delay="450ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy" src="https://media.luxuri.com/a948504ff5d5657adef1c449438e802b/private-jet.jpg" alt="private jet.jpg">
    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/the-ultimate-gift-guide-for-jet-setters-must-have-travel-essentials.html">
                The Ultimate Gift Guide for Jet-Setters: Must-Have Travel Essentials
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                December 3, 2024
            </div>
            </div>
</article>
                </div>
                            <div class="wow fadeInUp" data-wow-delay="500ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/a798dcca0d77eec43320459b6b4936a8/responsive-images/featured___media_library_original_2000_1333.jpg 2000w, https://media.luxuri.com/a798dcca0d77eec43320459b6b4936a8/responsive-images/featured___media_library_original_1673_1115.jpg 1673w, https://media.luxuri.com/a798dcca0d77eec43320459b6b4936a8/responsive-images/featured___media_library_original_1400_933.jpg 1400w, https://media.luxuri.com/a798dcca0d77eec43320459b6b4936a8/responsive-images/featured___media_library_original_1171_780.jpg 1171w, https://media.luxuri.com/a798dcca0d77eec43320459b6b4936a8/responsive-images/featured___media_library_original_979_653.jpg 979w, https://media.luxuri.com/a798dcca0d77eec43320459b6b4936a8/responsive-images/featured___media_library_original_819_546.jpg 819w, https://media.luxuri.com/a798dcca0d77eec43320459b6b4936a8/responsive-images/featured___media_library_original_685_457.jpg 685w, https://media.luxuri.com/a798dcca0d77eec43320459b6b4936a8/responsive-images/featured___media_library_original_573_382.jpg 573w, https://media.luxuri.com/a798dcca0d77eec43320459b6b4936a8/responsive-images/featured___media_library_original_480_320.jpg 480w, https://media.luxuri.com/a798dcca0d77eec43320459b6b4936a8/responsive-images/featured___media_library_original_401_267.jpg 401w, https://media.luxuri.com/a798dcca0d77eec43320459b6b4936a8/responsive-images/featured___media_library_original_336_224.jpg 336w" src="https://media.luxuri.com/a798dcca0d77eec43320459b6b4936a8/featured.jpg" width="2000" height="1333" alt="featured.jpg">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/celebrate-the-holidays-in-miami-style.html">
                Celebrate the Holidays in Miami Style
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                November 20, 2024
            </div>
            </div>
</article>
                </div>
                            <div class="wow fadeInUp" data-wow-delay="550ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_320_214.jpg 320w, https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_375_250.jpg 375w, https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_414_276.jpg 414w, https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_500_334.jpg 500w, https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_640_427.jpg 640w, https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_750_501.jpg 750w, https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_828_553.jpg 828w, https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_1000_668.jpg 1000w, https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_1024_684.jpg 1024w, https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_1280_854.jpg 1280w, https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_1440_961.jpg 1440w, https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_1500_1001.jpg 1500w, https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_1920_1282.jpg 1920w, https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/responsive-images/featured___media_library_original_2000_1335.jpg 2000w" src="https://media.luxuri.com/be2854b6158a50150a6a663d6276c3eb/featured.jpg" width="2000" height="1335" alt="featured.jpg">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/miami-luxuri-villa-adventure.html">
                Guest Review: Living the Luxe Life in Miami with Villas, Yachts, and Spa Bliss by Luxuri
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                October 15, 2024
            </div>
            </div>
</article>
                </div>
                            <div class="wow fadeInUp" data-wow-delay="600ms">
                    <article class="relative group  puffIn text-sm">
            <div class="mb-4">
            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-6/7 aspect-[4/3]" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_320_213.jpg 320w, https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_375_250.jpg 375w, https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_414_276.jpg 414w, https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_620_414.jpg 620w, https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_640_427.jpg 640w, https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_750_500.jpg 750w, https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_828_552.jpg 828w, https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_1024_683.jpg 1024w, https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_1240_827.jpg 1240w, https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_1280_854.jpg 1280w, https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_1440_960.jpg 1440w, https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_1860_1241.jpg 1860w, https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_1920_1281.jpg 1920w, https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/responsive-images/featured___media_library_original_2048_1366.jpg 2048w" src="https://media.luxuri.com/fe56abd54143eacbf8a315ac96b64497/featured.jpg" width="2048" height="1366" alt="featured.jpg">

    </div>
        </div>
    
    <div class="flex-1">
        <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                    <a class="" href="blog/get-inspired-at-art-basel-miami-beach.html">
                Get Inspired at Art Basel Miami Beach
                <div class="absolute inset-0"></div>
            </a>
            </h3>
    
</div>

        
                    <div class="text-zinc-400 mt-3 text-xs">
                September 25, 2024
            </div>
            </div>
</article>
                </div>
        </div>
</div>

@endsection
