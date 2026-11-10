@extends('layouts.app')

@section('title', 'VoyageDirectory — Curated Boutique Hotels, Villas & Adventures')
@section('meta_description', 'Find one-of-a-kind independent stays, locally led experiences, and memorable places around the world. Browse curated destinations and book directly.')

@section('content')
    <section class="overflow-hidden bg-[#f6f3ec] text-slate-900">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 pb-10 pt-12 sm:px-6 sm:pt-16 lg:grid-cols-[1fr_0.95fr] lg:gap-16 lg:px-8 lg:pb-14 lg:pt-16">
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 rounded-full border border-emerald-900/10 bg-white/70 px-3.5 py-2 text-xs font-semibold text-emerald-950">
                    <span class="h-2 w-2 rounded-full bg-[#d36b48]"></span>
                    A MORE PERSONAL WAY TO TRAVEL
                </div>

                <h1 class="mt-6 max-w-xl font-serif text-5xl font-medium leading-[1.04] tracking-tight text-[#183b32] sm:text-6xl lg:text-7xl">
                    Find a place that feels <span class="italic text-[#c76545]">like nowhere else.</span>
                </h1>

                <p class="mt-6 max-w-lg text-base leading-7 text-slate-600 sm:text-lg">
                    Independent stays, locally led experiences, and the little details that make a trip yours. Discover them here, then book direct.
                </p>

                <div class="mt-7 flex flex-wrap items-center gap-3">
                    <a href="{{ route('listings.index') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-[#183b32] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#245447] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#183b32]">
                        Explore the collection
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                    <a href="{{ route('destinations.index') }}" class="inline-flex items-center justify-center rounded-full px-4 py-3 text-sm font-semibold text-[#183b32] transition hover:bg-white/70 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#183b32]">
                        Find your somewhere
                    </a>
                </div>

                <div class="mt-8 flex items-center gap-3 text-sm text-slate-600">
                    <div class="flex -space-x-2" aria-hidden="true">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-[#f6f3ec] bg-[#d7e4dc] text-xs">✦</span>
                        <span class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-[#f6f3ec] bg-[#f0d7c6] text-xs">✦</span>
                        <span class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-[#f6f3ec] bg-[#d9d9ed] text-xs">✦</span>
                    </div>
                    <span><strong class="font-semibold text-slate-800">{{ $stats['total_listings'] }} places</strong> with a story to tell</span>
                </div>
            </div>

            <div class="relative mx-auto w-full max-w-xl pb-8 pl-4 sm:pl-8">
                @if($featuredListings->isNotEmpty())
                    @foreach($featuredListings->take(1) as $heroListing)
                        <a href="{{ route('destinations.show', $heroListing->destination->slug) }}" class="group relative block aspect-[5/4] overflow-hidden rounded-[2rem] bg-[#d8d2c6] shadow-xl shadow-[#183b32]/15">
                            <img src="{{ $heroListing->destination->image_url }}" alt="{{ $heroListing->destination->name }}, {{ $heroListing->destination->country }}" fetchpriority="high" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-slate-950/10"></div>
                            <div class="absolute left-5 top-5 rounded-full bg-white/95 px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.14em] text-[#183b32] shadow-sm sm:left-7 sm:top-7">
                                GO SOMEWHERE WONDERFUL
                            </div>
                            <div class="absolute inset-x-0 bottom-0 p-6 text-white sm:p-8">
                                <span class="text-xs font-semibold uppercase tracking-[0.16em] text-white/75">{{ $heroListing->destination->name }}, {{ $heroListing->destination->country }}</span>
                                <h2 class="mt-2 max-w-md font-serif text-4xl leading-tight sm:text-5xl">{{ $heroListing->destination->name }}</h2>
                                <span class="mt-4 inline-flex items-center gap-2 text-sm font-medium text-white/90">
                                    Explore this destination <span aria-hidden="true">&rarr;</span>
                                </span>
                            </div>
                        </a>
                    @endforeach

                            @if($featuredListings->count() > 1)
                        @foreach($featuredListings->skip(1)->take(1) as $secondListing)
                            <a href="{{ route('listings.show', $secondListing->slug) }}" class="absolute -bottom-1 left-0 flex w-[min(17rem,82%)] items-center gap-3 rounded-2xl border border-white/80 bg-white p-3 shadow-xl sm:-left-3 sm:bottom-0">
                                <img src="{{ $secondListing->image_url }}" alt="" loading="lazy" class="h-16 w-16 shrink-0 rounded-xl object-cover">
                                <span class="min-w-0">
                                    <span class="block text-[10px] font-bold uppercase tracking-[0.14em] text-[#c76545]">A little inspiration</span>
                                    <span class="mt-1 block truncate text-sm font-semibold text-slate-900">{{ $secondListing->title }}</span>
                                    <span class="mt-0.5 block text-xs text-slate-500">{{ $secondListing->destination->name }}</span>
                                </span>
                                <span class="ml-auto text-lg text-[#183b32]" aria-hidden="true">&rarr;</span>
                            </a>
                        @endforeach
                    @endif
                @elseif($featuredDestinations->isNotEmpty())
                    @foreach($featuredDestinations->take(1) as $heroDestination)
                        <a href="{{ route('destinations.show', $heroDestination->slug) }}" class="group relative block aspect-[5/4] overflow-hidden rounded-[2rem] bg-[#d8d2c6] shadow-xl shadow-[#183b32]/15">
                            <img src="{{ $heroDestination->image_url }}" alt="{{ $heroDestination->name }}" fetchpriority="high" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-slate-950/10"></div>
                            <div class="absolute inset-x-0 bottom-0 p-6 text-white sm:p-8">
                                <span class="text-xs font-semibold uppercase tracking-[0.16em] text-white/75">{{ $heroDestination->country }}</span>
                                <h2 class="mt-2 font-serif text-4xl">{{ $heroDestination->name }}</h2>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="mx-auto max-w-6xl px-4 pb-8 sm:px-6 lg:px-8 lg:pb-10">
            <form action="{{ route('listings.index') }}" method="GET" class="grid gap-3 rounded-3xl border border-[#e6e0d5] bg-white p-3 shadow-[0_16px_50px_-30px_rgba(24,59,50,0.28)] sm:grid-cols-2 sm:p-4 lg:grid-cols-[1.4fr_1fr_1fr_auto] lg:items-end">
                <div class="px-3 py-2">
                    <label for="home-search" class="block text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">What are you dreaming of?</label>
                    <input id="home-search" type="text" name="q" placeholder="A quiet beach, a mountain cabin..." class="mt-1 w-full text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#183b32]">
                </div>
                <div
                    class="relative z-20 border-t border-slate-100 px-3 py-2 sm:border-t-0 sm:border-l"
                    x-data="{ open: false, value: '', label: 'Anywhere in the world' }"
                    @click.outside="open = false"
                    @keydown.escape.window="open = false"
                >
                    <label for="home-destination" class="block text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Somewhere</label>
                    <input type="hidden" name="destination" :value="value">
                    <button
                        id="home-destination"
                        type="button"
                        class="mt-1 flex min-h-7 w-full items-center justify-between gap-2 text-left text-sm text-slate-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#183b32]"
                        aria-haspopup="listbox"
                        aria-controls="home-destination-options"
                        :aria-expanded="open.toString()"
                        @click="open = !open"
                    >
                        <span class="truncate" x-text="label"></span>
                        <svg class="h-4 w-4 shrink-0 text-slate-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                    <div id="home-destination-options" x-cloak x-show="open" x-transition.origin.top.left class="absolute left-0 top-full z-50 mt-2 max-h-64 w-[min(20rem,calc(100vw-2.5rem))] overflow-y-auto rounded-2xl border border-[#e9e5dc] bg-white p-2 shadow-[0_18px_48px_-18px_rgba(24,59,50,0.28)]" role="listbox" aria-label="Choose a destination">
                        <button type="button" role="option" :aria-selected="value === ''" class="flex w-full items-center rounded-xl px-3 py-2.5 text-left text-sm transition hover:bg-[#f6f3ec] hover:text-[#183b32]" :class="value === '' ? 'bg-[#f6f3ec] font-semibold text-[#183b32]' : 'text-slate-700'" data-value="" data-label="Anywhere in the world" @click="value = $event.currentTarget.dataset.value; label = $event.currentTarget.dataset.label; open = false">
                            Anywhere in the world
                        </button>
                        @foreach($allDestinations as $destination)
                            <button type="button" role="option" :aria-selected="value === $el.dataset.value" class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-left text-sm transition hover:bg-[#f6f3ec] hover:text-[#183b32]" :class="value === $el.dataset.value ? 'bg-[#f6f3ec] font-semibold text-[#183b32]' : 'text-slate-700'" data-value="{{ $destination->slug }}" data-label="{{ $destination->name }}, {{ $destination->country }}" @click="value = $event.currentTarget.dataset.value; label = $event.currentTarget.dataset.label; open = false">
                                <span>{{ $destination->name }}, {{ $destination->country }}</span>
                                <svg x-show="value === $el.parentElement.dataset.value" class="h-4 w-4 text-[#c76545]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                                </svg>
                            </button>
                        @endforeach
                    </div>
                </div>
                <div
                    class="relative z-10 border-t border-slate-100 px-3 py-2 sm:border-l lg:border-t-0"
                    x-data="{ open: false, value: '', label: 'Show me everything' }"
                    @click.outside="open = false"
                    @keydown.escape.window="open = false"
                >
                    <label for="home-category" class="block text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">The kind of trip</label>
                    <input type="hidden" name="category" :value="value">
                    <button
                        id="home-category"
                        type="button"
                        class="mt-1 flex min-h-7 w-full items-center justify-between gap-2 text-left text-sm text-slate-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#183b32]"
                        aria-haspopup="listbox"
                        aria-controls="home-category-options"
                        :aria-expanded="open.toString()"
                        @click="open = !open"
                    >
                        <span class="truncate" x-text="label"></span>
                        <svg class="h-4 w-4 shrink-0 text-slate-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                    <div id="home-category-options" x-cloak x-show="open" x-transition.origin.top.left class="absolute left-0 top-full z-50 mt-2 max-h-64 w-[min(20rem,calc(100vw-2.5rem))] overflow-y-auto rounded-2xl border border-[#e9e5dc] bg-white p-2 shadow-[0_18px_48px_-18px_rgba(24,59,50,0.28)]" role="listbox" aria-label="Choose an experience">
                        <button type="button" role="option" :aria-selected="value === ''" class="flex w-full items-center rounded-xl px-3 py-2.5 text-left text-sm transition hover:bg-[#f6f3ec] hover:text-[#183b32]" :class="value === '' ? 'bg-[#f6f3ec] font-semibold text-[#183b32]' : 'text-slate-700'" data-value="" data-label="Show me everything" @click="value = $event.currentTarget.dataset.value; label = $event.currentTarget.dataset.label; open = false">
                            Show me everything
                        </button>
                        @foreach($categories as $category)
                            <button type="button" role="option" :aria-selected="value === $el.dataset.value" class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-left text-sm transition hover:bg-[#f6f3ec] hover:text-[#183b32]" :class="value === $el.dataset.value ? 'bg-[#f6f3ec] font-semibold text-[#183b32]' : 'text-slate-700'" data-value="{{ $category->slug }}" data-label="{{ $category->name }}" @click="value = $event.currentTarget.dataset.value; label = $event.currentTarget.dataset.label; open = false">
                                {{ $category->name }}
                                <svg x-show="value === $el.parentElement.dataset.value" class="h-4 w-4 text-[#c76545]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                                </svg>
                            </button>
                        @endforeach
                    </div>
                </div>
                <div class="sm:col-span-2 lg:col-span-1">
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-[#c76545] px-6 py-4 text-sm font-semibold text-white transition hover:bg-[#aa5035] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#c76545] lg:min-h-14">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Find your stay</span>
                    </button>
                </div>
            </form>

            <div class="mt-4 flex flex-wrap items-center gap-2 text-xs text-slate-500">
                <span class="mr-1 font-medium">A good place to start:</span>
                @foreach($featuredDestinations as $destination)
                    <a href="{{ route('destinations.show', $destination->slug) }}" class="rounded-full border border-[#e6e0d5] bg-white/70 px-3 py-1.5 transition hover:border-[#183b32]/30 hover:bg-white hover:text-[#183b32]">
                        {{ $destination->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <div class="border-y border-[#e9e5dc] bg-[#fffdf8]">
        <div class="mx-auto grid max-w-7xl grid-cols-2 gap-4 px-4 py-5 text-center sm:grid-cols-4 sm:px-6 lg:px-8">
            <div>
                <div class="text-2xl font-bold text-[#183b32]">{{ $stats['total_listings'] }}+</div>
                <div class="text-xs font-medium text-slate-500">Places to explore</div>
            </div>
            <div>
                <div class="text-2xl font-bold text-[#183b32]">{{ $stats['total_destinations'] }}</div>
                <div class="text-xs font-medium text-slate-500">Destinations to explore</div>
            </div>
            <div>
                <div class="text-2xl font-bold text-[#183b32]">{{ $stats['verified_merchants'] }}</div>
                <div class="text-xs font-medium text-slate-500">Verified hosts</div>
            </div>
            <div>
                <div class="text-2xl font-bold text-[#183b32]">0%</div>
                <div class="text-xs font-medium text-slate-500">Booking commissions</div>
            </div>
        </div>
    </div>

    <!-- Featured Curated Destinations Section -->
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <div class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-end sm:gap-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.16em] text-[#c76545]">A world of somewhere</span>
                <h2 class="mt-2 font-serif text-3xl font-medium tracking-tight text-[#183b32] sm:text-4xl">Where will the road take you?</h2>
                <p class="mt-2 max-w-xl text-sm leading-6 text-slate-500">A few favorite corners of the world to get you dreaming.</p>
            </div>
            <a href="{{ route('destinations.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#183b32] transition hover:text-[#c76545]">
                Explore all {{ $stats['total_destinations'] }} destinations <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-2 gap-3 sm:grid-cols-2 sm:gap-5 lg:grid-cols-4">
            @foreach($featuredDestinations as $dest)
                <a href="{{ route('destinations.show', $dest->slug) }}" class="group relative block aspect-[4/5] overflow-hidden rounded-[1.4rem] bg-[#d8d2c6] shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl sm:aspect-[4/3] sm:rounded-[1.75rem]">
                    <img src="{{ $dest->image_url }}" alt="{{ $dest->name }}, {{ $dest->country }}" loading="lazy" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#101d18]/80 via-[#101d18]/10 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-4 text-white sm:p-6">
                        <span class="text-[10px] font-semibold uppercase tracking-[0.16em] text-white/75 sm:text-xs">{{ $dest->country }}</span>
                        <h3 class="mt-1 font-serif text-xl leading-tight transition group-hover:text-[#f3c6a9] sm:text-2xl">{{ $dest->name }}</h3>
                        <span class="mt-2 inline-flex items-center gap-1.5 text-[11px] text-white/80 sm:text-xs">
                            {{ $dest->listings_count }} places to discover <span aria-hidden="true">→</span>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Browse By Category Section -->
    <section class="border-y border-[#e9e5dc] bg-[#f0ede5] py-12 sm:py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-[0.16em] text-[#c76545]">Follow your curiosity</span>
                <h2 class="mt-2 font-serif text-3xl font-medium tracking-tight text-[#183b32] sm:text-4xl">What feels like your kind of trip?</h2>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">
                @foreach($categories as $category)
                    <a href="{{ route('listings.index', ['category' => $category->slug]) }}" class="group flex flex-col items-start rounded-2xl border border-[#e4dfd5] bg-[#fffdf8] p-4 text-left transition duration-200 hover:-translate-y-1 hover:border-[#183b32]/30 hover:shadow-md sm:p-5">
                        <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-[#e7eee8] text-[#183b32] transition group-hover:bg-[#183b32] group-hover:text-white">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold leading-snug text-[#183b32]">{{ $category->name }}</h3>
                        <span class="mt-1 text-xs text-slate-500">{{ $category->listings_count }} places <span aria-hidden="true" class="transition group-hover:ml-1">→</span></span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Listings Grid -->
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.16em] text-[#c76545]">Places with a point of view</span>
                <h2 class="mt-2 font-serif text-3xl font-medium tracking-tight text-[#183b32] sm:text-4xl">A few we can’t stop thinking about</h2>
                <p class="mt-2 text-sm leading-6 text-slate-500">Thoughtful stays and experiences, chosen for the feeling that stays with you.</p>
            </div>
            <a href="{{ route('listings.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#183b32] transition hover:text-[#c76545]">
                See everything <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3 lg:gap-6">
            @foreach($featuredListings as $listing)
                <div class="group flex flex-col overflow-hidden rounded-[1.5rem] border border-[#e9e5dc] bg-[#fffdf8] shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <!-- Image Container -->
                    <div class="relative aspect-[16/10] overflow-hidden bg-[#e9e5dc]">
                        <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}" loading="lazy" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                        
                        <!-- Badges -->
                        <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                            @if($listing->is_featured)
                                <span class="rounded-full bg-[#fffdf8] px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-[#183b32] shadow-sm">Editor’s pick</span>
                            @endif
                            @if($listing->is_verified)
                                <span class="flex items-center gap-1 rounded-full bg-[#183b32] px-3 py-1 text-[10px] font-bold text-white shadow-sm">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Verified
                                </span>
                            @endif
                        </div>

                        <!-- Price Pill -->
                        <div class="absolute bottom-3 right-3 px-3 py-1 rounded-lg text-xs font-bold bg-slate-900/85 backdrop-blur-md text-white shadow-sm">
                            {{ $listing->price_level }} &bull; ${{ number_format($listing->price_avg) }}/night
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <!-- Category & Destination -->
                            <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                                <span class="font-semibold text-[#c76545]">{{ $listing->category->name }}</span>
                                <span>{{ $listing->destination->name }}, {{ $listing->destination->country }}</span>
                            </div>

                            <h3 class="line-clamp-1 text-lg font-bold text-slate-900 transition-colors group-hover:text-[#183b32]">
                                <a href="{{ route('listings.show', $listing->slug) }}">{{ $listing->title }}</a>
                            </h3>

                            <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                {{ $listing->tagline }}
                            </p>
                        </div>

                        <div class="pt-5 mt-5 border-t border-slate-100 flex items-center justify-between">
                            <!-- Rating -->
                            <div class="flex items-center gap-1.5">
                                <div class="flex items-center text-amber-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-800">{{ number_format($listing->rating, 2) }}</span>
                                <span class="text-xs text-slate-400">({{ $listing->review_count }})</span>
                            </div>

                            <a href="{{ route('listings.show', $listing->slug) }}" class="flex items-center gap-1 text-xs font-bold text-[#183b32] transition hover:text-[#c76545]">
                                View Details &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- B2B Monetization & Acquisition CTA Banner -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="relative overflow-hidden rounded-3xl border border-[#183b32] bg-gradient-to-br from-[#183b32] via-[#20483c] to-[#142e28] p-8 text-white shadow-2xl sm:p-12 lg:p-16">
            <div class="relative z-10 max-w-2xl">
                <span class="mb-4 inline-block rounded-full border border-white/15 bg-white/10 px-3 py-1 text-xs font-bold uppercase tracking-wider text-[#f3c6a9]">
                    For Travel Business Owners & Hosts
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight">
                    Take Control of Your Bookings. <br><span class="text-[#f3c6a9]">0% Commissions Forever.</span>
                </h2>
                <p class="mt-4 text-sm sm:text-base text-slate-300 leading-relaxed">
                    Tired of losing 18–25% on every booking to OTAs? Claim your existing profile on VoyageDirectory, get verified, and let high-intent travelers contact you directly via phone, WhatsApp, and email.
                </p>

                <div class="mt-8 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                    <a href="{{ route('pricing') }}" class="rounded-xl bg-[#c76545] px-6 py-3.5 text-center text-sm font-bold text-white shadow-lg transition-all hover:bg-[#aa5035]">
                        View Pro Merchant Plans &rarr;
                    </a>
                    <a href="{{ route('listings.index', ['unclaimed' => 1]) }}" class="rounded-xl border border-white/20 bg-white/10 px-6 py-3.5 text-center text-sm font-semibold text-white transition-all hover:bg-white/15">
                        Search & Claim Existing Listing
                    </a>
                </div>
            </div>

            <!-- Background Graphic Icon -->
            <div class="absolute -right-10 -bottom-10 opacity-10 pointer-events-none">
                <svg class="w-96 h-96 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
            </div>
        </div>
    </section>
@endsection
