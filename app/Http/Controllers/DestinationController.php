<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Artesaos\SEOTools\Facades\SEOTools;

class DestinationController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Popular Destinations - Luxury Villa Rentals | Luxteria');
        SEOTools::setDescription('Explore our most popular destinations for luxury villa rentals — from Aspen to Bali, Miami to Cape Town.');
        SEOTools::opengraph()->setUrl(url('/destinations'));

        $destinations = cache()->remember('destinations.active', 3600, fn () =>
            Destination::where('active', true)->orderBy('sort_order')->get()
        );

        return view('destinations.index', compact('destinations'));
    }

    public function show(Destination $destination)
    {
        abort_unless($destination->active, 404);

        SEOTools::setTitle($destination->meta_title ?: "Luxury {$destination->name} Villa Rentals | Luxteria");
        SEOTools::setDescription($destination->meta_description ?: $destination->description ?? '');
        SEOTools::opengraph()->setUrl(url("/destinations/{$destination->slug}"));
        if ($destination->hero_image) {
            SEOTools::opengraph()->addImage($destination->hero_image);
        }

        return view('destination-details', compact('destination'));
    }
}
