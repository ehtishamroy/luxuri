@extends('layouts.app')
@section('content')
<div class="bg-black text-white relative">
    <div class="relative isolate pt-14 min-h-[40vh] flex items-center">
                <div class="absolute inset-0 -z-10 size-full object-cover bg-black/20 bg-blend-multiply"></div>
        <div
            class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-radial from-black/20 from-30% to-70% to-black/0">
            <div class="mx-auto py-18 max-w-5xl my-12">
            <div class="space-y-4 text-center">
                <h1 class="text-4xl lg:text-5xl font-light text-white text-shadow-lg">
                    Luxury Yacht Charters
                </h1>
                <p class="text-xl text-white/80 max-w-2xl mx-auto">
                    Discover unforgettable experiences aboard our exclusive yacht collection
                </p>
            </div>
        </div>
        </div>
    </div>
</div>

    
    <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="flex flex-wrap gap-4 mb-8">
            
            <select wire:model.live="make"
                    class="px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                <option value="">All Makes</option>
                <option value="pershing">Pershing</option>
                <option value="cruiser">Cruiser</option>
                <option value="princess">Princess</option>
                <option value="azimut">Azimut</option>
                <option value="mangusta">Mangusta</option>
            </select>

            
                <select wire:model.live="style"
                        class="px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                    <option value="">All Styles</option>
                    <option value="sports">Sports</option>
                    <option value="luxury">Luxury</option>
                    <option value="limo">Limo</option>
                    <option value="suv">SUV</option>
                    <option value="sprinter_limo">Sprinter Limo</option>
                    <option value="sprinter_van">Sprinter Van</option>
                    <option value="jeep">Jeep</option>
                    <option value="yacht">Yacht</option>
                    <option value="speedboat">Speedboat</option>
                    <option value="cruiser">Cruiser</option>
                </select>
            
                <select wire:model.live="length_range"
                        class="px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                    <option value="">All Lengths</option>
                    <option value="0-50">Under 50ft</option>
                    <option value="50-75">50ft - 75ft</option>
                    <option value="75-100">75ft - 100ft</option>
                    <option value="100-150">100ft - 150ft</option>
                    <option value="150-1000">Over 150ft</option>
                </select>
            
            <select wire:model.live="sort"
                    class="px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                <option value="">Sort By</option>
                <option value="-created_at">Newest First</option>
                <option value="daily_price">Price: Low to High</option>
                <option value="-daily_price">Price: High to Low</option>
                <option value="-total_feet">Length: Largest First</option>
                <option value="total_feet">Length: Smallest First</option>
                <option value="name">Name: A-Z</option>
                <option value="-name">Name: Z-A</option>
            </select>

            
        </div>

        
            <div class="grid sm:grid-cols-2  lg:grid-cols-4  gap-6">
                <div wire:key="yacht-8">
                        <article class="relative text-sm group rounded-xl">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/17ccdfdd796523a4c554f93ebaabb9d5/responsive-images/jpnggpfbg1d436cwzwov___media_library_original_1400_787.jpg 1400w, https://media.luxuri.com/17ccdfdd796523a4c554f93ebaabb9d5/responsive-images/jpnggpfbg1d436cwzwov___media_library_original_1171_658.jpg 1171w, https://media.luxuri.com/17ccdfdd796523a4c554f93ebaabb9d5/responsive-images/jpnggpfbg1d436cwzwov___media_library_original_980_551.jpg 980w, https://media.luxuri.com/17ccdfdd796523a4c554f93ebaabb9d5/responsive-images/jpnggpfbg1d436cwzwov___media_library_original_819_460.jpg 819w, https://media.luxuri.com/17ccdfdd796523a4c554f93ebaabb9d5/responsive-images/jpnggpfbg1d436cwzwov___media_library_original_685_385.jpg 685w, https://media.luxuri.com/17ccdfdd796523a4c554f93ebaabb9d5/responsive-images/jpnggpfbg1d436cwzwov___media_library_original_573_322.jpg 573w, https://media.luxuri.com/17ccdfdd796523a4c554f93ebaabb9d5/responsive-images/jpnggpfbg1d436cwzwov___media_library_original_480_270.jpg 480w, https://media.luxuri.com/17ccdfdd796523a4c554f93ebaabb9d5/responsive-images/jpnggpfbg1d436cwzwov___media_library_original_401_225.jpg 401w, https://media.luxuri.com/17ccdfdd796523a4c554f93ebaabb9d5/responsive-images/jpnggpfbg1d436cwzwov___media_library_original_336_189.jpg 336w" src="https://media.luxuri.com/17ccdfdd796523a4c554f93ebaabb9d5/jpnggpfbg1d436cwzwov.jpg" width="1400" height="787" alt="jpnggpfbg1d436cwzwov.jpg">

    </div>
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
        <a class="" href="yachts/108ft-mangusta.html">
                108ft Mangusta
                <div class="absolute inset-0"></div>
            </a>
    </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Miami, Florida</div>
    </div>
        <p class="">
                $1,875
                <span class="text-sm text-zinc-500">/hour</span>
        </p>
