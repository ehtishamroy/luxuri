@extends('layouts.app')
@section('content')
<div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6 mt-24">
    <h1 class="uppercase">Contact us</h1>
    <p>Get in touch with us for any enquiries and questions.</p>

    <div class="grid lg:grid-cols-2 gap-12">
        <div class="">
            <div wire:key="lw-1264333679-0" wire:snapshot="{&quot;data&quot;:{&quot;form&quot;:[{&quot;name&quot;:&quot;&quot;,&quot;email&quot;:&quot;&quot;,&quot;phone&quot;:&quot;&quot;,&quot;subject&quot;:&quot;&quot;,&quot;message&quot;:&quot;&quot;,&quot;marketing_consent&quot;:false,&quot;property_id&quot;:null,&quot;type&quot;:[&quot;contact&quot;,{&quot;class&quot;:&quot;App\\Enums\\ContactSubmissionType&quot;,&quot;s&quot;:&quot;enm&quot;}]},{&quot;class&quot;:&quot;App\\Livewire\\Forms\\ContactSubmissionForm&quot;,&quot;s&quot;:&quot;form&quot;}],&quot;submitted&quot;:false},&quot;memo&quot;:{&quot;id&quot;:&quot;Ux3bhc7sY6mn3MleRyAc&quot;,&quot;name&quot;:&quot;contact-form&quot;,&quot;path&quot;:&quot;contact&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;release&quot;:&quot;a-a-a&quot;,&quot;children&quot;:[],&quot;scripts&quot;:[],&quot;assets&quot;:[],&quot;errors&quot;:[],&quot;locale&quot;:&quot;en&quot;,&quot;islands&quot;:[]},&quot;checksum&quot;:&quot;3f5991b7111e88ebff0147b47ea29db875281b1f7bfee5c7fba80351d0bb8015&quot;}" wire:effects="[]" wire:id="Ux3bhc7sY6mn3MleRyAc" wire:name="contact-form">
    <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
    <form wire:submit="submit" class="p-6 space-y-6 border border-zinc-50/90 bg-zinc-800 rounded-2xl">
        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label class="block relative z-0">
    <input type="text"
           class="block py-2.5 px-2 rounded-t-sm w-full text-sm text-zinc-50 border-0 border-b-2 border-zinc-300 appearance-none focus:border-amber-300 focus:outline-none focus:ring-0 peer" wire:model="form.name" autocomplete="name"
           placeholder=" " />
    <span
        class="absolute text-sm px-2 text-zinc-50 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-amber-50 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
        Your name
    </span>
</label>
            </div>

            <label class="block relative z-0">
    <input type="email"
           class="block py-2.5 px-2 rounded-t-sm w-full text-sm text-zinc-50 border-0 border-b-2 border-zinc-300 appearance-none focus:border-amber-300 focus:outline-none focus:ring-0 peer" wire:model="form.email" autocomplete="email"
           placeholder=" " />
    <span
        class="absolute text-sm px-2 text-zinc-50 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-amber-50 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
        Email
    </span>
</label>
            <label class="block relative z-0">
    <input type="text"
           class="block py-2.5 px-2 rounded-t-sm w-full text-sm text-zinc-50 border-0 border-b-2 border-zinc-300 appearance-none focus:border-amber-300 focus:outline-none focus:ring-0 peer" wire:model="form.phone"
           placeholder=" " />
    <span
        class="absolute text-sm px-2 text-zinc-50 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-amber-50 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
        Phone number
    </span>
</label>
            <div class="sm:col-span-2">
                <label class="block relative z-0">
    <textarea type="text"
              class="block resize-none py-2.5 px-2 rounded-t-md w-full text-sm text-zinc-50 border-0 border-b-2 border-zinc-300 appearance-none focus:border-amber-300 focus:outline-none focus:ring-0 peer" wire:model="form.message" rows="3"
              placeholder=" "></textarea>
    <span
        class="absolute text-sm px-2 text-zinc-50 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-amber-50 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
        Message
    </span>
</label>
            </div>

            <div class="sm:col-span-2">
                <div class="flex items-start gap-3">
                    <input type="checkbox"
                           id="marketing_updates"
                           wire:model="form.marketing_consent"
                           class="mt-1 w-4 h-4 bg-transparent border border-zinc-700 rounded text-rose-500 focus:ring-rose-500 focus:ring-offset-0 focus:ring-offset-zinc-900">
                    <label for="marketing_updates" class="text-sm text-zinc-400">
                        Would you like to subscribe to receive updates from LUXURI?
                    </label>
                </div>
            </div>

            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
        </div>
        <!--[if BLOCK]><![endif]-->    <button type="submit"
        class="flex items-center justify-center rounded-md bg-zinc-50 px-2.5 py-2.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 w-full">
        Send Message
    </button>
<!--[if ENDBLOCK]><![endif]-->    </form>
</div>

        </div>
        <div class="space-y-6 flex flex-col">
            <h2>General inquires</h2>
            <div class="flex max-md:flex-col gap-x-8 gap-y-4">
                                    <a href="tel:+17869810924"
                       class="transition-colors duration-300 hover:text-amber-200">
                        <i class="fa-sharp fa-light fa-phone"></i> +1 (786) 981-0924
                    </a>
                                                    <a href="cdn-cgi/l/email-protection.html#13717c7c787a7d74537f666b66617a3d707c7e" class="transition-colors duration-300 hover:text-amber-200">
                        <i class="fa-sharp fa-light fa-envelope"></i> <span class="__cf_email__" data-cfemail="b1d3dededad8dfd6f1ddc4c9c4c3d89fd2dedc">[email&#160;protected]</span>
                    </a>
                                                    <a href="tel:+13056453336"
                       class="transition-colors duration-300 hover:text-amber-200">
                        <i class="fa-sharp fa-light fa-mobile"></i> +1 (305) 645-3336
                    </a>
                            </div>
            <div class="grow bg-zinc-300 relative overflow-hidden rounded-2xl">
                                    <img class="absolute size-full inset-0 object-cover" src="{{ asset('media.luxuri.com/3b9d2076a92d0a3d3d175c2302204ad2/villa-sunset.jpg') }}" alt="villa sunset.jpg">
                            </div>

        </div>
    </div>
</div>
@endsection




