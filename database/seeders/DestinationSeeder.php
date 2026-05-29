<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'name'             => 'Aspen',
                'slug'             => 'aspen',
                'country'          => 'USA',
                'description'      => 'Discover our luxury vacation homes in Aspen. Ski-in/ski-out access and stunning mountain views await.',
                'hero_image'       => 'https://media.luxuri.com/83926f30daa706ee9a210a080639d387/Aspen.png',
                'meta_title'       => 'Luxury Aspen Villa Rentals and Vacation Homes',
                'meta_description' => 'Explore Aspen villas with ski-in/ski-out access and mountain views. Stay near Aspen Mountain, Red Mountain, and Snowmass Village.',
                'sort_order'       => 1,
                'active'           => true,
            ],
            [
                'name'             => 'Miami',
                'slug'             => 'miami',
                'country'          => 'USA',
                'description'      => 'Experience Miami from our handpicked luxury villas. Steps from the beach and the best nightlife.',
                'hero_image'       => 'https://media.luxuri.com/miami-hero.jpg',
                'meta_title'       => 'Luxury Miami Villa Rentals and Vacation Homes',
                'meta_description' => 'Explore Miami luxury villas with beachfront access and stunning ocean views.',
                'sort_order'       => 2,
                'active'           => true,
            ],
            [
                'name'             => 'Bali',
                'slug'             => 'bali',
                'country'          => 'Indonesia',
                'description'      => 'Find your tropical paradise in Bali with our collection of private luxury villas.',
                'hero_image'       => 'https://media.luxuri.com/bali-hero.jpg',
                'meta_title'       => 'Luxury Bali Villa Rentals and Vacation Homes',
                'meta_description' => 'Discover Bali luxury villas with private pools and rice terrace views.',
                'sort_order'       => 3,
                'active'           => true,
            ],
            [
                'name'             => 'Fort Lauderdale',
                'slug'             => 'fort-lauderdale',
                'country'          => 'USA',
                'description'      => 'Enjoy waterfront living in Fort Lauderdale with private docks and yacht access.',
                'hero_image'       => 'https://media.luxuri.com/fort-lauderdale-hero.jpg',
                'meta_title'       => 'Luxury Fort Lauderdale Villa Rentals and Vacation Homes',
                'meta_description' => 'Browse Fort Lauderdale luxury villas with private docks and Intracoastal views.',
                'sort_order'       => 4,
                'active'           => true,
            ],
            [
                'name'             => 'Los Angeles',
                'slug'             => 'los-angeles',
                'country'          => 'USA',
                'description'      => 'Stay in iconic LA neighbourhoods — Hollywood Hills, Malibu, Beverly Hills and beyond.',
                'hero_image'       => 'https://media.luxuri.com/los-angeles-hero.jpg',
                'meta_title'       => 'Luxury Los Angeles Villa Rentals and Vacation Homes',
                'meta_description' => 'Browse LA luxury villas from Hollywood Hills estates to Malibu beachfront homes.',
                'sort_order'       => 5,
                'active'           => true,
            ],
            [
                'name'             => 'Cape Town',
                'slug'             => 'cape-town',
                'country'          => 'South Africa',
                'description'      => 'Discover Cape Town from our curated collection of luxury villas with Atlantic Ocean views.',
                'hero_image'       => 'https://media.luxuri.com/cape-town-hero.jpg',
                'meta_title'       => 'Luxury Cape Town Villa Rentals and Vacation Homes',
                'meta_description' => 'Explore luxury Cape Town villas with mountain and ocean views.',
                'sort_order'       => 6,
                'active'           => true,
            ],
            [
                'name'             => 'Costa Rica',
                'slug'             => 'costa-rica',
                'country'          => 'Costa Rica',
                'description'      => "Immerse yourself in Costa Rica's natural beauty with our rainforest and beachfront villas.",
                'hero_image'       => 'https://media.luxuri.com/costa-rica-hero.jpg',
                'meta_title'       => 'Luxury Costa Rica Villa Rentals and Vacation Homes',
                'meta_description' => 'Discover luxury Costa Rica villas with private pools and ocean views.',
                'sort_order'       => 7,
                'active'           => true,
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::updateOrCreate(['slug' => $destination['slug']], $destination);
        }
    }
}
