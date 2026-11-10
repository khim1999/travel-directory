<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#fbf9f4] text-slate-900 antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'VoyageDirectory — Curated Global Travel Stays, Villas & Adventures')</title>
    <meta name="description" content="@yield('meta_description', 'Discover verified boutique hotels, private cliffside villas, Michelin-starred gastronomy, and luxury outdoor adventures worldwide.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js for lightweight UI interactivity (modals, dropdowns) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('head')
</head>
<body class="min-h-full flex flex-col bg-[#fbf9f4] font-sans text-slate-800" x-data="{ mobileMenuOpen: false }">

    <!-- Top Announcement Bar -->
    <div class="bg-[#183b32] px-4 py-2 text-center text-xs font-medium text-white/85 sm:text-sm">
        <span>Are you a boutique hotel, villa, or tour operator? </span>
        <a href="{{ route('pricing') }}" class="ml-1 font-semibold text-[#f3c6a9] underline decoration-white/40 underline-offset-2 transition hover:text-white">Claim your listing & capture direct leads with 0% commission &rarr;</a>
    </div>

    <!-- Navigation Bar -->
    <header class="sticky top-0 z-40 border-b border-[#ebe7dd] bg-[#fffdf8]/95 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-18">
                <!-- Brand Logo -->
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="group flex items-center gap-2.5 text-slate-900">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#183b32] text-white shadow-md shadow-[#183b32]/15 transition-transform group-hover:scale-105">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-xl font-bold tracking-tight text-[#183b32]">VoyageDirectory</span>
                            <span class="-mt-1 block text-[10px] font-bold uppercase tracking-widest text-[#c76545]">Curated Travel Index</span>
                        </div>
                    </a>

                    <!-- Desktop Nav Links -->
                    <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 md:flex">
                        <a href="{{ route('listings.index') }}" class="transition-colors hover:text-[#183b32] {{ request()->routeIs('listings.index') ? 'font-semibold text-[#183b32]' : '' }}">Explore Listings</a>
                        <a href="{{ route('destinations.index') }}" class="transition-colors hover:text-[#183b32] {{ request()->routeIs('destinations.*') ? 'font-semibold text-[#183b32]' : '' }}">Destinations</a>
                        <a href="{{ route('pricing') }}" class="transition-colors hover:text-[#183b32] {{ request()->routeIs('pricing') ? 'font-semibold text-[#183b32]' : '' }}">For Business / Pricing</a>
                    </nav>
                </div>

                <!-- Right Actions -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('listings.index', ['unclaimed' => 1]) }}" class="px-3 py-2 text-xs font-semibold text-slate-600 transition hover:text-[#183b32]">
                        Claim Existing Profile
                    </a>
                    <a href="{{ route('pricing') }}" class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-[#c76545] px-4 py-2 text-xs font-semibold text-white shadow-sm transition-all hover:bg-[#aa5035] hover:shadow">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        List Your Business
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex md:hidden items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="rounded-lg p-2 text-slate-600 hover:bg-slate-100 hover:text-[#183b32] focus:outline-none">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div x-show="mobileMenuOpen" x-cloak class="flex flex-col gap-3 border-t border-slate-100 py-4 md:hidden">
                <a href="{{ route('listings.index') }}" class="py-1 text-sm font-medium text-slate-700 hover:text-[#183b32]">Explore Listings</a>
                <a href="{{ route('destinations.index') }}" class="py-1 text-sm font-medium text-slate-700 hover:text-[#183b32]">Destinations</a>
                <a href="{{ route('pricing') }}" class="py-1 text-sm font-medium text-slate-700 hover:text-[#183b32]">For Business / Pricing</a>
                <div class="pt-2 flex flex-col gap-2">
                    <a href="{{ route('pricing') }}" class="w-full rounded-lg bg-[#c76545] px-4 py-2 text-center text-xs font-semibold text-white">List Your Business</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Global Notification Banner -->
    @if(session('success'))
        <div class="bg-emerald-50 border-b border-emerald-200 text-emerald-800 px-4 py-3 text-sm flex items-center justify-between">
            <div class="max-w-7xl mx-auto flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-50 border-b border-rose-200 text-rose-800 px-4 py-3 text-sm">
            <div class="max-w-7xl mx-auto">
                <p class="font-semibold mb-1">Please correct the following errors:</p>
                <ul class="list-disc list-inside space-y-0.5 text-xs text-rose-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-20 border-t border-[#183b32] bg-[#142e28] text-sm text-slate-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <!-- Column 1: Info -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2 text-white">
                        <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-lg font-bold">VoyageDirectory</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        The independent curated travel directory connecting discerning travelers directly with boutique accommodations, villas, private tours, and culinary masterminds.
                    </p>
                    <div class="text-xs text-slate-500">
                        &copy; {{ date('Y') }} VoyageDirectory Inc. All rights reserved.
                    </div>
                </div>

                <!-- Column 2: Destinations -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-200 mb-3">Popular Destinations</h3>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('destinations.show', 'bali') }}" class="hover:text-white transition-colors">Bali, Indonesia</a></li>
                        <li><a href="{{ route('destinations.show', 'santorini') }}" class="hover:text-white transition-colors">Santorini, Greece</a></li>
                        <li><a href="{{ route('destinations.show', 'kyoto') }}" class="hover:text-white transition-colors">Kyoto, Japan</a></li>
                        <li><a href="{{ route('destinations.show', 'amalfi-coast') }}" class="hover:text-white transition-colors">Amalfi Coast, Italy</a></li>
                        <li><a href="{{ route('destinations.index') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold">View All Destinations &rarr;</a></li>
                    </ul>
                </div>

                <!-- Column 3: Operators & Monetization -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-200 mb-3">For Travel Businesses</h3>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('pricing') }}" class="hover:text-white transition-colors">Claim Business Profile</a></li>
                        <li><a href="{{ route('pricing') }}" class="hover:text-white transition-colors">Pro Merchant Pricing</a></li>
                        <li><a href="{{ route('pricing') }}" class="hover:text-white transition-colors">Direct Inquiry Pipeline</a></li>
                        <li><a href="{{ route('pricing') }}" class="hover:text-white transition-colors">Advertising & Featured Slots</a></li>
                    </ul>
                </div>

                <!-- Column 4: Newsletter -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-200 mb-3">Stay in the Loop</h3>
                    <p class="text-xs text-slate-400 mb-3">Get our monthly dispatch of secret boutique hideaways and travel discounts.</p>
                    <form onsubmit="event.preventDefault(); alert('Thank you for subscribing to VoyageDirectory!');" class="flex gap-2">
                        <input type="email" placeholder="Your email address" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-3 py-2 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold px-3 py-2 rounded-lg">Join</button>
                    </form>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
