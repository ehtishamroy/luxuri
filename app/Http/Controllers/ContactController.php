<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use App\Models\ContactMessage;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Contact | Luxteria');
        SEOTools::setDescription('Get in touch with our luxury concierge team for villa rentals, yacht charters, and bespoke travel experiences.');
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'message' => 'required|string',
            'marketing_consent' => 'nullable|boolean',
        ]);

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'],
            'marketing_consent' => $validated['marketing_consent'] ?? false,
        ]);

        $recipient = 'office@luxteria.co';

        if ($recipient) {
            Mail::to($recipient)->send(new ContactFormSubmitted($validated));
        }

        return redirect()->route('contact')->with('success', 'Thank you for your message. We will get back to you shortly.');
    }
}
