<?php

use App\Models\Destination;
use Livewire\Component;
use Livewire\Attributes\Url;

new class extends Component {

    #[Url(as: 'destination', except: '')]
    public string $search           = '';
    public bool   $showDestinations = false;
    public bool   $showDatepicker   = false;
    #[Url(as: 'date_from', except: '')]
    public string $dateFromYmd      = '';
    #[Url(as: 'date_to', except: '')]
    public string $dateToYmd        = '';
    public bool   $plannerVisible   = true;
    public string $selectingDate    = 'from';
    #[Url(except: 2)]
    public int    $guests           = 2;

    public function setDestination(string $slug): void
    {
        $this->search           = $slug;
        $this->showDestinations = false;
        $this->dispatch('focus-search-input');
    }

    public function openDatePicker(string $mode): void
    {
        $this->selectingDate    = $mode;
        $this->showDatepicker   = true;
        $this->showDestinations = false;
    }

    public function handleSearch(): void
    {
        $params = array_filter([
            'destination' => $this->search,
            'date_from'   => $this->dateFromYmd,
            'date_to'     => $this->dateToYmd,
            'guests'      => $this->guests > 1 ? $this->guests : null,
        ]);

        $this->redirect(url('/villas') . '?' . http_build_query($params));
    }

    public function clearDates(): void
    {
        $this->dateFromYmd    = '';
        $this->dateToYmd      = '';
        $this->selectingDate  = 'from';
        $this->showDatepicker = false;
    }

    public function with(): array
    {
        $all = cache()->remember('destinations.active', 3600,
            fn () => Destination::where('active', true)->orderBy('sort_order')->get()
        );

        $searchResults = $this->search
            ? $all->filter(fn ($d) => str_contains(
                strtolower($d->name . ' ' . $d->slug), strtolower($this->search)
              ))->values()
            : collect();

        $searchSlugs      = $searchResults->pluck('slug');
        $otherDestinations = $all->reject(fn ($d) => $searchSlugs->contains($d->slug))->values();

        return [
            'searchResults'     => $searchResults,
            'otherDestinations' => $otherDestinations,
        ];
    }
};
?>

