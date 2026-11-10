@extends('layouts.app')

@section('title', 'All Global Travel Destinations — VoyageDirectory')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center max-w-3xl mx-auto mb-12">
        <span class="text-xs font-bold uppercase tracking-wider text-indigo-600">Curated Global Index</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mt-1">Explore by Destination</h1>
        <p class="text-sm sm:text-base text-slate-500 mt-2">
            Browse our handpicked collection of destinations known for unparalleled landscape beauty, boutique architecture, and rich local culture.
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($destinations as $dest)
            <a href="{{ route('destinations.show', $dest->slug) }}" class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 aspect-[4/3] block bg-slate-900">
                <img src="{{ $dest->image_url }}" alt="{{ $dest->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                <div class="absolute bottom-0 inset-x-0 p-6 text-white">
                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-300">{{ $dest->country }}</span>
                    <h2 class="text-2xl font-bold mt-1 group-hover:text-indigo-200 transition-colors">{{ $dest->name }}</h2>
                    <p class="text-xs text-slate-300 line-clamp-2 mt-1.5 leading-relaxed">{{ $dest->description }}</p>
                    <div class="mt-4 flex items-center justify-between text-xs font-semibold">
                        <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md">
                            {{ $dest->listings_count }} curated places
                        </span>
                        <span class="text-indigo-300 group-hover:translate-x-1 transition-transform flex items-center gap-1">
                            Explore guides &rarr;
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
