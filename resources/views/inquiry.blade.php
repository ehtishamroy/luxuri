@php
$villaSlug = request('villa');
$yachtSlug = request('yacht');
$villa = $villaSlug ? \App\Models\Villa::where('slug', $villaSlug)->first() : null;
$yacht = $yachtSlug ? \App\Models\Yacht::where('slug', $yachtSlug)->first() : null;
$globalSettings = \App\Models\HomepageSetting::first();
$isYacht = !!$yacht;
$item = $yacht ?: $villa;
@endphp

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-zinc-950 pb-12 pt-24">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <a href="{{ $item ? ($isYacht ? route('yachts.show', $item->slug) : route('villas.show', $item->slug)) : ($isYacht ? url('/yachts') : url('/villas')) }}"
           class="inline-flex items-center gap-2 text-zinc-400 hover:text-zinc-200 mb-8 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span>Back to {{ $item ? $item->title : ($isYacht ? 'Yachts' : 'Villas') }}</span>
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">

            {{-- Left: Form --}}
            <div class="bg-zinc-900 rounded-xl p-8">
                @if(session('success'))
                <div class="mb-6 bg-emerald-900/30 border border-emerald-700 rounded-lg p-4">
                    <p class="text-emerald-300 text-sm">{{ session('success') }}</p>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 bg-red-900/30 border border-red-700 rounded-lg p-4">
                    <ul class="text-red-300 text-sm list-disc list-inside">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <h1 class="text-3xl font-bold text-zinc-100 mb-8">
                    @if($item)
                        {{ $isYacht ? 'CHARTER' : 'RESERVE' }} {{ strtoupper($item->title) }}
                    @else
                        INQUIRY
                    @endif
                </h1>

                <form method="POST" action="{{ route('inquiry.store') }}" class="space-y-6">
                    @csrf
                    @if($villa)
                    <input type="hidden" name="villa_id" value="{{ $villa->id }}">
                    @endif
                    @if($yacht)
                    <input type="hidden" name="yacht_id" value="{{ $yacht->id }}">
                    @endif

                    <div>
                        <label for="name" class="block text-sm font-medium text-zinc-300 mb-2">Full name*</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-4 py-3 bg-zinc-950/50 border border-zinc-700 rounded-lg text-zinc-100 placeholder-zinc-500 focus:border-zinc-500 focus:ring-1 focus:ring-zinc-500 focus:outline-none transition-colors"
                            placeholder="Enter your full name">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-zinc-300 mb-2">Phone number*</label>
                        <input type="tel" id="phone" name="phone" required
                            class="w-full px-4 py-3 bg-zinc-950/50 border border-zinc-700 rounded-lg text-zinc-100 placeholder-zinc-500 focus:border-zinc-500 focus:ring-1 focus:ring-zinc-500 focus:outline-none transition-colors"
                            placeholder="Enter your phone number">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-zinc-300 mb-2">Email*</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-3 bg-zinc-950/50 border border-zinc-700 rounded-lg text-zinc-100 placeholder-zinc-500 focus:border-zinc-500 focus:ring-1 focus:ring-zinc-500 focus:outline-none transition-colors"
                            placeholder="Enter your email address">
                    </div>

                    <div>
                        <label for="check_in" class="block text-sm font-medium text-zinc-300 mb-2">Check-in date</label>
                        <input type="date" id="check_in" name="check_in"
                            class="w-full px-4 py-3 bg-zinc-950/50 border border-zinc-700 rounded-lg text-zinc-100 focus:border-zinc-500 focus:ring-1 focus:ring-zinc-500 focus:outline-none transition-colors">
                    </div>

                    <div>
                        <label for="check_out" class="block text-sm font-medium text-zinc-300 mb-2">Check-out date</label>
                        <input type="date" id="check_out" name="check_out"
                            class="w-full px-4 py-3 bg-zinc-950/50 border border-zinc-700 rounded-lg text-zinc-100 focus:border-zinc-500 focus:ring-1 focus:ring-zinc-500 focus:outline-none transition-colors">
                    </div>

                    <div>
                        <label for="guests" class="block text-sm font-medium text-zinc-300 mb-2">Number of guests</label>
                        <input type="number" id="guests" name="guests" min="1"
                            class="w-full px-4 py-3 bg-zinc-950/50 border border-zinc-700 rounded-lg text-zinc-100 placeholder-zinc-500 focus:border-zinc-500 focus:ring-1 focus:ring-zinc-500 focus:outline-none transition-colors"
                            placeholder="How many guests?">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-zinc-300 mb-2">Additional requests</label>
                        <textarea id="message" name="message" rows="5"
                            class="w-full px-4 py-3 bg-zinc-950/50 border border-zinc-700 rounded-lg text-zinc-100 placeholder-zinc-500 focus:border-zinc-500 focus:ring-1 focus:ring-zinc-500 focus:outline-none transition-colors resize-none"
                            placeholder="Let us know if you have any special requests..."></textarea>
                    </div>

                    <div>
                        <label for="referral_source" class="block text-sm font-medium text-zinc-300 mb-2">Where did you hear about us?</label>
                        <div class="relative">
                            <select id="referral_source" name="referral_source"
                                class="w-full px-4 py-3 bg-zinc-950/50 border border-zinc-700 rounded-lg text-zinc-100 placeholder-zinc-500 focus:border-zinc-500 focus:ring-1 focus:ring-zinc-500 focus:outline-none transition-colors appearance-none cursor-pointer pr-10">
                                <option value="" class="bg-zinc-900 text-zinc-500">Select an option</option>
                                <option value="google" class="bg-zinc-900 text-zinc-100">Google Search</option>
                                <option value="social_media" class="bg-zinc-900 text-zinc-100">Social Media</option>
                                <option value="friend_referral" class="bg-zinc-900 text-zinc-100">Friend/Family Referral</option>
                                <option value="returning_guest" class="bg-zinc-900 text-zinc-100">Returning Guest</option>
                                <option value="other" class="bg-zinc-900 text-zinc-100">Other</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-zinc-500">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <input type="checkbox" id="marketing_consent" name="marketing_consent"
                            class="mt-1 w-4 h-4 bg-transparent border border-zinc-700 rounded text-rose-500 focus:ring-rose-500 focus:ring-offset-0 focus:ring-offset-zinc-900">
                        <label for="marketing_consent" class="text-sm text-zinc-400">
                            Would you like to subscribe to receive updates from LUXTERIA?
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-white text-black font-semibold py-3 px-6 rounded-lg hover:bg-zinc-100 transition-colors">
                        @if($item && ($villa?->price_per_night || $yacht?->price_per_hour))
                            {{ $isYacht ? 'Charter' : 'Reserve' }}
                        @else
                            Submit Inquiry
                        @endif
                    </button>
                </form>
            </div>

            {{-- Right: Summary --}}
            <div class="lg:sticky lg:top-24 h-fit">

                @if($item)
                <div class="relative rounded-lg overflow-hidden mb-6">
                    @if($item->first_image)
                        <img src="{{ $item->first_image }}" alt="{{ $item->title }}" class="w-full h-64 object-cover">
                    @else
                        <div class="w-full h-64 bg-zinc-800 flex items-center justify-center">
                            <span class="text-zinc-500">No image</span>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4 bg-white text-black px-3 py-1 rounded-full text-sm font-medium">
                        {{ $isYacht ? 'Luxury Yacht' : 'Luxury Villa' }}
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-zinc-100 mb-1">{{ strtoupper($item->title) }}</h2>
                    <p class="text-zinc-400">{{ $item->location ?? '' }}</p>
                </div>

                <div class="bg-zinc-800/50 rounded-lg p-4 mb-6">
                    @if($isYacht)
                        @if($item->length_ft)
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-zinc-400">Length:</span>
                            <span class="text-zinc-100">{{ $item->length_ft }} ft</span>
                        </div>
                        @endif
                        @if($item->cabins)
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-zinc-400">Cabins:</span>
                            <span class="text-zinc-100">{{ $item->cabins }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between items-center">
                            <span class="text-zinc-400">Max Guests:</span>
                            <span class="text-zinc-100">{{ $item->max_guests }}</span>
                        </div>
                        @if($item->style)
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-zinc-400">Style:</span>
                            <span class="text-zinc-100">{{ $item->style }}</span>
                        </div>
                        @endif
                    @else
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-zinc-400">Bedrooms:</span>
                            <span class="text-zinc-100">{{ $item->bedrooms }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-zinc-400">Bathrooms:</span>
                            <span class="text-zinc-100">{{ $item->bathrooms }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-zinc-400">Max Guests:</span>
                            <span class="text-zinc-100">{{ $item->max_guests }}</span>
                        </div>
                    @endif
                </div>
                @endif

                @if($villa && ($villa->price_per_night || !empty($villa->fees)))
                <div class="border-t border-zinc-800 pt-6">
                    <h3 class="text-lg font-semibold text-zinc-100 mb-4">Price details</h3>
                    @if($villa->price_per_night)
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-zinc-400">Rate per night</span>
                            <span class="text-zinc-100">${{ number_format($villa->price_per_night, 2) }}</span>
                        </div>
                        @if($villa->price_per_hour)
                        <div class="flex justify-between items-center">
                            <span class="text-zinc-400">Rate per hour</span>
                            <span class="text-zinc-100">${{ number_format($villa->price_per_hour, 2) }}</span>
                        </div>
                        @endif
                    </div>
                    @endif
                    @if(!empty($villa->fees))
                    <div class="space-y-3 mt-3">
                        @foreach($villa->fees as $fee)
                        <div class="flex justify-between items-center">
                            <span class="text-zinc-400">{{ $fee['name'] ?? 'Fee' }}</span>
                            <span class="text-zinc-100">${{ number_format($fee['amount'] ?? 0, 2) }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @if($villa->security_deposit_amount)
                    <div class="mt-3 pt-3 border-t border-zinc-800">
                        <div class="flex justify-between items-center">
                            <span class="text-zinc-400">Security Deposit (refundable)</span>
                            <span class="text-zinc-100">${{ number_format($villa->security_deposit_amount, 2) }}</span>
                        </div>
                    </div>
                    @endif
                </div>
                @elseif($yacht && ($yacht->price_per_hour || $yacht->charter_4h_price || $yacht->charter_6h_price || $yacht->charter_8h_price))
                <div class="border-t border-zinc-800 pt-6">
                    <h3 class="text-lg font-semibold text-zinc-100 mb-4">Charter Rates</h3>
                    <div class="space-y-3">
                        @if($yacht->price_per_hour)
                        <div class="flex justify-between items-center">
                            <span class="text-zinc-400">Hourly Rate</span>
                            <span class="text-zinc-100">${{ number_format($yacht->price_per_hour, 2) }}</span>
                        </div>
                        @endif
                        @if($yacht->charter_4h_price)
                        <div class="flex justify-between items-center">
                            <span class="text-zinc-400">4 Hour Charter</span>
                            <span class="text-zinc-100">${{ number_format($yacht->charter_4h_price, 2) }}</span>
                        </div>
                        @endif
                        @if($yacht->charter_6h_price)
                        <div class="flex justify-between items-center">
                            <span class="text-zinc-400">6 Hour Charter</span>
                            <span class="text-zinc-100">${{ number_format($yacht->charter_6h_price, 2) }}</span>
                        </div>
                        @endif
                        @if($yacht->charter_8h_price)
                        <div class="flex justify-between items-center">
                            <span class="text-zinc-400">8 Hour Charter</span>
                            <span class="text-zinc-100">${{ number_format($yacht->charter_8h_price, 2) }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                @elseif($item)
                <div class="border-t border-zinc-800 pt-6">
                    <p class="text-zinc-400 text-sm">This {{ $isYacht ? 'yacht' : 'villa' }} is available by inquiry only. Submit your details and our concierge team will get back to you with availability and pricing.</p>
                </div>
                @endif

                {{-- Global Contact --}}
                @php
                    $contactPhone = $isYacht ? ($globalSettings->global_yacht_contact_phone ?? null) : ($globalSettings->global_contact_phone ?? null);
                    $contactEmail = $isYacht ? ($globalSettings->global_yacht_contact_email ?? null) : ($globalSettings->global_contact_email ?? null);
                @endphp
                @if($contactPhone || $contactEmail)
                <div class="mt-6 pt-6 border-t border-zinc-800">
                    <h4 class="text-sm font-semibold text-zinc-200 mb-2">Contact</h4>
                    @if($contactPhone)
                    <div class="text-sm text-zinc-400"><i class="fa-light fa-phone me-2"></i>{{ $contactPhone }}</div>
                    @endif
                    @if($contactEmail)
                    <div class="text-sm text-zinc-400 mt-1"><i class="fa-light fa-envelope me-2"></i>{{ $contactEmail }}</div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
