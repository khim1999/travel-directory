@extends('layouts.app')

@section('title', "Best Boutique Stays, Villas & Tours in {$destination->name}, {$destination->country} — VoyageDirectory")
@section('meta_description', "Explore handpicked boutique hotels, luxury villas, and experiences in {$destination->name}. Direct bookings with zero middleman commissions.")

@section('content')
<!-- Destination Hero Banner -->
<div class="relative bg-slate-900 text-white py-16 sm:py-24 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="w-full h-full object-cover opacity-35 filter blur-[1px]">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/80 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md text-xs font-semibold text-indigo-300 mb-4">
                <span>{{ $destination->country }}</span>
                <span>&bull;</span>
                <span>{{ $destination->listings_count }} Verified Listings</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Curated Guide to {{ $destination->name }}</h1>
            <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed">
                {{ $destination->description }}
            </p>
        </div>
    </div>
</div>

<!-- Listings Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 pb-4 border-b border-slate-200 gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Recommended Places in {{ $destination->name }}</h2>
            <p class="text-xs text-slate-500 mt-0.5">Top-rated accommodations and authentic excursions.</p>
        </div>
        <a href="{{ route('listings.index', ['destination' => $destination->slug]) }}" class="text-xs font-bold text-indigo-600 hover:underline">
            Filter all in {{ $destination->name }} &rarr;
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($listings as $listing)
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                    <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 flex gap-1">
                        @if($listing->is_featured)
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-500 text-white uppercase">Featured</span>
                        @endif
                        @if($listing->is_verified)
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-600 text-white">Verified</span>
                        @endif
                    </div>
                    <div class="absolute bottom-3 right-3 px-2.5 py-1 rounded-lg text-xs font-bold bg-slate-900/80 backdrop-blur-md text-white">
                        {{ $listing->price_level }} &bull; ${{ number_format($listing->price_avg) }}/nt
                    </div>
                </div>

                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <span class="text-xs font-semibold text-indigo-600">{{ $listing->category->name }}</span>
                        <h3 class="text-base font-bold text-slate-900 group-hover:text-indigo-600 truncate mt-1">
                            <a href="{{ route('listings.show', $listing->slug) }}">{{ $listing->title }}</a>
                        </h3>
                        <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">{{ $listing->tagline }}</p>
                    </div>

                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-1">
                            <span class="text-xs text-amber-500">★</span>
                            <span class="text-xs font-bold text-slate-800">{{ number_format($listing->rating, 2) }}</span>
                            <span class="text-[11px] text-slate-400">({{ $listing->review_count }})</span>
                        </div>
                        <a href="{{ route('listings.show', $listing->slug) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800">
                            View Stays &rarr;
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-slate-200 p-12 text-center text-slate-500 text-sm">
                No listings available in this destination yet.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $listings->links() }}
    </div>
</div>
@endsection
