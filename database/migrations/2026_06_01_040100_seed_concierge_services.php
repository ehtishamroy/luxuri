<?php

use App\Models\ConciergeService;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $services = [
            [
                'title' => 'Mixologist',
                'description' => '<p>Enjoy a personalized cocktail experience in the comfort of your villa with a private mixologist. Whether you are hosting a gathering or simply relaxing with friends, your mixologist will craft signature drinks tailored to your preferences using high-quality ingredients. It is the perfect way to elevate any evening and create a memorable atmosphere.</p>',
                'sort_order' => 0,
            ],
            [
                'title' => 'Flower Arrangements',
                'description' => '<p>Add a touch of beauty and refinement to your villa with custom floral arrangements. Whether you are celebrating a special occasion or simply want to enhance the space, we provide fresh, seasonal flowers designed to reflect your taste and elevate the ambiance of your surroundings.</p>',
                'sort_order' => 1,
            ],
            [
                'title' => 'Custom Experiences',
                'description' => '<p>If you can imagine it, we can create it. From private yacht dinners and curated adventure days to surprise proposals or wellness retreats, our team designs fully personalized experiences to match your vision. Every detail is handled with care to ensure a truly unforgettable moment.</p>',
                'sort_order' => 2,
            ],
            [
                'title' => 'Private Security',
                'description' => '<p>Maintain peace of mind during your stay with discreet private security tailored to your needs. Whether for a private event, personal protection, or overnight property monitoring, our trained professionals provide a calm and reliable presence so you can feel safe and relaxed at all times.</p>',
                'sort_order' => 3,
            ],
            [
                'title' => 'Club Reservations',
                'description' => '<p>Gain access to the city\'s top nightlife venues with exclusive club reservations arranged by our concierge team. Your experience includes priority entry, reserved tables, and elevated service, so you can enjoy the evening without waiting or worrying about logistics.</p>',
                'sort_order' => 4,
            ],
            [
                'title' => 'Caviar Delivery',
                'description' => '<p>Savor the indulgence of premium caviar delivered directly to your villa. Choose from an exclusive selection of the finest varieties, perfectly presented and accompanied by traditional pairings. This service is ideal for intimate evenings, celebrations, or moments that call for something exceptional.</p>',
                'sort_order' => 5,
            ],
        ];

        foreach ($services as $service) {
            ConciergeService::create(array_merge($service, [
                'image' => null,
                'is_active' => true,
            ]));
        }
    }

    public function down(): void
    {
        ConciergeService::query()->delete();
    }
};
