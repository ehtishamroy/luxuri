<?php

namespace App\Http\Controllers;

use App\Mail\InquirySubmitted;
use App\Models\Lead;
use App\Models\Villa;
use App\Models\Yacht;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'check_in' => 'nullable|date',
            'check_out' => 'nullable|date',
            'guests' => 'nullable|integer|min:1',
            'message' => 'nullable|string',
            'referral_source' => 'nullable|string',
            'marketing_consent' => 'nullable|boolean',
            'villa_id' => 'nullable|integer|exists:villas,id',
            'yacht_id' => 'nullable|integer|exists:yachts,id',
        ]);

        $type = $request->yacht_id ? 'yacht' : 'villa';

        Lead::create([
            'type' => $type,
            'villa_id' => $request->villa_id,
            'yacht_id' => $request->yacht_id,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'check_in' => $validated['check_in'] ?? null,
            'check_out' => $validated['check_out'] ?? null,
            'guests' => $validated['guests'] ?? null,
            'message' => $validated['message'] ?? null,
            'referral_source' => $validated['referral_source'] ?? null,
            'marketing_consent' => $validated['marketing_consent'] ?? false,
            'status' => 'new',
        ]);

        $recipient = 'office@luxteria.co';

        if ($recipient) {
            $villa = $request->villa_id ? Villa::find($request->villa_id) : null;
            $yacht = $request->yacht_id ? Yacht::find($request->yacht_id) : null;

            Mail::to($recipient)->send(new InquirySubmitted(array_merge($validated, [
                'villa' => $villa,
                'yacht' => $yacht,
            ])));
        }

        return redirect()->back()->with('success', 'Thank you! Your inquiry has been submitted. Our concierge team will contact you shortly.');
    }
}
