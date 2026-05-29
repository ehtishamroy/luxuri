<?php

use App\Models\MagazinePost;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

new class extends Component {
    use WithPagination;

    #[Url(as: 'category', except: '')]
    public string $category = '';

    public function updatedCategory(): void { $this->resetPage(); }

    public function with(): array
    {
        $query = MagazinePost::published()->latest('published_at');

        if ($this->category) {
            $query->where('category', $this->category);
        }

        $categories = MagazinePost::published()
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return [
            'posts'      => $query->paginate(12),
            'categories' => $categories,
        ];
    }
};
?>

<div>
    <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
        @if($categories->isNotEmpty())
            <div class="flex flex-wrap gap-3 mb-6">
                <button wire:click="$set('category', '')"
                        class="px-4 py-1.5 rounded-full text-sm border transition-colors {{ $category === '' ? 'bg-white text-black' : 'border-zinc-600 text-zinc-300 hover:border-white' }}">
                    All
                </button>
                @foreach($categories as $cat)
                    <button wire:click="$set('category', '{{ $cat }}')"
                            class="px-4 py-1.5 rounded-full text-sm border transition-colors {{ $category === $cat ? 'bg-white text-black' : 'border-zinc-600 text-zinc-300 hover:border-white' }}">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>
        @endif

        @if($posts->isEmpty())
            <div class="text-center py-20 text-zinc-400">
                <p class="text-lg">No articles found.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8" wire:loading.class="opacity-50">
                @foreach($posts as $post)
                    <div wire:key="post-{{ $post->id }}">
                        <article class="relative group text-sm">
                            @if($post->featured_image)
                                <div class="relative overflow-hidden rounded-lg w-full mb-3 aspect-video">
                                    <img class="pointer-events-none size-full object-cover transition-all duration-300 group-hover:scale-110"
                                         loading="lazy"
                                         src="{{ $post->featured_image }}"
                                         alt="{{ $post->title }}" />
                                </div>
                            @endif
                            @if($post->category)
                                <p class="text-amber-400 text-xs uppercase tracking-widest mb-1">{{ $post->category }}</p>
                            @endif
                            <h3 class="text-lg font-normal text-white transition-colors duration-300 group-hover:text-amber-200">
                                <a href="{{ url('/magazine/' . $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            @if($post->excerpt)
                                <p class="text-zinc-400 text-sm mt-1 line-clamp-2">{{ $post->excerpt }}</p>
                            @endif
                            <p class="text-zinc-500 text-xs mt-2">{{ $post->published_at?->format('M d, Y') }}</p>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">{{ $posts->links() }}</div>
        @endif
    </div>
</div>