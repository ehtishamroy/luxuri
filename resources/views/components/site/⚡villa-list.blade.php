<?php

use App\Models\Destination;
use App\Models\Villa;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

new class extends Component {
    use WithPagination;

    #[Url(as: 'destination', except: '')]
    public string $destination = '';

    #[Url(as: 'bedrooms', except: '')]
    public string $bedrooms = '';

    #[Url(as: 'guests', except: '')]
    public string $guests = '';

    #[Url(as: 'sort', except: '')]
    public string $sort = '';

    #[Url(as: 'search', except: '')]
    public string $search = '';

    public function updatedDestination(): void { $this->resetPage(); }
    public function updatedBedrooms(): void    { $this->resetPage(); }
    public function updatedGuests(): void      { $this->resetPage(); }
    public function updatedSort(): void        { $this->resetPage(); }
    public function updatedSearch(): void      { $this->resetPage(); }

    public function with(): array
    {
        $query = Villa::query()->where('active', true)->with('destination');

        if ($this->destination) {
            $query->whereHas('destination', fn($q) => $q->where('slug', $this->destination));
        }
        if ($this->bedrooms) {
            $query->where('bedrooms', '>=', (int) $this->bedrooms);
        }
        if ($this->guests) {
            $query->where('max_guests', '>=', (int) $this->guests);
        }
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%');
            });
        }

        $query->orderBy(match($this->sort) {
            'price_asc'  => 'price_per_night',
            'price_desc' => 'price_per_night',
            'title'      => 'title',
            default      => 'created_at',
        }, match($this->sort) {
            'price_desc' => 'desc',
            'title'      => 'asc',
            default      => 'desc',
        });

        return [
            'villas'       => $query->paginate(12),
            'destinations' => cache()->remember('destinations.active', 3600,
                fn () => Destination::where('active', true)->orderBy('sort_order')->get()
            ),
        ];
    }
};
?>

<div>
    <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 space-y-6">

        {{-- Filters --}}
        <div class="flex flex-wrap gap-4 mb-8">
            <input
                wire:model.live.debounce.400ms="search"
                type="text"
                placeholder="Search villas..."
                class="px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent"
            />

            <select wire:model.live="destination" class="px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                <option value="">All Destinations</option>
                @foreach($destinations as $dest)
                    <option value="{{ $dest->slug }}">{{ $dest->name }}</option>
                @endforeach
            </select>

            <select wire:model.live="bedrooms" class="px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                <option value="">Any Bedrooms</option>
                @foreach([1,2,3,4,5,6,7,8] as $n)
                    <option value="{{ $n }}">{{ $n }}+ Bedrooms</option>
                @endforeach
            </select>

            <select wire:model.live="guests" class="px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                <option value="">Any Guests</option>
                @foreach([2,4,6,8,10,12,14,16] as $n)
                    <option value="{{ $n }}">{{ $n }}+ Guests</option>
                @endforeach
            </select>

            <select wire:model.live="sort" class="px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                <option value="">Sort By</option>
                <option value="price_asc">Price: Low to High</option>
                <option value="price_desc">Price: High to Low</option>
                <option value="title">Name: A-Z</option>
            </select>
        </div>

        {{-- Grid --}}
        @if($villas->isEmpty())
            <div class="text-center py-20 text-zinc-400">
                <p class="text-lg">No villas found matching your criteria.</p>
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6" wire:loading.class="opacity-50">
                @foreach($villas as $villa)
                    <div wire:key="villa-{{ $villa->id }}">
                        <article class="relative text-sm group rounded-xl">
                            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7">
                                @if($villa->first_image)
                                    <img
                                        class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110"
                                        loading="lazy"
                                        src="{{ $villa->first_image }}"
                                        alt="{{ $villa->title }}"
                                    />
                                @else
                                    <div class="size-full bg-zinc-800 rounded-lg"></div>
                                @endif
                                @if($villa->featured)
                                    <span class="absolute top-3 left-3 bg-amber-400 text-black text-xs font-semibold px-2 py-0.5 rounded">Featured</span>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200 grow">
                                    <a href="{{ url('/villas/' . $villa->slug) }}">{{ $villa->title }}</a>
                                </h3>
                            </div>
                            @if($villa->destination)
                                <p class="text-zinc-400 text-xs mt-0.5">{{ $villa->destination->name }}, {{ $villa->destination->country }}</p>
                            @endif
                            <div class="flex gap-3 text-zinc-300 text-xs mt-1">
                                <span>{{ $villa->bedrooms }} bed</span>
                                <span>{{ $villa->bathrooms }} bath</span>
                                <span>Up to {{ $villa->max_guests }} guests</span>
                            </div>
                            @if($villa->price_per_night)
                                <p class="text-zinc-200 text-sm mt-1">From ${{ number_format($villa->price_per_night) }}<span class="text-zinc-400">/night</span></p>
                            @endif
                        </article>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $villas->links() }}
            </div>
        @endif
    </div>
</div>