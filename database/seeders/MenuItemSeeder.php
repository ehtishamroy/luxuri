<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['label' => 'Concierge',     'url' => '/concierge',    'sort_order' => 1],
            ['label' => 'Villas',        'url' => '/villas',       'sort_order' => 2],
            ['label' => 'Yachts',        'url' => '/yachts',       'sort_order' => 3],
            ['label' => 'Magazine',      'url' => '/magazine',     'sort_order' => 4],
            ['label' => 'Contact',       'url' => '/contact',      'sort_order' => 5],
        ];

        foreach ($items as $item) {
            MenuItem::updateOrCreate(
                ['label' => $item['label']],
                array_merge($item, ['target' => '_self', 'active' => true])
            );
        }
    }
}
