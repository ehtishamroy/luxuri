<?php

namespace Database\Seeders;

use App\Models\Yacht;
use Illuminate\Database\Seeder;

class YachtSeeder extends Seeder
{
    public function run(): void
    {
        $yachts = [
            [
                'title'         => 'Pershing 70 Miami',
                'slug'          => 'pershing-70-miami',
                'description'   => 'Sleek Italian performance yacht. 70ft of pure elegance cruising Miami waters.',
                'make'          => 'Pershing',
                'style'         => 'Sports',
                'length_ft'     => 70,
                'cabins'        => 3,
                'max_guests'    => 12,
                'price_per_day' => 5000.00,
                'location'      => 'Miami, FL',
                'images'        => ['https://media.luxuri.com/yachts/pershing-70.jpg'],
                'tags'          => ['sports', 'speed', 'miami'],
                'featured'      => true,
                'active'        => true,
                'meta_title'    => 'Pershing 70 Yacht Charter Miami',
                'meta_description' => 'Charter the Pershing 70 in Miami. 70ft sports yacht with 3 cabins.',
            ],
            [
                'title'         => 'Azimut 80 Fort Lauderdale',
                'slug'          => 'azimut-80-fort-lauderdale',
                'description'   => 'Luxurious Azimut 80 with spacious deck, full salon and premium amenities.',
                'make'          => 'Azimut',
                'style'         => 'Luxury',
                'length_ft'     => 80,
                'cabins'        => 4,
                'max_guests'    => 14,
                'price_per_day' => 7000.00,
                'location'      => 'Fort Lauderdale, FL',
                'images'        => ['https://media.luxuri.com/yachts/azimut-80.jpg'],
                'tags'          => ['luxury', 'spacious', 'fort-lauderdale'],
                'featured'      => true,
                'active'        => true,
                'meta_title'    => 'Azimut 80 Yacht Charter Fort Lauderdale',
                'meta_description' => 'Charter the Azimut 80 in Fort Lauderdale. 80ft luxury yacht with 4 cabins.',
            ],
            [
                'title'         => 'Princess 72 Miami Beach',
                'slug'          => 'princess-72-miami-beach',
                'description'   => 'Elegant Princess 72 yacht perfect for day charters and sunset cruises along Miami Beach.',
                'make'          => 'Princess',
                'style'         => 'Luxury',
                'length_ft'     => 72,
                'cabins'        => 3,
                'max_guests'    => 12,
                'price_per_day' => 6500.00,
                'location'      => 'Miami Beach, FL',
                'images'        => ['https://media.luxuri.com/yachts/princess-72.jpg'],
                'tags'          => ['luxury', 'sunset', 'miami-beach'],
                'featured'      => false,
                'active'        => true,
                'meta_title'    => 'Princess 72 Yacht Charter Miami Beach',
                'meta_description' => 'Charter the Princess 72 in Miami Beach. 72ft luxury yacht for day charters.',
            ],
        ];

        foreach ($yachts as $yacht) {
            Yacht::updateOrCreate(['slug' => $yacht['slug']], $yacht);
        }
    }
}