<div class="relative z-50 w-full max-w-2xl mx-auto"
     x-data="{
         capturedHeight: 0,
         isMobile: window.innerWidth < 768,
         mobileCompactHeight: 92
     }"
     x-intersect:enter="$wire.plannerVisible = true"
     x-intersect:leave="
         capturedHeight = isMobile ? mobileCompactHeight : ($refs.formContent?.offsetHeight || 0);
         $wire.plannerVisible = false
     "
     @resize.window="isMobile = window.innerWidth < 768">

    {{-- Placeholder to maintain space in document flow --}}
    <div class="w-full"
         :class="!$wire.plannerVisible && capturedHeight === 0 ? 'min-h-[92px] md:min-h-[120px]' : ''"
         :style="!$wire.plannerVisible && capturedHeight > 0 ? 'height: ' + capturedHeight + 'px' : ''"></div>

    {{-- Actual form content --}}
    <form x-ref="formContent"
          :class="{
              'fixed bottom-0 lg:bottom-4 left-1/2 -translate-x-1/2 w-full max-w-2xl': !$wire.plannerVisible,
              'relative': $wire.plannerVisible
          }"
          x-data="planner"
          @keydown.escape="$wire.showDestinations = false; $wire.showDatepicker = false"
          @click.outside="$wire.showDestinations = false; $wire.showDatepicker = false"
          class="relative">
        <div class="transition-transform duration-500 ease-out"
             :class="!$wire.plannerVisible ? (hasBeenFixed ? 'translate-y-0' : 'translate-y-full') : ''">

            <div :class="hasBeenFixed ? '' : 'max-md:min-h-64'">
                <div class="w-full max-w-2xl p-5 bg-black/70 border border-zinc-50/90 backdrop-blur-[2px] rounded-xl"
                     x-on:click.outside="showPlannerFields = false">

                    {{-- Desktop layout --}}
                    <div class="hidden md:flex gap-4">
                        <div class="divide-x divide-zinc-200/80 grid grid-cols-15 max-md:grid-cols-5 gap-y-2">
                            <div class="col-span-4 md:pe-4 text-left max-md:col-span-5 max-md:border-e-0 max-md:border-b">
                                <label class="font-medium text-sm max-sm:text-xs">Where
                                    <input wire:model.live="search" type="text"
                                           @click="$wire.showDestinations = true; $wire.showDatepicker = false"
                                           x-model="$wire.search"
                                           x-ref="searchInput"
                                           placeholder="Location"
                                           class="text-zinc-300 py-1 truncate text-sm max-sm:text-xs focus:outline-none border-1 border-transparent max-w-full w-full block focus-within:border-b-zinc-50">
                                </label>
                            </div>
                            <div class="col-span-4 pe-2 md:px-4 text-left max-md:col-span-2">
                                <label class="font-medium text-sm max-sm:text-xs">Check in
                                    <input type="text"
                                           @click="openDatePicker('from')"
                                           x-model="outputDateFromValue"
                                           :class="{'border-b-zinc-50': selectingDate == 'from'}"
                                           placeholder="Select date"
                                           class="text-zinc-300 py-1 truncate text-sm max-sm:text-xs focus:outline-none border-1 border-transparent block max-w-full w-full focus-within:border-b-zinc-50 border-b-zinc-50">
                                </label>
                            </div>
                            <div class="col-span-4 px-2 md:px-4 text-left max-md:col-span-2">
                                <label class="font-medium text-sm max-sm:text-xs">Check out
                                    <input type="text"
                                           @click="openDatePicker('to')"
                                           x-model="outputDateToValue"
                                           :class="{'border-b-zinc-50': selectingDate == 'to'}"
                                           placeholder="Select date"
                                           class="text-zinc-300 py-1 truncate text-sm max-sm:text-xs focus:outline-none border-1 border-transparent block max-w-full w-full focus-within:border-b-zinc-50">
                                </label>
                            </div>
                            <div class="col-span-3 ps-2 md:px-4 text-left max-md:col-span-1">
                                <label class="font-medium text-sm max-sm:text-xs">Guests
                                    <input type="number"
                                           @click="$wire.showDatepicker = false; $wire.showDestinations = false"
                                           x-model="guests"
                                           placeholder="2"
                                           class="text-zinc-300 py-1 truncate text-sm max-sm:text-xs focus:outline-none border-1 border-transparent block max-w-full w-full focus-within:border-b-zinc-50">
                                </label>
                            </div>
                        </div>
                        <div class="shrink-0 flex gap-2">
                            @if(false) {{-- close button only shown on mobile --}}
                            <button type="button"
                                    class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 md:hidden max-sm:text-xs max-sm:py-2"
                                    @click="showPlannerFields = false">Close</button>
                            @endif
                            <button type="button"
                                    class="rounded-md bg-zinc-50 px-2.5 py-1.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 md:size-12 max-md:w-full max-sm:text-xs max-sm:py-2"
                                    wire:click="handleSearch">
                                <i class="fa-sharp fa-solid fa-magnifying-glass max-md:me-1"></i>
                                <span class="md:hidden">Search</span>
                            </button>
                        </div>
                    </div>

                    {{-- Mobile expanded fields --}}
                    <div class="md:hidden transition-all duration-300 ease-in-out overflow-hidden max-h-0 opacity-0"
                         :class="{
                             'max-h-96': showPlannerFields,
                             'max-h-0': !showPlannerFields,
                             'opacity-100': showPlannerFields,
                             'opacity-0': !showPlannerFields
                         }">
                        <div class="flex flex-col gap-4">
                            <div class="divide-x divide-zinc-200/80 grid grid-cols-5 gap-y-2">
                                <div class="col-span-5 border-b border-e-0">
                                    <label class="font-medium text-sm max-sm:text-xs">Where
                                        <input wire:model.live="search" type="text"
                                               @click="$wire.showDestinations = true; $wire.showDatepicker = false"
                                               x-model="$wire.search"
                                               x-ref="searchInput"
                                               placeholder="Location"
                                               class="text-zinc-300 py-1 truncate text-base focus:outline-none border-1 border-transparent max-w-full w-full block focus-within:border-b-zinc-50">
                                    </label>
                                </div>
                                <div class="col-span-2 pe-2">
                                    <label class="font-medium text-sm max-sm:text-xs">Check in
                                        <input type="text"
                                               @click="openDatePicker('from')"
                                               x-model="outputDateFromValue"
                                               :class="{'border-b-zinc-50': selectingDate == 'from'}"
                                               placeholder="Select date"
                                               readonly
                                               class="text-zinc-300 py-1 truncate text-base focus:outline-none border-1 border-transparent block max-w-full w-full focus-within:border-b-zinc-50 border-b-zinc-50">
                                    </label>
                                </div>
                                <div class="col-span-2 px-2">
                                    <label class="font-medium text-sm max-sm:text-xs">Check out
                                        <input type="text"
                                               @click="openDatePicker('to')"
                                               x-model="outputDateToValue"
                                               :class="{'border-b-zinc-50': selectingDate == 'to'}"
                                               placeholder="Select date"
                                               readonly
                                               class="text-zinc-300 py-1 truncate text-base focus:outline-none border-1 border-transparent block max-w-full w-full focus-within:border-b-zinc-50">
                                    </label>
                                </div>
                                <div class="col-span-1 ps-2">
                                    <label class="font-medium text-sm max-sm:text-xs">Guests
                                        <input type="number"
                                               @click="$wire.showDatepicker = false; $wire.showDestinations = false"
                                               x-model="guests"
                                               placeholder="2"
                                               class="text-zinc-300 py-1 truncate text-base focus:outline-none border-1 border-transparent block max-w-full w-full focus-within:border-b-zinc-50">
                                    </label>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button type="button"
                                        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 max-sm:py-2"
                                        @click="showPlannerFields = false">Close</button>
                                <button type="button"
                                        class="rounded-md bg-zinc-50 px-2.5 py-1.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 w-full max-sm:py-2"
                                        wire:click="handleSearch">
                                    <i class="fa-sharp fa-solid fa-magnifying-glass me-1"></i>
                                    <span>Search</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Mobile compact view --}}
                    <div class="md:hidden w-full overflow-hidden"
                         x-show="!showPlannerFields"
                         x-transition:enter="transition-all ease-out duration-300"
                         x-transition:enter-start="opacity-0 max-h-0"
                         x-transition:enter-end="opacity-100 max-h-20"
                         x-transition:leave="transition-all ease-in duration-200"
                         x-transition:leave-start="opacity-100 max-h-20"
                         x-transition:leave-end="opacity-0 max-h-0">
                        <div class="flex gap-2 w-full" @click="showPlannerFields = true">
                            <div class="font-medium text-sm w-full">
                                <div class="flex gap-2 items-baseline">
                                    <div class="grow">Location</div>
                                    <div class="text-zinc-300 text-xs" x-text="outputDateFromValue ? new Date(outputDateFromValue).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) : ''"></div>
                                    -
                                    <div class="text-zinc-300 text-xs" x-text="outputDateToValue ? new Date(outputDateToValue).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) : ''"></div>
                                </div>
                                <div class="text-zinc-300 py-1 text-sm w-full" x-text="$wire.search || 'Locations...'">Destinations...</div>
                            </div>
                            <div class="shrink-0">
                                <button type="button"
                                        class="rounded-md bg-zinc-50 px-2.5 py-1.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 size-12"
                                        wire:click="handleSearch">
                                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Destinations dropdown --}}
            <div class="absolute left-1/2 z-10 mt-2 flex w-screen max-w-max -translate-x-1/2 px-4 max-md:bottom-full"
                 x-show="$wire.showDestinations"
                 x-transition:enter="transition ease-out duration-350"
                 :class="$wire.plannerVisible ? '' : 'bottom-full'"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-1"
                 style="display: none;">
                <div class="w-screen max-w-2xl flex-auto bg-black/90 border border-zinc-50/90 backdrop-blur-[2px] rounded-xl shadow-lg ring-1 ring-gray-900/5">
                    <div class="px-6 pt-6 pb-6 max-md:text-xs">
                        @if($searchResults->isNotEmpty())
                        <div class="mb-6">
                            <div class="font-medium mb-3 text-zinc-50">Search Results</div>
                            <ul class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                @foreach($searchResults as $dest)
                                <li>
                                    <article class="relative text-sm group rounded-xl">
                                        @if($dest->hero_image)
                                        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-7/5 max-md:hidden" wire:ignore>
                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 "
                                                 loading="eager"
                                                 sizes="(max-width: 768px) 50vw, 300px"
                                                 src="{{ $dest->hero_image }}"
                                                 alt="{{ $dest->name }}">
                                        </div>
                                        @endif
                                        <div class="flex gap-2 mb-2">
                                            <h3 class="text-base font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                                                <button type="button" class="text-center w-full max-md:text-sm" wire:click="setDestination('{{ $dest->slug }}')">
                                                    {{ $dest->name }}
                                                    <div class="absolute inset-0"></div>
                                                </button>
                                            </h3>
                                        </div>
                                    </article>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if($otherDestinations->isNotEmpty())
                        <div>
                            <div class="font-medium mb-3 text-zinc-50">
                                {{ $searchResults->isNotEmpty() ? 'Explore other locations' : 'Locations' }}
                            </div>
                            <ul class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach($otherDestinations as $dest)
                                <li>
                                    <article class="relative text-sm group rounded-xl">
                                        @if($dest->hero_image)
                                        <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-7/5 max-md:hidden" wire:ignore>
                                            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 "
                                                 loading="eager"
                                                 sizes="(max-width: 768px) 50vw, 300px"
                                                 src="{{ $dest->hero_image }}"
                                                 alt="{{ $dest->name }}">
                                        </div>
                                        @endif
                                        <div class="flex gap-2 mb-2">
                                            <h3 class="text-base font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                                                <button type="button" class="text-center w-full max-md:text-sm" wire:click="setDestination('{{ $dest->slug }}')">
                                                    {{ $dest->name }}
                                                    <div class="absolute inset-0"></div>
                                                </button>
                                            </h3>
                                        </div>
                                    </article>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Datepicker dropdown --}}
            <div class="absolute left-1/2 z-10 mt-2 flex w-screen max-w-max -translate-x-1/2 px-4 max-md:bottom-full"
                 x-show="$wire.showDatepicker"
                 x-transition:enter="transition ease-out duration-350"
                 :class="$wire.plannerVisible ? '' : 'bottom-full'"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-1"
                 style="display: none;">
                <div class="w-screen max-w-2xl flex-auto bg-black/90 border border-zinc-50/90 backdrop-blur-[2px] rounded-xl shadow-lg ring-1 ring-gray-900/5">
                    <input type="hidden" name="date_from" wire:model="dateFromYmd" x-model="dateFromYmd">
                    <input type="hidden" name="date_to" wire:model="dateToYmd" x-model="dateToYmd">
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
                                            <div @click="getDateValue(date, false, 'first')"
                                                 @mouseover="getDateValue(date, true, 'first')"
                                                 @mouseleave="hoveredDate = null; tempDateFrom = null; tempDateTo = null"
                                                 x-text="date"
                                                 class="p-1.5 cursor-pointer text-center text-sm transition ease-in-out duration-100"
                                                 :class="{
                                                     'font-bold': isToday(date, 'first'),
                                                     'bg-white text-black rounded-l-md': isDateFrom(date, 'first'),
                                                     'bg-white text-black rounded-r-md': isDateTo(date, 'first'),
                                                     'bg-amber-100 text-black': isInRange(date, 'first'),
                                                     'ring-2 ring-amber-400': isHoveredDate(date, 'first')
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
                                            <div @click="getDateValue(date, false, 'second')"
                                                 @mouseover="getDateValue(date, true, 'second')"
                                                 @mouseleave="hoveredDate = null; tempDateFrom = null; tempDateTo = null"
                                                 x-text="date"
                                                 class="p-1.5 cursor-pointer text-center text-sm transition ease-in-out duration-100"
                                                 :class="{
                                                     'font-bold': isToday(date, 'second'),
                                                     'bg-white text-black rounded-l-md': isDateFrom(date, 'second'),
                                                     'bg-white text-black rounded-r-md': isDateTo(date, 'second'),
                                                     'bg-amber-100 text-black': isInRange(date, 'second'),
                                                     'ring-2 ring-amber-400': isHoveredDate(date, 'second')
                                                 }"></div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('alpine:init', () => {
                            Alpine.data('planner', () => ({
                                dateFromYmd: '',
                                dateToYmd: '',
                                selectingDate: 'from',
                                guests: 2,
                                hasBeenFixed: true,
                                showPlannerFields: false,
                                outputDateFromValue: '',
                                outputDateToValue: '',
                                dateFromValue: '',
                                dateToValue: '',
                                currentDate: null,
                                dateFrom: null,
                                dateTo: null,
                                tempDateFrom: null,
                                tempDateTo: null,
                                hoveredDate: null,
                                selecting: false,
                                month: '',
                                year: '',
                                secondMonth: '',
                                secondYear: '',
                                no_of_days: [],
                                blankdays: [],
                                secondNo_of_days: [],
                                secondBlankdays: [],
                                MONTH_NAMES: ['January','February','March','April','May','June','July','August','September','October','November','December'],
                                DAYS: ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'],
                                convertFromYmd(dateYmd) {
                                    return new Date(Number(dateYmd.substr(0,4)), Number(dateYmd.substr(5,2))-1, Number(dateYmd.substr(8,2)));
                                },
                                convertToYmd(d) {
                                    return d.getFullYear()+'-'+('0'+(d.getMonth()+1)).slice(-2)+'-'+('0'+d.getDate()).slice(-2);
                                },
                                init() {
                                    this.dateFromYmd = this.$wire.dateFromYmd || '';
                                    this.dateToYmd = this.$wire.dateToYmd || '';
                                    this.selectingDate = this.$wire.selectingDate || 'from';
                                    this.guests = this.$wire.guests || 2;
                                    this.syncDatesFromLivewire();
                                    this.currentDate = this.dateFrom || this.dateTo || new Date();
                                    this.month = this.currentDate.getMonth();
                                    this.year = this.currentDate.getFullYear();
                                    this.updateSecondMonth();
                                    this.getNoOfDays();
                                    this.setDateValues();
                                    this.outputDateValues();
                                    this.$wire.$watch('dateFromYmd', (value) => {
                                        if (!value) { this.dateFrom = null; this.dateFromYmd = ''; this.outputDateFromValue = ''; }
                                        else if (this.dateFrom?.toISOString().split('T')[0] !== value) {
                                            this.dateFromYmd = value;
                                            this.dateFrom = this.convertFromYmd(value);
                                            this.outputDateFromValue = this.dateFrom.toLocaleDateString('en-US', { month:'short', day:'numeric', year:'numeric' });
                                        }
                                    });
                                    this.$wire.$watch('dateToYmd', (value) => {
                                        if (!value) { this.dateTo = null; this.dateToYmd = ''; this.outputDateToValue = ''; }
                                        else if (this.dateTo?.toISOString().split('T')[0] !== value) {
                                            this.dateToYmd = value;
                                            this.dateTo = this.convertFromYmd(value);
                                            this.outputDateToValue = this.dateTo.toLocaleDateString('en-US', { month:'short', day:'numeric', year:'numeric' });
                                        }
                                    });
                                    this.$wire.$watch('selectingDate', (value) => { this.selectingDate = value; });
                                    Livewire.on('focus-search-input', () => {
                                        this.$nextTick(() => { if (this.$refs.searchInput) this.$refs.searchInput.focus(); });
                                    });
                                },
                                syncDatesFromLivewire() {
                                    this.dateFrom = this.dateFromYmd ? this.convertFromYmd(this.dateFromYmd) : null;
                                    this.dateTo = this.dateToYmd ? this.convertFromYmd(this.dateToYmd) : null;
                                },
                                openDatePicker(mode) {
                                    this.selecting = false; this.tempDateFrom = null; this.tempDateTo = null;
                                    this.$wire.openDatePicker(mode);
                                    let targetDate = (mode === 'from' && this.dateFrom) ? this.dateFrom : (mode === 'to' && this.dateTo) ? this.dateTo : new Date();
                                    if (this.month !== targetDate.getMonth() || this.year !== targetDate.getFullYear()) {
                                        this.month = targetDate.getMonth(); this.year = targetDate.getFullYear();
                                        this.updateSecondMonth(); this.getNoOfDays();
                                    }
                                },
                                updateSecondMonth() {
                                    if (this.month === 11) { this.secondMonth = 0; this.secondYear = this.year + 1; }
                                    else { this.secondMonth = this.month + 1; this.secondYear = this.year; }
                                },
                                previousMonth() {
                                    if (this.month === 0) { this.year--; this.month = 11; } else { this.month--; }
                                    this.updateSecondMonth(); this.getNoOfDays();
                                },
                                nextMonth() {
                                    if (this.secondMonth === 11) { this.secondYear++; this.secondMonth = 0; this.month = 0; this.year = this.secondYear; }
                                    else { this.secondMonth++; if (this.month === 11) { this.month = 0; this.year++; } else { this.month++; } }
                                    this.updateSecondMonth(); this.getNoOfDays();
                                },
                                isToday(date, mt) {
                                    const today = new Date(); const m = mt==='first'?this.month:this.secondMonth; const y = mt==='first'?this.year:this.secondYear;
                                    return today.toDateString() === new Date(y,m,date).toDateString();
                                },
                                isDateFrom(date, mt) {
                                    const m = mt==='first'?this.month:this.secondMonth; const y = mt==='first'?this.year:this.secondYear;
                                    const from = (this.selecting && this.tempDateFrom) ? this.tempDateFrom : this.dateFrom;
                                    return from ? new Date(y,m,date).getTime()===from.getTime() : false;
                                },
                                isDateTo(date, mt) {
                                    const m = mt==='first'?this.month:this.secondMonth; const y = mt==='first'?this.year:this.secondYear;
                                    const to = (this.selecting && this.tempDateTo) ? this.tempDateTo : this.dateTo;
                                    return to ? new Date(y,m,date).getTime()===to.getTime() : false;
                                },
                                isInRange(date, mt) {
                                    const m = mt==='first'?this.month:this.secondMonth; const y = mt==='first'?this.year:this.secondYear;
                                    const from = this.tempDateFrom||this.dateFrom; const to = this.tempDateTo||this.dateTo;
                                    if (!from||!to) return false;
                                    const d = new Date(y,m,date); const min = from<to?from:to; const max = from>to?from:to;
                                    return d>min && d<max;
                                },
                                isHoveredDate(date, mt) {
                                    if (!this.hoveredDate||!this.selecting) return false;
                                    const m = mt==='first'?this.month:this.secondMonth; const y = mt==='first'?this.year:this.secondYear;
                                    return new Date(y,m,date).getTime()===this.hoveredDate.getTime();
                                },
                                outputDateValues() {
                                    if (this.dateFrom) { this.outputDateFromValue = this.dateFrom.toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'}); this.dateFromYmd = this.convertToYmd(this.dateFrom); this.$wire.dateFromYmd = this.dateFromYmd; }
                                    if (this.dateTo) { this.outputDateToValue = this.dateTo.toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'}); this.dateToYmd = this.convertToYmd(this.dateTo); this.$wire.dateToYmd = this.dateToYmd; }
                                },
                                setDateValues() {
                                    if (this.dateFrom) this.dateFromValue = this.dateFrom.toDateString();
                                    if (this.dateTo) this.dateToValue = this.dateTo.toDateString();
                                },
                                getDateValue(date, temp, mt) {
                                    const m = mt==='first'?this.month:this.secondMonth; const y = mt==='first'?this.year:this.secondYear;
                                    let sel = new Date(y,m,date);
                                    if (temp) {
                                        if (this.selecting && this.selectingDate) {
                                            this.hoveredDate = sel;
                                            if (this.selectingDate==='from') { this.tempDateFrom = sel; this.tempDateTo = null; }
                                            else { this.tempDateTo = sel; this.tempDateFrom = this.dateFrom; }
                                        }
                                        return;
                                    }
                                    if (this.selectingDate==='from') {
                                        this.dateFrom = sel;
                                        if (!this.dateTo) this.dateTo = sel;
                                        else if (sel > this.dateTo) { this.selectingDate='to'; this.dateFrom=this.dateTo; this.dateTo=sel; }
                                        if (!this.selecting) { this.selectingDate='to'; this.selecting=true; }
                                        else { this.outputDateValues(); this.closeDatepicker(); }
                                    } else {
                                        this.dateTo = sel;
                                        if (!this.dateFrom) this.dateFrom = sel;
                                        else if (sel < this.dateFrom) { this.selectingDate='from'; this.dateTo=this.dateFrom; this.dateFrom=sel; }
                                        this.outputDateValues(); this.closeDatepicker();
                                    }
                                    this.setDateValues();
                                },
                                getNoOfDays() {
                                    let dim = new Date(this.year,this.month+1,0).getDate(); let dow = new Date(this.year,this.month).getDay();
                                    this.blankdays=[...Array(dow)].map((_,i)=>i+1); this.no_of_days=[...Array(dim)].map((_,i)=>i+1);
                                    let sdim = new Date(this.secondYear,this.secondMonth+1,0).getDate(); let sdow = new Date(this.secondYear,this.secondMonth).getDay();
                                    this.secondBlankdays=[...Array(sdow)].map((_,i)=>i+1); this.secondNo_of_days=[...Array(sdim)].map((_,i)=>i+1);
                                },
                                closeDatepicker() { this.selectingDate=''; this.$wire.showDatepicker=false; },
                                clearDates() {
                                    this.dateFrom=null; this.dateTo=null; this.dateFromValue=''; this.dateToValue='';
                                    this.outputDateFromValue=''; this.outputDateToValue=''; this.tempDateFrom=null; this.tempDateTo=null; this.selecting=false;
                                    this.$wire.clearDates();
                                },
                            }));
                        });
                    </script>
                </div>
            </div>

        </div>
    </form>
</div>