</article>
                    </div>
                                    <div wire:key="yacht-7">
                        <article class="relative text-sm group rounded-xl">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/094e7cd9f5792acbb1ad81f8a32eadec/responsive-images/v52z5tgcxvkaveiq7xhc___media_library_original_1400_786.jpg 1400w, https://media.luxuri.com/094e7cd9f5792acbb1ad81f8a32eadec/responsive-images/v52z5tgcxvkaveiq7xhc___media_library_original_1171_657.jpg 1171w, https://media.luxuri.com/094e7cd9f5792acbb1ad81f8a32eadec/responsive-images/v52z5tgcxvkaveiq7xhc___media_library_original_979_550.jpg 979w, https://media.luxuri.com/094e7cd9f5792acbb1ad81f8a32eadec/responsive-images/v52z5tgcxvkaveiq7xhc___media_library_original_819_460.jpg 819w, https://media.luxuri.com/094e7cd9f5792acbb1ad81f8a32eadec/responsive-images/v52z5tgcxvkaveiq7xhc___media_library_original_685_385.jpg 685w, https://media.luxuri.com/094e7cd9f5792acbb1ad81f8a32eadec/responsive-images/v52z5tgcxvkaveiq7xhc___media_library_original_573_322.jpg 573w, https://media.luxuri.com/094e7cd9f5792acbb1ad81f8a32eadec/responsive-images/v52z5tgcxvkaveiq7xhc___media_library_original_480_269.jpg 480w, https://media.luxuri.com/094e7cd9f5792acbb1ad81f8a32eadec/responsive-images/v52z5tgcxvkaveiq7xhc___media_library_original_401_225.jpg 401w, https://media.luxuri.com/094e7cd9f5792acbb1ad81f8a32eadec/responsive-images/v52z5tgcxvkaveiq7xhc___media_library_original_336_189.jpg 336w" src="https://media.luxuri.com/094e7cd9f5792acbb1ad81f8a32eadec/v52z5tgcxvkaveiq7xhc.jpg" width="1400" height="786" alt="v52z5tgcxvkaveiq7xhc.jpg">

    </div>
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
        <a class="" href="yachts/azimut-salt-shaker.html">
                Azimut &quot;Salt Shaker&quot;
                <div class="absolute inset-0"></div>
            </a>
    </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Miami, Florida</div>
    </div>
        <p class="">
                $1,050
                <span class="text-sm text-zinc-500">/hour</span>
        </p>
