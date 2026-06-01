<?php

use App\Models\Yacht;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

new class extends Component {
    use WithPagination;

    #[Url(as: 'make', except: '')]
    public string $make = '';

    #[Url(as: 'style', except: '')]
    public string $style = '';

    #[Url(as: 'length_range', except: '')]
    public string $length_range = '';

    #[Url(as: 'sort', except: '')]
    public string $sort = '-created_at';

    public function updatedMake(): void        { $this->resetPage(); }
    public function updatedStyle(): void       { $this->resetPage(); }
    public function updatedLengthRange(): void { $this->resetPage(); }
    public function updatedSort(): void        { $this->resetPage(); }

    public function with(): array
    {
        $query = Yacht::query()->where('active', true);

        if ($this->make)  { $query->where('make', $this->make); }
        if ($this->style) { $query->where('style', $this->style); }

        if ($this->length_range) {
            [$min, $max] = explode('-', $this->length_range);
            $query->whereBetween('length_ft', [(int)$min, (int)$max]);
        }

        [$col, $dir] = match($this->sort) {
            'price_per_day'  => ['price_per_day', 'asc'],
            '-price_per_day' => ['price_per_day', 'desc'],
            'length_ft'      => ['length_ft', 'asc'],
            '-length_ft'     => ['length_ft', 'desc'],
            'title'          => ['title', 'asc'],
            '-title'         => ['title', 'desc'],
            default          => ['created_at', 'desc'],
        };
        $query->orderBy($col, $dir);

        return [
            'yachts' => $query->paginate(12),
            'makes'  => Yacht::where('active', true)->whereNotNull('make')->distinct()->pluck('make'),
            'styles' => Yacht::where('active', true)->whereNotNull('style')->distinct()->pluck('style'),
        ];
    }
};
?>

<div>
    <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
        <div class="flex flex-wrap gap-4 mb-8">
            <select wire:model.live="make" class="px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                <option value="">All Makes</option>
                @foreach($makes as $m)
                    <option value="{{ $m }}">{{ $m }}</option>
                @endforeach
            </select>

            <select wire:model.live="style" class="px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                <option value="">All Styles</option>
                @foreach($styles as $s)
                    <option value="{{ $s }}">{{ $s }}</option>
                @endforeach
            </select>

            <select wire:model.live="length_range" class="px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                <option value="">All Lengths</option>
                <option value="0-50">Under 50ft</option>
                <option value="50-75">50ft - 75ft</option>
                <option value="75-100">75ft - 100ft</option>
                <option value="100-150">100ft - 150ft</option>
                <option value="150-1000">Over 150ft</option>
            </select>

            <select wire:model.live="sort" class="px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                <option value="-created_at">Newest First</option>
                <option value="price_per_day">Price: Low to High</option>
                <option value="-price_per_day">Price: High to Low</option>
                <option value="-length_ft">Length: Largest First</option>
                <option value="length_ft">Length: Smallest First</option>
                <option value="title">Name: A-Z</option>
                <option value="-title">Name: Z-A</option>
            </select>
        </div>

        @if($yachts->isEmpty())
            <div class="text-center py-20 text-zinc-400">
                <p class="text-lg">No yachts found matching your criteria.</p>
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6" wire:loading.class="opacity-50">
                @foreach($yachts as $yacht)
                    <div wire:key="yacht-{{ $yacht->id }}">
                        <article class="relative text-sm group rounded-xl">
                            <div class="relative overflow-hidden rounded-lg w-full mb-2 aspect-10/7">
                                @if($yacht->first_image)
                                    <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 "
                                         loading="lazy" src="{{ $yacht->first_image }}" alt="{{ $yacht->title }}" />
                                @else
                                    <div class="size-full bg-zinc-800 rounded-lg"></div>
                                @endif
                            </div>
                            <h3 class="text-lg font-normal uppercase transition-colors duration-300 group-hover:text-amber-200">
                                <a href="{{ url('/yachts/' . $yacht->slug) }}">{{ $yacht->title }}</a>
                            </h3>
                            <div class="flex flex-wrap gap-2 text-zinc-400 text-xs mt-1">
                                @if($yacht->make)      <span>{{ $yacht->make }}</span> @endif
                                @if($yacht->length_ft) <span>{{ $yacht->length_ft }}ft</span> @endif
                                @if($yacht->cabins)    <span>{{ $yacht->cabins }} cabins</span> @endif
                            </div>
                            @if($yacht->price_per_day)
                                <p class="text-zinc-200 text-sm mt-1">From ${{ number_format($yacht->price_per_day) }}<span class="text-zinc-400">/day</span></p>
                            @endif
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">{{ $yachts->links() }}</div>
        @endif
    </div>
</div>