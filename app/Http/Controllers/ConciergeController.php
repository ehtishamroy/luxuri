<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;

class ConciergeController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Luxury Concierge Services | Luxuri');
        SEOTools::setDescription('Our dedicated concierge team curates personalized experiences — private chefs, yacht charters, wellness treatments and more.');
        SEOTools::opengraph()->setUrl(url('/concierge'));

        return view('concierge');
    }
}
