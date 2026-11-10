@extends('layouts.app')

@section('title', 'Grow Your Direct Bookings — VoyageDirectory for Travel Businesses')
@section('meta_description', 'Claim your travel business listing, unlock verified host badges, and capture direct inquiries with zero commission fees.')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8">

    <!-- Header Section -->
    <div class="text-center max-w-3xl mx-auto mb-16">
        <span class="mb-4 inline-block rounded-full border border-[#183b32]/10 bg-white px-3 py-1 text-xs font-bold uppercase tracking-wider text-[#c76545]">
            For Boutique Hotels, Villas, Tour Operators & Restaurants
        </span>
        <h1 class="font-serif text-4xl font-medium leading-tight tracking-tight text-[#183b32] sm:text-5xl">
            Stop Paying 20% OTA Fees. <span class="text-[#c76545]">Own Your Direct Guest Relationships.</span>
        </h1>
        <p class="text-base sm:text-lg text-slate-600 mt-4 leading-relaxed">
            VoyageDirectory puts travelers directly in touch with you. When guests book through our platform, you keep 100% of the revenue.
        </p>
    </div>

    <!-- Pricing Cards Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch mb-20">
        @foreach($plans as $plan)
            <div class="relative flex flex-col justify-between rounded-3xl border bg-[#fffdf8] p-7 shadow-sm sm:p-8 {{ $plan['highlight'] ? 'border-[#183b32] ring-2 ring-[#183b32]/15 shadow-xl' : 'border-[#e9e5dc]' }}">
                @if($plan['highlight'])
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 rounded-full bg-[#183b32] px-3.5 py-1 text-[11px] font-bold uppercase tracking-wider text-white shadow">
                        {{ $plan['badge'] ?? 'Most Popular' }}
                    </div>
                @endif

                <div>
                    <!-- Plan Title -->
                    <h3 class="text-xl font-bold text-slate-900">{{ $plan['name'] }}</h3>
                    <p class="text-xs text-slate-500 mt-2 min-h-[36px] leading-relaxed">{{ $plan['description'] }}</p>

                    <!-- Price Display -->
                    <div class="mt-6 pb-6 border-b border-slate-100">
                        <div class="flex items-baseline gap-1">
                            <span class="font-serif text-4xl font-medium text-[#183b32]">${{ $plan['price'] }}</span>
                            <span class="text-xs font-medium text-slate-500">/ {{ $plan['cadence'] }}</span>
                        </div>
                        @if($plan['price'] > 0)
                            <span class="text-[11px] text-emerald-600 font-semibold mt-1 block">Billed monthly &bull; Cancel anytime</span>
                        @else
                            <span class="text-[11px] text-slate-400 font-medium mt-1 block">No credit card required</span>
                        @endif
                    </div>

                    <!-- Features List -->
                    <ul class="mt-6 space-y-3.5 text-xs text-slate-700">
                        @foreach($plan['features'] as $feature)
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100">
                    <a href="{{ $plan['cta_url'] }}" class="block w-full rounded-xl px-4 py-3 text-center text-xs font-bold transition {{ $plan['highlight'] ? 'bg-[#183b32] text-white shadow-md hover:bg-[#245447]' : 'bg-[#f0ede5] text-[#183b32] hover:bg-[#e7e2d7]' }}">
                        {{ $plan['cta'] }} &rarr;
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Monetization & ROI Demonstration -->
    <div class="mb-20 rounded-3xl border border-[#183b32] bg-gradient-to-br from-[#183b32] to-[#142e28] p-8 text-white shadow-xl sm:p-12">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-wider text-teal-400">The Business Economics</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold mt-1">Why Travel Businesses Love VoyageDirectory</h2>
            <p class="text-sm text-slate-300 mt-3 leading-relaxed">
                If a typical boutique villa generates 1 direct 4-night stay ($2,400 value) each month via VoyageDirectory instead of Airbnb or Booking.com, you save **$432/month in commissions** while paying just $39/mo. That is an immediate **1,100% ROI**.
            </p>

            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-6 pt-6 border-t border-white/10 text-center">
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <div class="text-2xl font-extrabold text-[#f3c6a9]">$0</div>
                    <div class="text-xs text-slate-400 mt-1">Commission per booking</div>
                </div>
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <div class="text-2xl font-extrabold text-[#f3c6a9]">100% Direct</div>
                    <div class="text-xs text-slate-400 mt-1">Direct guest email & phone</div>
                </div>
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <div class="text-2xl font-extrabold text-[#f3c6a9]">Do-Follow</div>
                    <div class="text-xs text-slate-400 mt-1">SEO backlink to your website</div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="max-w-3xl mx-auto" id="contact-sales">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-extrabold text-slate-900">Frequently Asked Questions</h2>
            <p class="text-xs text-slate-500 mt-1">Everything you need to know about our directory subscriptions and verification process.</p>
        </div>

        <div class="space-y-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-200">
                <h3 class="text-sm font-bold text-slate-900">How does the "Claim Listing" verification process work?</h3>
                <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">
                    When you submit a claim for an existing property, you provide an official business email or verification note. Our curation team verifies domain ownership or registry matches within 24 hours and transfers control of the listing to your account.
                </p>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200">
                <h3 class="text-sm font-bold text-slate-900">How do customer inquiry leads reach my business?</h3>
                <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">
                    Whenever a traveler fills out the "Inquire Direct" form on your listing, their details (name, email, phone, dates, guest count, and note) are instantly dispatched to your designated contact email. You respond directly to close the booking.
                </p>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200">
                <h3 class="text-sm font-bold text-slate-900">How does billing and subscription management work?</h3>
                <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">
                    All subscriptions are processed securely through Stripe Billing. You can upgrade, downgrade, or cancel your subscription at any time with one click through your merchant billing portal.
                </p>
            </div>
        </div>
    </div>

</div>
@endsection
