@extends('layouts.app')

@section('title', "{$listing->title} — {$listing->destination->name}, {$listing->destination->country} | VoyageDirectory")
@section('meta_description', "{$listing->tagline} Located in {$listing->city}, {$listing->destination->country}. Read traveler reviews and send direct inquiries.")

@push('head')
<!-- Programmatic JSON-LD Schema Markup for Google Rich Snippets -->
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'LodgingBusiness',
    'name' => $listing->title,
    'description' => $listing->tagline,
    'image' => $listing->image_url,
    'priceRange' => $listing->price_level,
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $listing->address,
        'addressLocality' => $listing->city,
        'addressCountry' => $listing->country,
    ],
    'aggregateRating' => [
        '@type' => 'AggregateRating',
        'ratingValue' => $listing->rating,
        'reviewCount' => max($listing->review_count, 1),
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8" x-data="{ claimModalOpen: false }">

    <!-- Breadcrumb Navigation -->
    <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6 overflow-x-auto whitespace-nowrap">
        <a href="{{ route('home') }}" class="hover:text-[#c76545]">Home</a>
        <span>/</span>
        <a href="{{ route('destinations.index') }}" class="hover:text-[#c76545]">Destinations</a>
        <span>/</span>
        <a href="{{ route('destinations.show', $listing->destination->slug) }}" class="hover:text-[#c76545]">{{ $listing->destination->name }}</a>
        <span>/</span>
        <a href="{{ route('listings.index', ['category' => $listing->category->slug]) }}" class="hover:text-[#c76545]">{{ $listing->category->name }}</a>
        <span>/</span>
        <span class="text-slate-900 font-semibold truncate">{{ $listing->title }}</span>
    </nav>

    <!-- Unclaimed Business Callout Banner (Key Merchant Acquisition Engine) -->
    @if(!$listing->is_claimed)
        <div class="mb-8 p-4 sm:p-5 rounded-2xl bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-sm">
            <div class="flex items-start sm:items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-amber-950">Are you the owner or manager of {{ $listing->title }}?</h3>
                    <p class="text-xs text-amber-800 mt-0.5">Claim this listing to update your official contact info, upload custom photos, and receive traveler inquiries directly.</p>
                </div>
            </div>
            <button @click="claimModalOpen = true" type="button" class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow transition-all shrink-0">
                Claim This Listing &rarr;
            </button>
        </div>
    @endif

    <!-- Listing Title & Quick Stats Header -->
    <div class="flex flex-col md:flex-row md:items-start justify-between pb-6 border-b border-slate-200 gap-4">
        <div>
            <div class="flex flex-wrap items-center gap-2 mb-2">
                <span class="rounded-full bg-[#f0ede5] px-2.5 py-1 text-xs font-semibold text-[#183b32]">
                    {{ $listing->category->name }}
                </span>
                @if($listing->is_verified)
                    <span class="px-2.5 py-0.5 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Verified Host
                    </span>
                @endif
                @if($listing->is_featured)
                    <span class="px-2.5 py-0.5 rounded-md text-xs font-semibold bg-amber-50 text-amber-700">
                        Featured Spotlight
                    </span>
                @endif
            </div>

            <h1 class="font-serif text-3xl font-medium tracking-tight text-[#183b32] sm:text-5xl">{{ $listing->title }}</h1>
            <p class="text-sm sm:text-base text-slate-600 mt-1 font-medium">{{ $listing->tagline }}</p>

            <div class="flex flex-wrap items-center gap-4 mt-3 text-xs text-slate-500">
                <span class="flex items-center gap-1 text-slate-700 font-semibold">
                    <svg class="w-4 h-4 text-[#c76545]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    </svg>
                    {{ $listing->address ?? $listing->city }}, {{ $listing->destination->name }}
                </span>

                <div class="flex items-center gap-1">
                    <div class="flex text-amber-400">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <span class="font-bold text-slate-800">{{ number_format($listing->rating, 2) }}</span>
                    <span>({{ $listing->review_count }} guest reviews)</span>
                </div>
            </div>
        </div>

        <div class="flex md:flex-col items-baseline md:items-end justify-between shrink-0">
            <span class="text-xs uppercase font-bold text-slate-400">Average Rate</span>
            <div class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                ${{ number_format($listing->price_avg) }}
                <span class="text-xs font-normal text-slate-500">/ night</span>
            </div>
            <span class="text-xs text-slate-400 font-medium">Price tier: {{ $listing->price_level }}</span>
        </div>
    </div>

    <!-- Photo Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-8 rounded-2xl overflow-hidden">
        <div class="md:col-span-2 aspect-[16/10] bg-slate-100 overflow-hidden">
            <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
        </div>
        <div class="hidden md:flex flex-col gap-4">
            @if(!empty($listing->gallery) && count($listing->gallery) > 0)
                @foreach(array_slice($listing->gallery, 0, 2) as $img)
                    <div class="aspect-[16/9] bg-slate-100 overflow-hidden rounded-xl">
                        <img src="{{ $img }}" alt="{{ $listing->title }} gallery" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                @endforeach
            @else
                <div class="aspect-[16/9] bg-slate-100 overflow-hidden rounded-xl">
                    <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?auto=format&fit=crop&w=800&q=80" alt="Detail" class="w-full h-full object-cover">
                </div>
                <div class="aspect-[16/9] bg-slate-100 overflow-hidden rounded-xl">
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=800&q=80" alt="Detail" class="w-full h-full object-cover">
                </div>
            @endif
        </div>
    </div>

    <!-- Main Content & Sidebar Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <!-- Left 2 Columns: Description, Amenities, Reviews -->
        <div class="lg:col-span-2 space-y-10">
            <!-- About Section -->
            <section class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200">
                <h2 class="text-xl font-bold text-slate-900 mb-4">About this Property</h2>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed whitespace-pre-line">
                    {{ $listing->description }}
                </p>
            </section>

            <!-- Amenities & Features -->
            <section class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Key Amenities & Services</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @if($listing->amenities->count() > 0)
                        @foreach($listing->amenities as $amenity)
                            <div class="flex items-center gap-2.5 p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs font-semibold text-slate-800">
                                <span class="h-2 w-2 rounded-full bg-[#c76545]"></span>
                                <span>{{ $amenity->name }}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-full text-xs text-slate-400">Standard luxury amenities included. Contact property for full specifications.</div>
                    @endif
                </div>
            </section>

            <!-- Reviews Section -->
            <section class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200">
                <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-100">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Traveler Reviews</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Real feedback from guests who booked or stayed at this location.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-extrabold text-slate-900">{{ number_format($listing->rating, 2) }}</span>
                        <div class="text-xs text-slate-400">/ 5.0</div>
                    </div>
                </div>

                <!-- Reviews List -->
                <div class="space-y-6">
                    @if($listing->reviews->count() > 0)
                        @foreach($listing->reviews as $review)
                            <div class="pb-6 border-b border-slate-100 last:border-b-0">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-[#e7eee8] text-xs font-bold text-[#183b32]">
                                            {{ substr($review->author_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-900">{{ $review->author_name }}</div>
                                            <div class="text-[10px] text-slate-400">{{ $review->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <div class="flex text-amber-400">
                                        @for($i = 0; $i < $review->rating; $i++)
                                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                @if($review->title)
                                    <h4 class="text-xs font-bold text-slate-800 mb-1">{{ $review->title }}</h4>
                                @endif
                                <p class="text-xs text-slate-600 leading-relaxed">{{ $review->comment }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-xs text-slate-400 italic">No reviews yet. Be the first to leave a review below!</p>
                    @endif
                </div>

                <!-- Submit Review Form -->
                <div class="mt-8 pt-8 border-t border-slate-200">
                    <h3 class="text-sm font-bold text-slate-900 mb-4">Leave a Guest Review</h3>
                    <form action="{{ route('listings.review', $listing->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Your Name</label>
                                <input type="text" name="author_name" required class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg p-2.5">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Email (Private)</label>
                                <input type="email" name="author_email" required class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg p-2.5">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Rating</label>
                                <select name="rating" class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg p-2.5">
                                    <option value="5">5 - Exceptional</option>
                                    <option value="4">4 - Very Good</option>
                                    <option value="3">3 - Average</option>
                                    <option value="2">2 - Disappointing</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Review Headline</label>
                            <input type="text" name="title" placeholder="e.g. Unbelievable sunset views and service" class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg p-2.5">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Detailed Feedback</label>
                            <textarea name="comment" rows="3" required placeholder="Share your experience with future travelers..." class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg p-2.5"></textarea>
                        </div>

                        <button type="submit" class="py-2.5 px-5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition-all">
                            Submit Review
                        </button>
                    </form>
                </div>
            </section>
        </div>

        <!-- Right Column: Sticky Direct Inquiry Lead Capture Form -->
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-lg sticky top-24 space-y-6">
                <div>
                <span class="rounded-full bg-[#f0ede5] px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-[#c76545]">Direct Contact</span>
                    <h3 class="text-lg font-bold text-slate-900 mt-1">Inquire & Book Direct</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Send a direct message to {{ $listing->title }}. No middleman fees or OTA markups.</p>
                </div>

                <form action="{{ route('listings.lead', $listing->id) }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-600 mb-1">Your Full Name</label>
                        <input type="text" name="guest_name" required placeholder="Jane Doe" class="w-full rounded-xl border border-[#e9e5dc] bg-[#fbf9f4] p-2.5 text-xs focus:border-[#183b32] focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-600 mb-1">Email Address</label>
                        <input type="email" name="guest_email" required placeholder="jane@example.com" class="w-full rounded-xl border border-[#e9e5dc] bg-[#fbf9f4] p-2.5 text-xs focus:border-[#183b32] focus:outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-600 mb-1">Travel Date</label>
                            <input type="date" name="travel_date" class="w-full rounded-xl border border-[#e9e5dc] bg-[#fbf9f4] p-2.5 text-xs focus:border-[#183b32] focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-600 mb-1">Guests</label>
                            <input type="number" name="guests_count" value="2" min="1" max="50" class="w-full rounded-xl border border-[#e9e5dc] bg-[#fbf9f4] p-2.5 text-xs focus:border-[#183b32] focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-600 mb-1">Phone / WhatsApp (Optional)</label>
                        <input type="tel" name="guest_phone" placeholder="+1 (555) 000-0000" class="w-full rounded-xl border border-[#e9e5dc] bg-[#fbf9f4] p-2.5 text-xs focus:border-[#183b32] focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-600 mb-1">Your Inquiry Message</label>
                    <textarea name="message" rows="3" required placeholder="Inquire about dates, room availability, airport transfer, or special dietary requirements..." class="w-full rounded-xl border border-[#e9e5dc] bg-[#fbf9f4] p-2.5 text-xs focus:border-[#183b32] focus:outline-none"></textarea>
                    </div>

                    <button type="submit" class="w-full rounded-xl bg-[#183b32] px-4 py-3 text-xs font-bold text-white shadow-md transition-all hover:bg-[#245447] hover:shadow-lg">
                        Send Direct Inquiry &rarr;
                    </button>
                </form>

                <div class="pt-4 border-t border-slate-100 space-y-2 text-xs">
                    @if($listing->phone)
                        <div class="flex items-center gap-2 text-slate-700">
                            <svg class="w-4 h-4 text-[#c76545]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="font-medium">{{ $listing->phone }}</span>
                        </div>
                    @endif

                    @if($listing->website_url)
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#c76545]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            <a href="{{ $listing->website_url }}" target="_blank" rel="noopener {{ in_array($listing->subscription_tier, ['pro', 'vip'], true) ? '' : 'nofollow' }}" class="truncate font-semibold text-[#c76545] hover:underline">
                                Visit Official Website
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Secondary Claim CTA for Owners -->
                <div class="pt-4 border-t border-slate-100 text-center">
                    <button @click="claimModalOpen = true" type="button" class="text-[11px] font-semibold text-slate-500 underline hover:text-[#c76545]">
                        Own this business? Manage or claim listing
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- Related Experiences Section -->
    @if($relatedListings->count() > 0)
        <div class="mt-20 pt-10 border-t border-slate-200">
            <h2 class="text-xl font-bold text-slate-900 mb-6">Similar Stays in {{ $listing->destination->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedListings as $rel)
                    <a href="{{ route('listings.show', $rel->slug) }}" class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition-all group block">
                        <div class="aspect-[16/10] bg-slate-100 overflow-hidden">
                            <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-4">
                            <span class="text-[10px] font-bold uppercase text-[#c76545]">{{ $rel->category->name }}</span>
                            <h3 class="mt-0.5 truncate text-sm font-semibold text-[#183b32] group-hover:text-[#c76545]">{{ $rel->title }}</h3>
                            <div class="mt-2 flex items-center justify-between text-xs text-slate-500">
                                <span class="font-bold text-slate-800">${{ number_format($rel->price_avg) }}/nt</span>
                                <span>★ {{ number_format($rel->rating, 2) }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Claim Listing Modal Component -->
    <div x-show="claimModalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="claimModalOpen" @click="claimModalOpen = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div x-show="claimModalOpen" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full p-6 sm:p-8">
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-900">Claim {{ $listing->title }}</h3>
                    <button @click="claimModalOpen = false" class="text-slate-400 hover:text-slate-600">✕</button>
                </div>

                <p class="text-xs text-slate-500 mb-6">
                    Verify that you represent this property to gain access to the merchant control panel, manage direct inquiry leads, and activate Pro badges.
                </p>

                <form action="{{ route('listings.claim', $listing->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Your Full Name</label>
                        <input type="text" name="claimant_name" required placeholder="Alex Mercer" class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg p-2.5">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Official Business Email</label>
                        <input type="email" name="business_email" required placeholder="manager@yourproperty.com" class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg p-2.5">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Contact Phone</label>
                            <input type="tel" name="phone" placeholder="+1..." class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg p-2.5">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Job Role</label>
                            <input type="text" name="job_title" placeholder="Owner / GM / Marketing" class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg p-2.5">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Verification Note or Proof</label>
                        <textarea name="verification_notes" rows="2" placeholder="Official website, business registry link, or verification note..." class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg p-2.5"></textarea>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3">
                        <button @click="claimModalOpen = false" type="button" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-900">
                            Cancel
                        </button>
                        <button type="submit" class="rounded-xl bg-[#183b32] px-5 py-2.5 text-xs font-bold text-white shadow transition-all hover:bg-[#245447]">
                            Submit Claim Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
