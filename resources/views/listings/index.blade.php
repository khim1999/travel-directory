@extends('layouts.app')

@section('title', 'Explore Travel Listings & Boutique Stays — VoyageDirectory')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Explore Curated Stays & Experiences</h1>
        <p class="text-sm text-slate-500 mt-1">Discover {{ $listings->total() }} handpicked boutique accommodations, private villas, and local excursions.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Filter Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm sticky top-24">
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                    <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Filters</h2>
                    <a href="{{ route('listings.index') }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-semibold">Reset All</a>
                </div>

                <form action="{{ route('listings.index') }}" method="GET" class="space-y-5">
                    <!-- Keyword Search -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Search</label>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Keyword or location..." class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg px-3 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500">
                    </div>

                    <!-- Destination -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Destination</label>
                        <select name="destination" class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg px-3 py-2.5 text-slate-800 focus:outline-none focus:border-indigo-500 cursor-pointer">
                            <option value="">All Destinations</option>
                            @foreach($destinations as $dest)
                                <option value="{{ $dest->slug }}" {{ request('destination') === $dest->slug ? 'selected' : '' }}>
                                    {{ $dest->name }}, {{ $dest->country }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Category</label>
                        <select name="category" class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg px-3 py-2.5 text-slate-800 focus:outline-none focus:border-indigo-500 cursor-pointer">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price Level -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Price Level</label>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach(['$', '$$', '$$$', '$$$$'] as $price)
                                <label class="border border-slate-200 rounded-lg p-2 text-center text-xs font-bold cursor-pointer hover:border-indigo-500 {{ request('price') === $price ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-slate-50 text-slate-700' }}">
                                    <input type="radio" name="price" value="{{ $price }}" class="sr-only" onchange="this.form.submit()" {{ request('price') === $price ? 'checked' : '' }}>
                                    {{ $price }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Rating Filter -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Minimum Rating</label>
                        <select name="rating" class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg px-3 py-2.5 text-slate-800 focus:outline-none focus:border-indigo-500 cursor-pointer">
                            <option value="">Any Rating</option>
                            <option value="4.5" {{ request('rating') === '4.5' ? 'selected' : '' }}>4.5+ Stars</option>
                            <option value="4.8" {{ request('rating') === '4.8' ? 'selected' : '' }}>4.8+ Stars</option>
                            <option value="4.9" {{ request('rating') === '4.9' ? 'selected' : '' }}>4.9+ Stars</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold shadow-sm transition-all">
                        Apply Filters
                    </button>
                </form>
            </div>
        </div>

        <!-- Listing Results -->
        <div class="lg:col-span-3">
            <!-- Top Controls -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 mb-6 border-b border-slate-200 gap-4">
                <div class="text-xs font-medium text-slate-500">
                    Showing <span class="font-bold text-slate-900">{{ $listings->firstItem() ?? 0 }}-{{ $listings->lastItem() ?? 0 }}</span> of <span class="font-bold text-slate-900">{{ $listings->total() }}</span> properties
                </div>

                <!-- Sort Control -->
                <form action="{{ route('listings.index') }}" method="GET" class="flex items-center gap-2">
                    <!-- Preserve existing filters -->
                    @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
                    @if(request('destination')) <input type="hidden" name="destination" value="{{ request('destination') }}"> @endif
                    @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                    @if(request('price')) <input type="hidden" name="price" value="{{ request('price') }}"> @endif

                    <label class="text-xs text-slate-500 font-medium">Sort by:</label>
                    <select name="sort" onchange="this.form.submit()" class="text-xs bg-white border border-slate-200 rounded-lg px-2.5 py-1.5 font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 cursor-pointer">
                        <option value="featured" {{ request('sort', 'featured') === 'featured' ? 'selected' : '' }}>Featured First</option>
                        <option value="rating" {{ request('sort') === 'rating' ? 'selected' : '' }}>Highest Rated</option>
                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest</option>
                    </select>
                </form>
            </div>

            <!-- Listings Grid -->
            @if($listings->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($listings as $listing)
                        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                            <!-- Image Container -->
                            <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                                <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                
                                <!-- Badges -->
                                <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                                    @if($listing->is_featured)
                                        <span class="px-2.5 py-0.5 rounded text-[10px] font-bold bg-amber-500 text-white uppercase tracking-wider">Featured</span>
                                    @endif
                                    @if($listing->is_verified)
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-600 text-white flex items-center gap-1">
                                            <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Verified
                                        </span>
                                    @endif
                                    @if(!$listing->is_claimed)
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-300">
                                            Unclaimed
                                        </span>
                                    @endif
                                </div>

                                <div class="absolute bottom-3 right-3 px-2.5 py-1 rounded-lg text-xs font-bold bg-slate-900/80 backdrop-blur-md text-white">
                                    {{ $listing->price_level }} &bull; ${{ number_format($listing->price_avg) }}/nt
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between text-xs text-slate-500 mb-1.5">
                                        <span class="font-semibold text-indigo-600">{{ $listing->category->name }}</span>
                                        <span>{{ $listing->destination->name }}</span>
                                    </div>

                                    <h3 class="text-base font-bold text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-1">
                                        <a href="{{ route('listings.show', $listing->slug) }}">{{ $listing->title }}</a>
                                    </h3>

                                    <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                        {{ $listing->tagline }}
                                    </p>
                                </div>

                                <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                                    <!-- Rating -->
                                    <div class="flex items-center gap-1.5">
                                        <div class="flex items-center text-amber-400">
                                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-bold text-slate-800">{{ number_format($listing->rating, 2) }}</span>
                                        <span class="text-[11px] text-slate-400">({{ $listing->review_count }})</span>
                                    </div>

                                    <a href="{{ route('listings.show', $listing->slug) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800">
                                        View Details &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-10">
                    {{ $listings->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center">
                    <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">No matching listings found</h3>
                    <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Try clearing some of your search filters or browse other destinations.</p>
                    <a href="{{ route('listings.index') }}" class="inline-block mt-4 text-xs font-bold text-indigo-600 hover:underline">Clear all filters</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
