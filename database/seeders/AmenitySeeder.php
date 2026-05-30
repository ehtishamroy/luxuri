<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            ['name' => 'Pool', 'icon' => 'fa-water-ladder'],
            ['name' => 'Heated Pool', 'icon' => 'fa-water-ladder'],
            ['name' => 'Hot Tub', 'icon' => 'fa-hot-tub-person'],
            ['name' => 'Jacuzzi', 'icon' => 'fa-hot-tub-person'],
            ['name' => 'Spa', 'icon' => 'fa-spa'],
            ['name' => 'Wi-Fi', 'icon' => 'fa-wifi'],
            ['name' => 'Gym', 'icon' => 'fa-dumbbell'],
            ['name' => 'Fireplace', 'icon' => 'fa-fire'],
            ['name' => 'BBQ Grill', 'icon' => 'fa-fire-burner'],
            ['name' => 'Boat Dock', 'icon' => 'fa-ship'],
            ['name' => 'Gated House', 'icon' => 'fa-dungeon'],
            ['name' => 'Waterfront', 'icon' => 'fa-water'],
            ['name' => 'Laundry', 'icon' => 'fa-shirt'],
            ['name' => 'Bathtub', 'icon' => 'fa-bath'],
            ['name' => 'Mini-Bar', 'icon' => 'fa-martini-glass-empty'],
            ['name' => 'Sunset View', 'icon' => 'fa-sun'],
            ['name' => 'Beach Access', 'icon' => 'fa-umbrella-beach'],
            ['name' => 'Smart TV', 'icon' => 'fa-tv'],
            ['name' => 'Air Conditioning', 'icon' => 'fa-snowflake'],
            ['name' => 'Parking', 'icon' => 'fa-car'],
            ['name' => 'Elevator', 'icon' => 'fa-elevator'],
            ['name' => 'Game Room', 'icon' => 'fa-gamepad'],
            ['name' => 'Wine Cellar', 'icon' => 'fa-wine-bottle'],
            ['name' => 'Home Theater', 'icon' => 'fa-film'],
            ['name' => 'Kitchen', 'icon' => 'fa-utensils'],
            ['name' => 'Coffee Maker', 'icon' => 'fa-mug-hot'],
            ['name' => 'Safe', 'icon' => 'fa-vault'],
            ['name' => 'Hair Dryer', 'icon' => 'fa-wind'],
            ['name' => 'Iron', 'icon' => 'fa-shirt'],
            ['name' => 'Patio / Deck', 'icon' => 'fa-chair'],
            ['name' => 'Garden', 'icon' => 'fa-tree'],
            ['name' => 'Outdoor Dining', 'icon' => 'fa-utensils'],
            ['name' => 'Balcony', 'icon' => 'fa-person-booth'],
            ['name' => 'Concierge', 'icon' => 'fa-bell-concierge'],
            ['name' => 'Private Chef', 'icon' => 'fa-utensils'],
            ['name' => 'Butler Service', 'icon' => 'fa-user-tie'],
            ['name' => 'Pet Friendly', 'icon' => 'fa-paw'],
            ['name' => 'Wheelchair Accessible', 'icon' => 'fa-wheelchair'],
            ['name' => 'Security System', 'icon' => 'fa-shield-halved'],
            ['name' => 'Generator', 'icon' => 'fa-bolt'],
        ];

        foreach ($amenities as $amenity) {
            Amenity::firstOrCreate(
                ['slug' => Str::slug($amenity['name'])],
                [
                    'name' => $amenity['name'],
                    'icon' => $amenity['icon'],
                ]
            );
        }
    }
}
