<?php

namespace App\Http\Controllers;

use App\Models\HomepageSetting;
use App\Models\Yacht;
use Artesaos\SEOTools\Facades\SEOTools;

class YachtController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Luxury Yacht Charters - Handpicked Superyachts | Luxuri');
        SEOTools::setDescription('Browse our collection of handpicked luxury yacht charters across the world\'s most desirable destinations.');
        SEOTools::opengraph()->setUrl(url('/yachts'));

        $query = Yacht::where('active', true);

        // Make filter
        if (request('make')) {
            $query->whereRaw('LOWER(make) = ?', [strtolower(request('make'))]);
        }

        // Style filter
        if (request('style')) {
            $query->whereRaw('LOWER(style) = ?', [strtolower(request('style'))]);
        }

        // Length filter
        if (request('length')) {
            match (request('length')) {
                '0-50'    => $query->whereBetween('length_ft', [0, 50]),
                '50-75'   => $query->whereBetween('length_ft', [50, 75]),
                '75-100'  => $query->whereBetween('length_ft', [75, 100]),
                '100-150' => $query->whereBetween('length_ft', [100, 150]),
                '150-1000' => $query->where('length_ft', '>', 150),
                default   => null,
            };
        }

        // Sort
        $sort = request('sort', '-created_at');
        match ($sort) {
            '-created_at' => $query->latest(),
            'price_per_hour' => $query->orderByRaw('price_per_hour IS NULL, price_per_hour ASC'),
            '-price_per_hour' => $query->orderByRaw('price_per_hour IS NULL, price_per_hour DESC'),
            'length_ft' => $query->orderByRaw('length_ft IS NULL, length_ft ASC'),
            '-length_ft' => $query->orderByRaw('length_ft IS NULL, length_ft DESC'),
            'title' => $query->orderBy('title', 'asc'),
            '-title' => $query->orderBy('title', 'desc'),
            default => $query->latest(),
        };

        $yachts = $query->get();

        // Unique filter options from active yachts
        $makes = Yacht::where('active', true)->whereNotNull('make')->distinct()->pluck('make')->filter()->values();
        $styles = Yacht::where('active', true)->whereNotNull('style')->distinct()->pluck('style')->filter()->values();

        return view('yachts', compact('yachts', 'makes', 'styles'));
    }

    public function show(Yacht $yacht)
    {
        abort_unless($yacht->active, 404);

        SEOTools::setTitle($yacht->meta_title ?: $yacht->title . ' - Luxury Yacht Charter | Luxuri');
        SEOTools::setDescription($yacht->meta_description ?: $yacht->description ?? '');
        SEOTools::opengraph()->setUrl(url("/yachts/{$yacht->slug}"));
        if ($yacht->first_image) {
            SEOTools::opengraph()->addImage($yacht->first_image);
        }

        $globalSettings = HomepageSetting::first();

        return view('yacht-details', compact('yacht', 'globalSettings'));
    }
}
