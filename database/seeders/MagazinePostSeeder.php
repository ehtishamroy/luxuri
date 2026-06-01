<?php

namespace Database\Seeders;

use App\Models\MagazinePost;
use Illuminate\Database\Seeder;

class MagazinePostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title'          => 'The Most Exclusive Villas in Aspen for Winter 2026',
                'slug'           => 'exclusive-villas-aspen-winter-2026',
                'excerpt'        => 'From ski-in ski-out chalets to mountain-top estates, discover the finest luxury villas Aspen has to offer this winter season.',
                'content'        => '<p>Aspen has long been the pinnacle of winter luxury travel. This season, the options for discerning travelers have never been more spectacular...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1551882547-ff40c4a49f6e?w=800',
                'category'       => 'Destinations',
                'author'         => 'Luxteria Editorial',
                'published_at'   => now()->subDays(5),
                'meta_title'     => 'Exclusive Aspen Villas for Winter 2026 | Luxteria Magazine',
                'meta_description' => 'Discover the most exclusive luxury villas in Aspen for the winter 2026 season.',
                'active'         => true,
            ],
            [
                'title'          => 'Yacht Charter 101: Everything You Need to Know',
                'slug'           => 'yacht-charter-guide',
                'excerpt'        => 'Planning your first luxury yacht charter? Our comprehensive guide covers everything from selecting the right vessel to understanding charter contracts.',
                'content'        => '<p>Chartering a private yacht is one of life\'s ultimate luxuries. Whether you are exploring the Caribbean or the Mediterranean, the experience promises unparalleled freedom and exclusivity...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1567899378494-47b22a2ae96a?w=800',
                'category'       => 'Yachts',
                'author'         => 'Captain James Reed',
                'published_at'   => now()->subDays(12),
                'meta_title'     => 'Yacht Charter Guide 101 | Luxteria Magazine',
                'meta_description' => 'Everything you need to know about planning a luxury yacht charter.',
                'active'         => true,
            ],
            [
                'title'          => 'Inside Bali\'s Most Breathtaking Private Villas',
                'slug'           => 'bali-private-villas',
                'excerpt'        => 'Bali continues to captivate luxury travelers with its stunning private villas, combining traditional Balinese architecture with world-class amenities.',
                'content'        => '<p>Nestled among terraced rice paddies and lush tropical gardens, Bali\'s private villa scene has evolved into one of the world\'s most celebrated luxury experiences...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?w=800',
                'category'       => 'Destinations',
                'author'         => 'Luxteria Editorial',
                'published_at'   => now()->subDays(18),
                'meta_title'     => 'Bali Private Villas | Luxteria Magazine',
                'meta_description' => 'Discover Bali\'s most breathtaking private luxury villas.',
                'active'         => true,
            ],
            [
                'title'          => 'Miami Luxury Living: A Guide to the Best Neighborhoods',
                'slug'           => 'miami-luxury-neighborhoods',
                'excerpt'        => 'From the Art Deco glamour of South Beach to the waterfront estates of Star Island, Miami offers some of North America\'s most coveted luxury addresses.',
                'content'        => '<p>Miami\'s luxury real estate landscape is as diverse as the city itself. Each neighborhood offers a distinct flavour of the good life...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1533106497176-45ae19e68ba2?w=800',
                'category'       => 'Lifestyle',
                'author'         => 'Sophia Martinez',
                'published_at'   => now()->subDays(25),
                'meta_title'     => 'Miami Luxury Neighborhoods Guide | Luxteria Magazine',
                'meta_description' => 'A guide to Miami\'s best luxury neighborhoods for your next villa rental.',
                'active'         => true,
            ],
            [
                'title'          => 'The Art of the Perfect Concierge Experience',
                'slug'           => 'perfect-concierge-experience',
                'excerpt'        => 'What separates an ordinary stay from an extraordinary one? We explore how world-class concierge services elevate luxury travel to an art form.',
                'content'        => '<p>True luxury is not just about the property you stay in — it is about the entire experience curated around you. The finest concierge services anticipate your needs before you even articulate them...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800',
                'category'       => 'Lifestyle',
                'author'         => 'Luxteria Editorial',
                'published_at'   => now()->subDays(32),
                'meta_title'     => 'The Perfect Concierge Experience | Luxteria Magazine',
                'meta_description' => 'How world-class concierge services elevate luxury travel.',
                'active'         => true,
            ],
            [
                'title'          => 'Costa Rica: Luxury Eco-Tourism Done Right',
                'slug'           => 'costa-rica-luxury-eco-tourism',
                'excerpt'        => 'Costa Rica proves that sustainability and luxury are not mutually exclusive. Discover how the country is setting a new standard for eco-luxury travel.',
                'content'        => '<p>Pura Vida — the pure life — is not just a saying in Costa Rica. It is a philosophy that has shaped the country\'s approach to everything, including luxury travel...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1518729371765-043a98034e45?w=800',
                'category'       => 'Destinations',
                'author'         => 'Elena Rodriguez',
                'published_at'   => now()->subDays(40),
                'meta_title'     => 'Costa Rica Luxury Eco-Tourism | Luxteria Magazine',
                'meta_description' => 'Discover Costa Rica\'s world-class eco-luxury travel experiences.',
                'active'         => true,
            ],
        ];

        foreach ($posts as $post) {
            MagazinePost::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
