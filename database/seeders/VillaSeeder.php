<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Villa;
use Illuminate\Database\Seeder;

class VillaSeeder extends Seeder
{
    public function run(): void
    {
        $aspen       = Destination::where('slug', 'aspen')->first();
        $miami       = Destination::where('slug', 'miami')->first();
        $bali        = Destination::where('slug', 'bali')->first();
        $fortLaudy   = Destination::where('slug', 'fort-lauderdale')->first();

        $villas = [
            [
                'destination_id'  => $aspen?->id,
                'title'           => 'The Aspen Mountain Chalet',
                'slug'            => 'aspen-mountain-chalet',
                'description'     => 'Stunning ski-in/ski-out chalet with panoramic mountain views and a private hot tub.',
                'price_per_night' => 2500.00,
                'bedrooms'        => 5,
                'bathrooms'       => 5,
                'max_guests'      => 10,
                'location'        => 'Aspen, Colorado',
                'images'          => ['https://media.luxuri.com/83926f30daa706ee9a210a080639d387/Aspen.png'],
                'amenities'       => ['Private Hot Tub', 'Ski-in/Ski-out', 'Mountain Views', 'Fireplace', 'Chef Kitchen'],
                'tags'            => ['ski', 'mountain', 'luxury'],
                'featured'        => true,
                'active'          => true,
                'meta_title'      => 'The Aspen Mountain Chalet - Luxury Ski Villa',
                'meta_description'=> 'Ski-in/ski-out Aspen chalet with 5 bedrooms, hot tub and mountain views.',
            ],
            [
                'destination_id'  => $miami?->id,
                'title'           => 'Casa Blanca Miami',
                'slug'            => 'casa-blanca-miami',
                'description'     => 'Modern masterpiece in Shenandoah. Rooftop terrace with city views and spa-like master suite.',
                'price_per_night' => 1200.00,
                'bedrooms'        => 4,
                'bathrooms'       => 3,
                'max_guests'      => 10,
                'location'        => 'Miami, Florida',
                'images'          => ['https://media.luxuri.com/617d3f29e822af451277e032f6c82d44/property-279-hostaway-335765205-order-1.jpg'],
                'amenities'       => ['Private Pool', 'Rooftop Terrace', 'City Views', 'Jacuzzi', 'Garage'],
                'tags'            => ['pool', 'urban', 'modern'],
                'featured'        => true,
                'active'          => true,
                'meta_title'      => 'Casa Blanca Miami - Luxury Urban Villa',
                'meta_description'=> '4-bed luxury villa in Miami Shenandoah with rooftop terrace and private pool.',
            ],
            [
                'destination_id'  => $bali?->id,
                'title'           => 'Villa Seminyak Serenity',
                'slug'            => 'villa-seminyak-serenity',
                'description'     => 'Tropical paradise in Seminyak with a private infinity pool, lush gardens and daily staff.',
                'price_per_night' => 800.00,
                'bedrooms'        => 4,
                'bathrooms'       => 4,
                'max_guests'      => 8,
                'location'        => 'Seminyak, Bali',
                'images'          => ['https://media.luxuri.com/bali-hero.jpg'],
                'amenities'       => ['Infinity Pool', 'Daily Staff', 'Garden', 'Open-air Living', 'Beach Shuttle'],
                'tags'            => ['tropical', 'pool', 'staff'],
                'featured'        => true,
                'active'          => true,
                'meta_title'      => 'Villa Seminyak Serenity - Luxury Bali Villa',
                'meta_description'=> 'Luxury Bali villa with infinity pool and daily staff in Seminyak.',
            ],
            [
                'destination_id'  => $fortLaudy?->id,
                'title'           => 'Las Olas Waterfront Estate',
                'slug'            => 'las-olas-waterfront-estate',
                'description'     => 'Stunning waterfront estate on the Intracoastal with private dock, pool and direct ocean access.',
                'price_per_night' => 3500.00,
                'bedrooms'        => 6,
                'bathrooms'       => 6,
                'max_guests'      => 12,
                'location'        => 'Fort Lauderdale, Florida',
                'images'          => ['https://media.luxuri.com/fort-lauderdale-hero.jpg'],
                'amenities'       => ['Private Dock', 'Pool', 'Intracoastal Views', 'Home Theater', 'Chef Kitchen'],
                'tags'            => ['waterfront', 'dock', 'pool'],
                'featured'        => true,
                'active'          => true,
                'meta_title'      => 'Las Olas Waterfront Estate - Fort Lauderdale Luxury Villa',
                'meta_description'=> '6-bed waterfront estate in Fort Lauderdale with private dock and pool.',
            ],
        ];

        foreach ($villas as $villa) {
            Villa::updateOrCreate(['slug' => $villa['slug']], $villa);
        }
    }
}
