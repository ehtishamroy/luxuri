<?php

namespace App\Http\Controllers;

use App\Models\HomepageSetting;
use App\Models\Villa;
use Artesaos\SEOTools\Facades\SEOTools;

class VillaController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Luxury Villa Rentals - Handpicked Private Homes | Luxteria');
        SEOTools::setDescription('Browse our collection of handpicked luxury villas across the world\'s most desirable destinations.');
        SEOTools::opengraph()->setUrl(url('/villas'));

        $query = Villa::with('destination')->where('active', true);

        if (request()->filled('destination')) {
            $dest = request('destination');
            $query->where(function ($q) use ($dest) {
                $q->whereHas('destination', function ($subq) use ($dest) {
                    $subq->where('name', 'like', "%{$dest}%")
                         ->orWhere('slug', 'like', "%{$dest}%");
                })->orWhere('title', 'like', "%{$dest}%")
                  ->orWhere('location', 'like', "%{$dest}%");
            });
        }

        if (request()->filled('guests')) {
            $query->where('max_guests', '>=', request('guests'));
        }

        // Additional date filtering logic can be added here if a bookings table exists
        
        $villas = $query->orderBy('created_at', 'desc')->paginate(16)->withQueryString();

        return view('villas', compact('villas'));
    }

    public function show(Villa $villa)
    {
        abort_unless($villa->active, 404);

        $villa->load('amenitiesList');

        SEOTools::setTitle($villa->meta_title ?: $villa->title . ' - Luxury Villa | Luxteria');
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

        $globalSettings = HomepageSetting::first();

        return view('villa-details', compact('villa', 'related', 'globalSettings'));
    }
}
