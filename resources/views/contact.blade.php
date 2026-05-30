@extends('layouts.app')
@section('content')
@php
$settings = \App\Models\HomepageSetting::first();
@endphp
<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6 mt-24">
    <h1 class="uppercase">Contact us</h1>
    <p>Get in touch with us for any enquiries and questions.</p>

    @if(session('success'))
        <div class="rounded-md bg-green-900/30 border border-green-500/30 p-4 text-green-200 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid lg:grid-cols-2 gap-12">
        <div class="">
            <form action="{{ route('contact.store') }}" method="POST" class="p-6 space-y-6 border border-zinc-50/90 bg-zinc-800 rounded-2xl">
                @csrf
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="block relative z-0">
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="block py-2.5 px-2 rounded-t-sm w-full text-sm text-zinc-50 border-0 border-b-2 border-zinc-300 appearance-none focus:border-amber-300 focus:outline-none focus:ring-0 peer" autocomplete="name"
                                   placeholder=" " />
                            <span class="absolute text-sm px-2 text-zinc-50 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-amber-50 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                Your name
                            </span>
                        </label>
                        @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <label class="block relative z-0">
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="block py-2.5 px-2 rounded-t-sm w-full text-sm text-zinc-50 border-0 border-b-2 border-zinc-300 appearance-none focus:border-amber-300 focus:outline-none focus:ring-0 peer" autocomplete="email"
                               placeholder=" " />
                        <span class="absolute text-sm px-2 text-zinc-50 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-amber-50 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                            Email
                        </span>
                        @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </label>
                    <label class="block relative z-0">
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="block py-2.5 px-2 rounded-t-sm w-full text-sm text-zinc-50 border-0 border-b-2 border-zinc-300 appearance-none focus:border-amber-300 focus:outline-none focus:ring-0 peer"
                               placeholder=" " />
                        <span class="absolute text-sm px-2 text-zinc-50 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-amber-50 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                            Phone number
                        </span>
                    </label>
                    <div class="sm:col-span-2">
                        <label class="block relative z-0">
                            <textarea name="message" required rows="3"
                                      class="block resize-none py-2.5 px-2 rounded-t-md w-full text-sm text-zinc-50 border-0 border-b-2 border-zinc-300 appearance-none focus:border-amber-300 focus:outline-none focus:ring-0 peer"
                                      placeholder=" ">{{ old('message') }}</textarea>
                            <span class="absolute text-sm px-2 text-zinc-50 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-amber-50 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                Message
                            </span>
                        </label>
                        @error('message')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-2">
                        <div class="flex items-start gap-3">
                            <input type="checkbox" name="marketing_consent" value="1" id="marketing_updates"
                                   {{ old('marketing_consent') ? 'checked' : '' }}
                                   class="mt-1 w-4 h-4 bg-transparent border border-zinc-700 rounded text-rose-500 focus:ring-rose-500 focus:ring-offset-0 focus:ring-offset-zinc-900">
                            <label for="marketing_updates" class="text-sm text-zinc-400">
                                Would you like to subscribe to receive updates from LUXTERIA?
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit"
                        class="flex items-center justify-center rounded-md bg-zinc-50 px-2.5 py-2.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 w-full">
                    Send Message
                </button>
            </form>
        </div>
        <div class="space-y-6 flex flex-col">
            <h2>General inquires</h2>
            <div class="flex max-md:flex-col gap-x-8 gap-y-4">
                @if($settings && $settings->phone)
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->phone) }}" class="transition-colors duration-300 hover:text-amber-200">
                        <i class="fa-sharp fa-light fa-phone"></i> {{ $settings->phone }}
                    </a>
                @endif
                @if($settings && $settings->email)
                    <a href="mailto:{{ $settings->email }}" class="transition-colors duration-300 hover:text-amber-200">
                        <i class="fa-sharp fa-light fa-envelope"></i> {{ $settings->email }}
                    </a>
                @endif
                @if($settings && $settings->mobile_phone)
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->mobile_phone) }}" class="transition-colors duration-300 hover:text-amber-200">
                        <i class="fa-sharp fa-light fa-mobile"></i> {{ $settings->mobile_phone }}
                    </a>
                @endif
            </div>
            <div class="grow bg-zinc-300 relative overflow-hidden rounded-2xl">
                @if($settings && $settings->contact_image)
                    <img class="absolute size-full inset-0 object-cover" src="{{ asset('storage/' . $settings->contact_image) }}" alt="Contact image">
                @else
                    <img class="absolute size-full inset-0 object-cover" src="{{ asset('media.luxteria.co/3b9d2076a92d0a3d3d175c2302204ad2/villa-sunset.jpg') }}" alt="villa sunset.jpg">
                @endif
            </div>
        </div>
    </div>
</div>
@endsection




