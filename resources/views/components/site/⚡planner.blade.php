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

<div class="relative z-50 w-full max-w-2xl mx-auto text-center">
    <a href="https://luxteria.co/villas"
       class="inline-flex items-center justify-center rounded-full border border-zinc-900 bg-zinc-900 px-8 py-3 text-sm font-semibold text-white shadow-sm transition-all hover:bg-black hover:border-black tracking-[0.12em] uppercase">
        View All Villas
    </a>
</div>