</article>
                    </div>
                                    <div wire:key="yacht-6">
                        <article class="relative text-sm group rounded-xl">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/7a2676aa16fddc9a0cc037a2c9e2d3b5/responsive-images/1___media_library_original_320_180.jpg 320w, https://media.luxuri.com/7a2676aa16fddc9a0cc037a2c9e2d3b5/responsive-images/1___media_library_original_375_211.jpg 375w, https://media.luxuri.com/7a2676aa16fddc9a0cc037a2c9e2d3b5/responsive-images/1___media_library_original_414_233.jpg 414w, https://media.luxuri.com/7a2676aa16fddc9a0cc037a2c9e2d3b5/responsive-images/1___media_library_original_480_270.jpg 480w, https://media.luxuri.com/7a2676aa16fddc9a0cc037a2c9e2d3b5/responsive-images/1___media_library_original_640_360.jpg 640w, https://media.luxuri.com/7a2676aa16fddc9a0cc037a2c9e2d3b5/responsive-images/1___media_library_original_750_421.jpg 750w, https://media.luxuri.com/7a2676aa16fddc9a0cc037a2c9e2d3b5/responsive-images/1___media_library_original_828_465.jpg 828w, https://media.luxuri.com/7a2676aa16fddc9a0cc037a2c9e2d3b5/responsive-images/1___media_library_original_960_540.jpg 960w, https://media.luxuri.com/7a2676aa16fddc9a0cc037a2c9e2d3b5/responsive-images/1___media_library_original_1024_575.jpg 1024w, https://media.luxuri.com/7a2676aa16fddc9a0cc037a2c9e2d3b5/responsive-images/1___media_library_original_1280_719.jpg 1280w, https://media.luxuri.com/7a2676aa16fddc9a0cc037a2c9e2d3b5/responsive-images/1___media_library_original_1440_809.jpg 1440w, https://media.luxuri.com/7a2676aa16fddc9a0cc037a2c9e2d3b5/responsive-images/1___media_library_original_1920_1079.jpg 1920w" src="https://media.luxuri.com/7a2676aa16fddc9a0cc037a2c9e2d3b5/1.jpg" width="1920" height="1079" alt="1.jpg">

    </div>
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
        <a class="" href="yachts/azimut-priceless.html">
                Azimut &quot;Priceless&quot;
                <div class="absolute inset-0"></div>
            </a>
    </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Miami, Florida</div>
    </div>
        <p class="">
                $980
                <span class="text-sm text-zinc-500">/hour</span>
        </p>
</article>
                    </div>
                                    <div wire:key="yacht-5">
                        <article class="relative text-sm group rounded-xl">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/d6864824fe6acfff7e86cca8c6e1b8cf/responsive-images/vqgbcwqz1neaipkf0dnm___media_library_original_1400_787.jpg 1400w, https://media.luxuri.com/d6864824fe6acfff7e86cca8c6e1b8cf/responsive-images/vqgbcwqz1neaipkf0dnm___media_library_original_1171_658.jpg 1171w, https://media.luxuri.com/d6864824fe6acfff7e86cca8c6e1b8cf/responsive-images/vqgbcwqz1neaipkf0dnm___media_library_original_980_551.jpg 980w, https://media.luxuri.com/d6864824fe6acfff7e86cca8c6e1b8cf/responsive-images/vqgbcwqz1neaipkf0dnm___media_library_original_819_460.jpg 819w, https://media.luxuri.com/d6864824fe6acfff7e86cca8c6e1b8cf/responsive-images/vqgbcwqz1neaipkf0dnm___media_library_original_686_386.jpg 686w, https://media.luxuri.com/d6864824fe6acfff7e86cca8c6e1b8cf/responsive-images/vqgbcwqz1neaipkf0dnm___media_library_original_573_322.jpg 573w, https://media.luxuri.com/d6864824fe6acfff7e86cca8c6e1b8cf/responsive-images/vqgbcwqz1neaipkf0dnm___media_library_original_480_270.jpg 480w, https://media.luxuri.com/d6864824fe6acfff7e86cca8c6e1b8cf/responsive-images/vqgbcwqz1neaipkf0dnm___media_library_original_401_225.jpg 401w, https://media.luxuri.com/d6864824fe6acfff7e86cca8c6e1b8cf/responsive-images/vqgbcwqz1neaipkf0dnm___media_library_original_336_189.jpg 336w" src="https://media.luxuri.com/d6864824fe6acfff7e86cca8c6e1b8cf/vqgbcwqz1neaipkf0dnm.jpg" width="1400" height="787" alt="vqgbcwqz1neaipkf0dnm.jpg">

    </div>
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
        <a class="" href="yachts/68ft-azimut.html">
                68ft Azimut
                <div class="absolute inset-0"></div>
            </a>
    </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Miami, Florida</div>
    </div>
        <p class="">
                $1,000
                <span class="text-sm text-zinc-500">/hour</span>
        </p>
