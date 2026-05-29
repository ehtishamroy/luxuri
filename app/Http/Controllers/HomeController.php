<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\HomepageSetting;
use App\Models\MagazinePost;
use App\Models\Villa;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Hand-Picked Luxuri Villa Rentals and Private Homes');
        SEOTools::setDescription('Discover unparalleled luxury with Luxuri\'s vacation villas, elite car and yacht rentals, and bespoke concierge services across top global destinations.');
        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::opengraph()->addImage(asset('media/OpenGraph-Luxuri.png'));

        $destinations = cache()->remember('destinations.active', 3600, fn () =>
            Destination::where('active', true)
                ->orderBy('sort_order')
                ->get()
        );

        $featuredVillas = Villa::with('destination')
            ->where('active', true)
            ->where('featured', true)
            ->take(6)
            ->get();

        if ($featuredVillas->isEmpty()) {
            $featuredVillas = Villa::with('destination')
                ->where('active', true)
                ->take(6)
                ->get();
        }

        $recentPosts = MagazinePost::where('active', true)
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        $homepageSettings = HomepageSetting::query()->first();

        return view('index', compact('destinations', 'featuredVillas', 'recentPosts', 'homepageSettings'));
    }
}
