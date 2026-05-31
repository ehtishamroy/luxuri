<?php

namespace App\Http\Controllers;

use App\Models\ConciergeService;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class ConciergeController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Concierge | Luxuri');
        SEOTools::setDescription('Experience bespoke luxury concierge services — from private chefs and yacht charters to exclusive event planning worldwide.');

        $services = ConciergeService::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('concierge', compact('services'));
    }
}
