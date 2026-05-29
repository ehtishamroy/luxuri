<?php

use App\Models\Destination;
use Livewire\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'destinations' => cache()->remember('destinations.active', 3600,
                fn () => Destination::where('active', true)->orderBy('sort_order')->get()
            ),
        ];
    }
};
?>

<div>
    <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($destinations as $destination)
                <a href="{{ url('/destinations/' . $destination->slug) }}"
                   wire:key="dest-{{ $destination->id }}"
                   class="group relative overflow-hidden rounded-xl aspect-4/3 block">
                    @if($destination->hero_image)
                        <img
                            class="pointer-events-none size-full object-cover transition-all duration-500 group-hover:scale-110"
                            loading="lazy"
                            src="{{ $destination->hero_image }}"
                            alt="{{ $destination->name }}"
                        />
                    @else
                        <div class="size-full bg-zinc-800"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-white text-xl font-semibold uppercase tracking-wide transition-colors duration-300 group-hover:text-amber-200">
                            {{ $destination->name }}
                        </h3>
                        @if($destination->country)
                            <p class="text-zinc-300 text-sm">{{ $destination->country }}</p>
                        @endif
                        @php $villaCount = $destination->villas()->where('active', true)->count(); @endphp
                        @if($villaCount)
                            <p class="text-zinc-400 text-xs mt-1">{{ $villaCount }} {{ Str::plural('villa', $villaCount) }}</p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>