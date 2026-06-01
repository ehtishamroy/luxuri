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
    protected $signature = 'yachts:sync-featured-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync featured_image to the first gallery image for all yachts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $yachts = \App\Models\Yacht::all();
        $this->info('Total yachts: ' . $yachts->count());
        foreach ($yachts as $y) {
            if (is_array($y->images) && count($y->images) > 0) {
                $images = array_values($y->images);
                $old = $y->featured_image;
                $y->featured_image = $images[0];
                $y->save();
                $this->line('Updated ' . $y->title . ': ' . ($old ?: 'NULL') . ' -> ' . $images[0]);
            } else {
                $this->warn('Skipped ' . $y->title . ' (no images)');
            }
        }
        $this->info('Done!');
    }
}
