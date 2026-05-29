<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use Artesaos\SEOTools\Facades\SEOTools;

class VillaController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Luxury Villa Rentals - Handpicked Private Homes | Luxuri');
        SEOTools::setDescription('Browse our collection of handpicked luxury villas across the world\'s most desirable destinations.');
        SEOTools::opengraph()->setUrl(url('/villas'));

        return view('villas');
    }

    public function show(Villa $villa)
    {
        abort_unless($villa->active, 404);

        SEOTools::setTitle($villa->meta_title ?: $villa->title . ' - Luxury Villa | Luxuri');
        SEOTools::setDescription($villa->meta_description ?: $villa->excerpt ?? '');
        SEOTools::opengraph()->setUrl(url("/villas/{$villa->slug}"));
        if ($villa->first_image) {
            SEOTools::opengraph()->addImage($villa->first_image);
        }

        $related = Villa::where('destination_id', $villa->destination_id)
            ->where('id', '!=', $villa->id)
            ->where('active', true)
            ->limit(4)
            ->get();

        return view('villa-details', compact('villa', 'related'));
    }
}
