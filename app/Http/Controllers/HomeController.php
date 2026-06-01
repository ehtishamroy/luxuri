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
        SEOTools::setTitle('Luxury Concierge & Villa Experiences in Miami');
        SEOTools::setDescription('From private villas and yachts to VIP lifestyle services LUXTERIA handles every detail with discretion, speed, and luxury.');
        SEOTools::opengraph()->setUrl(url('/'));

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
