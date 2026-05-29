<?php

namespace App\Http\Controllers;

use App\Models\Yacht;
use Artesaos\SEOTools\Facades\SEOTools;

class YachtController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Luxury Yacht Rentals & Charters | Luxuri');
        SEOTools::setDescription('Charter the finest luxury yachts in Miami, Fort Lauderdale and beyond with Luxuri.');
        SEOTools::opengraph()->setUrl(url('/yachts'));

        return view('yachts');
    }

    public function show(Yacht $yacht)
    {
        abort_unless($yacht->active, 404);

        SEOTools::setTitle($yacht->meta_title ?: $yacht->title . ' - Luxury Yacht Charter | Luxuri');
        SEOTools::setDescription($yacht->meta_description ?: '');
        SEOTools::opengraph()->setUrl(url("/yachts/{$yacht->slug}"));
        if ($yacht->first_image) {
            SEOTools::opengraph()->addImage($yacht->first_image);
        }

        return view('yacht-details', compact('yacht'));
    }
}
