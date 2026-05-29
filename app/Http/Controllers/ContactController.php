<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Contact Luxuri - Get in Touch');
        SEOTools::setDescription('Contact the Luxuri team to book your luxury villa, yacht charter or concierge service.');
        SEOTools::opengraph()->setUrl(url('/contact'));

        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        return back()->with('success', 'Thank you! We\'ll be in touch shortly.');
    }
}
