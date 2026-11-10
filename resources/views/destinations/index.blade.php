@extends('layouts.app')

@section('title', 'All Global Travel Destinations — VoyageDirectory')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
    <div class="mx-auto mb-12 max-w-3xl text-center">
        <span class="text-xs font-bold uppercase tracking-[0.16em] text-[#c76545]">Curated global index</span>
        <h1 class="mt-2 font-serif text-4xl font-medium tracking-tight text-[#183b32] sm:text-5xl">Go somewhere wonderful.</h1>
        <p class="mt-3 text-sm leading-6 text-slate-500 sm:text-base">
            Browse our handpicked collection of destinations known for unparalleled landscape beauty, boutique architecture, and rich local culture.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 lg:gap-7">
        @foreach($destinations as $dest)
            <a href="{{ route('destinations.show', $dest->slug) }}" class="group relative block aspect-[4/3] overflow-hidden rounded-[1.75rem] bg-slate-900 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
                <img src="{{ $dest->image_url }}" alt="{{ $dest->name }}" loading="lazy" class="h-full w-full object-cover opacity-90 transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-[#101d18]/90 via-[#101d18]/35 to-transparent"></div>
                <div class="absolute inset-x-0 bottom-0 p-5 text-white sm:p-7">
                    <span class="text-xs font-bold uppercase tracking-[0.16em] text-[#f3c6a9]">{{ $dest->country }}</span>
                    <h2 class="mt-1 font-serif text-3xl font-medium transition-colors group-hover:text-[#f3c6a9]">{{ $dest->name }}</h2>
                    <p class="mt-1.5 line-clamp-2 text-xs leading-relaxed text-white/75">{{ $dest->description }}</p>
                    <div class="mt-4 flex items-center justify-between text-xs font-semibold">
                        <span class="rounded-full border border-white/20 bg-white/15 px-3 py-1 backdrop-blur-md">
                            {{ $dest->listings_count }} curated places
                        </span>
                        <span class="flex items-center gap-1 text-[#f3c6a9] transition-transform group-hover:translate-x-1">
                            Explore guides &rarr;
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