</article>
                    </div>
                                    <div wire:key="yacht-4">
                        <article class="relative text-sm group rounded-xl">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/405a2ed2819c93487d9f7cf9196981aa/responsive-images/umpcfp6vtt4gjmr5rkql___media_library_original_1400_787.jpg 1400w, https://media.luxuri.com/405a2ed2819c93487d9f7cf9196981aa/responsive-images/umpcfp6vtt4gjmr5rkql___media_library_original_1171_658.jpg 1171w, https://media.luxuri.com/405a2ed2819c93487d9f7cf9196981aa/responsive-images/umpcfp6vtt4gjmr5rkql___media_library_original_979_550.jpg 979w, https://media.luxuri.com/405a2ed2819c93487d9f7cf9196981aa/responsive-images/umpcfp6vtt4gjmr5rkql___media_library_original_819_460.jpg 819w, https://media.luxuri.com/405a2ed2819c93487d9f7cf9196981aa/responsive-images/umpcfp6vtt4gjmr5rkql___media_library_original_685_385.jpg 685w, https://media.luxuri.com/405a2ed2819c93487d9f7cf9196981aa/responsive-images/umpcfp6vtt4gjmr5rkql___media_library_original_573_322.jpg 573w, https://media.luxuri.com/405a2ed2819c93487d9f7cf9196981aa/responsive-images/umpcfp6vtt4gjmr5rkql___media_library_original_480_270.jpg 480w, https://media.luxuri.com/405a2ed2819c93487d9f7cf9196981aa/responsive-images/umpcfp6vtt4gjmr5rkql___media_library_original_401_225.jpg 401w, https://media.luxuri.com/405a2ed2819c93487d9f7cf9196981aa/responsive-images/umpcfp6vtt4gjmr5rkql___media_library_original_336_189.jpg 336w" src="https://media.luxuri.com/405a2ed2819c93487d9f7cf9196981aa/umpcfp6vtt4gjmr5rkql.jpg" width="1400" height="787" alt="umpcfp6vtt4gjmr5rkql.jpg">

    </div>
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
        <a class="" href="yachts/72ft-azimut.html">
                72ft Azimut
                <div class="absolute inset-0"></div>
            </a>
    </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Miami, Florida</div>
    </div>
        <p class="">
                $1,200
                <span class="text-sm text-zinc-500">/hour</span>
        </p>
</article>
                    </div>
                                    <div wire:key="yacht-3">
                        <article class="relative text-sm group rounded-xl">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/880333d443d5d8859703efb318ae9514/responsive-images/kgh0g56on6szd16thmgv___media_library_original_1400_787.jpg 1400w, https://media.luxuri.com/880333d443d5d8859703efb318ae9514/responsive-images/kgh0g56on6szd16thmgv___media_library_original_1171_658.jpg 1171w, https://media.luxuri.com/880333d443d5d8859703efb318ae9514/responsive-images/kgh0g56on6szd16thmgv___media_library_original_980_551.jpg 980w, https://media.luxuri.com/880333d443d5d8859703efb318ae9514/responsive-images/kgh0g56on6szd16thmgv___media_library_original_819_460.jpg 819w, https://media.luxuri.com/880333d443d5d8859703efb318ae9514/responsive-images/kgh0g56on6szd16thmgv___media_library_original_686_386.jpg 686w, https://media.luxuri.com/880333d443d5d8859703efb318ae9514/responsive-images/kgh0g56on6szd16thmgv___media_library_original_573_322.jpg 573w, https://media.luxuri.com/880333d443d5d8859703efb318ae9514/responsive-images/kgh0g56on6szd16thmgv___media_library_original_480_270.jpg 480w, https://media.luxuri.com/880333d443d5d8859703efb318ae9514/responsive-images/kgh0g56on6szd16thmgv___media_library_original_401_225.jpg 401w" src="https://media.luxuri.com/880333d443d5d8859703efb318ae9514/kgh0g56on6szd16thmgv.jpg" width="1400" height="787" alt="kgh0g56on6szd16thmgv.jpg">

    </div>
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
        <a class="" href="yachts/princess-snowbird.html">
                Princess &quot;Snowbird&quot;
                <div class="absolute inset-0"></div>
            </a>
    </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Miami, Florida</div>
    </div>
        <p class="">
                $1,190
                <span class="text-sm text-zinc-500">/hour</span>
        </p>
