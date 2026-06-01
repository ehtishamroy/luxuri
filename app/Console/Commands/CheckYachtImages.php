<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckYachtImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-yacht-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Check Yachts
        $yachts = \App\Models\Yacht::all();
        $this->info('=== YACHTS: ' . $yachts->count() . ' ===');
        foreach ($yachts as $y) {
            $this->line('--- ' . $y->title . ' ---');
            $this->line('images array keys: ' . json_encode(array_keys($y->images ?? [])));
            $this->line('first_image attr: ' . ($y->first_image ?: 'NULL'));
        }
        
        // Check Villas
        $villas = \App\Models\Villa::all();
        $this->info('=== VILLAS: ' . $villas->count() . ' ===');
        foreach ($villas as $v) {
            $this->line('--- ' . $v->title . ' ---');
            $this->line('images array keys: ' . json_encode(array_keys($v->images ?? [])));
            $this->line('first_image attr: ' . ($v->first_image ?: 'NULL'));
            $this->line('hero_image attr: ' . ($v->hero_image ?: 'NULL'));
        }
        
        $this->info('Done!');
    }
}