</article>
                    </div>
                                    <div wire:key="yacht-2">
                        <article class="relative text-sm group rounded-xl">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/7cf66f77a53c54d0ca9ad12f92fbfd9d/responsive-images/lodderc8jpva0f9l832y___media_library_original_1400_787.jpg 1400w, https://media.luxuri.com/7cf66f77a53c54d0ca9ad12f92fbfd9d/responsive-images/lodderc8jpva0f9l832y___media_library_original_1171_658.jpg 1171w, https://media.luxuri.com/7cf66f77a53c54d0ca9ad12f92fbfd9d/responsive-images/lodderc8jpva0f9l832y___media_library_original_980_551.jpg 980w, https://media.luxuri.com/7cf66f77a53c54d0ca9ad12f92fbfd9d/responsive-images/lodderc8jpva0f9l832y___media_library_original_819_460.jpg 819w, https://media.luxuri.com/7cf66f77a53c54d0ca9ad12f92fbfd9d/responsive-images/lodderc8jpva0f9l832y___media_library_original_686_386.jpg 686w, https://media.luxuri.com/7cf66f77a53c54d0ca9ad12f92fbfd9d/responsive-images/lodderc8jpva0f9l832y___media_library_original_573_322.jpg 573w, https://media.luxuri.com/7cf66f77a53c54d0ca9ad12f92fbfd9d/responsive-images/lodderc8jpva0f9l832y___media_library_original_480_270.jpg 480w, https://media.luxuri.com/7cf66f77a53c54d0ca9ad12f92fbfd9d/responsive-images/lodderc8jpva0f9l832y___media_library_original_401_225.jpg 401w, https://media.luxuri.com/7cf66f77a53c54d0ca9ad12f92fbfd9d/responsive-images/lodderc8jpva0f9l832y___media_library_original_336_189.jpg 336w" src="https://media.luxuri.com/7cf66f77a53c54d0ca9ad12f92fbfd9d/lodderc8jpva0f9l832y.jpg" width="1400" height="787" alt="lodderc8jpva0f9l832y.jpg">

    </div>
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
        <a class="" href="yachts/59ft-cruiser-gtbme.html">
                59ft Cruiser GTBme
                <div class="absolute inset-0"></div>
            </a>
    </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Miami, Florida</div>
    </div>
        <p class="">
                $875
                <span class="text-sm text-zinc-500">/hour</span>
        </p>
</article>
                    </div>
                                    <div wire:key="yacht-1">
                        <article class="relative text-sm group rounded-xl">
    <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7" wire:ignore>
        <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110" loading="lazy"  srcset="https://media.luxuri.com/59a9a163223072800b9eb98d8c046672/responsive-images/g7tfk5cismxkj8x8erop___media_library_original_1400_787.jpg 1400w, https://media.luxuri.com/59a9a163223072800b9eb98d8c046672/responsive-images/g7tfk5cismxkj8x8erop___media_library_original_1171_658.jpg 1171w, https://media.luxuri.com/59a9a163223072800b9eb98d8c046672/responsive-images/g7tfk5cismxkj8x8erop___media_library_original_979_550.jpg 979w, https://media.luxuri.com/59a9a163223072800b9eb98d8c046672/responsive-images/g7tfk5cismxkj8x8erop___media_library_original_819_460.jpg 819w, https://media.luxuri.com/59a9a163223072800b9eb98d8c046672/responsive-images/g7tfk5cismxkj8x8erop___media_library_original_685_385.jpg 685w, https://media.luxuri.com/59a9a163223072800b9eb98d8c046672/responsive-images/g7tfk5cismxkj8x8erop___media_library_original_573_322.jpg 573w, https://media.luxuri.com/59a9a163223072800b9eb98d8c046672/responsive-images/g7tfk5cismxkj8x8erop___media_library_original_480_270.jpg 480w, https://media.luxuri.com/59a9a163223072800b9eb98d8c046672/responsive-images/g7tfk5cismxkj8x8erop___media_library_original_401_225.jpg 401w, https://media.luxuri.com/59a9a163223072800b9eb98d8c046672/responsive-images/g7tfk5cismxkj8x8erop___media_library_original_336_189.jpg 336w, https://media.luxuri.com/59a9a163223072800b9eb98d8c046672/responsive-images/g7tfk5cismxkj8x8erop___media_library_original_281_158.jpg 281w" src="https://media.luxuri.com/59a9a163223072800b9eb98d8c046672/g7tfk5cismxkj8x8erop.jpg" width="1400" height="787" alt="g7tfk5cismxkj8x8erop.jpg">

    </div>
    <div class="flex gap-2">
    <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
        <a class="" href="yachts/94ft-pershing.html">
                94ft Pershing
                <div class="absolute inset-0"></div>
            </a>
    </h3>
    
</div>
    <div class="text-zinc-200 flex justify-between gap-2">
        <div class="italic mb-2">Miami, Florida</div>
    </div>
        <p class="">
                $1,500
                <span class="text-sm text-zinc-500">/hour</span>
        </p>
</article>
                    </div>
        </div>
</div>

@endsection
