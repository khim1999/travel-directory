<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Category;
use App\Models\Claim;
use App\Models\Destination;
use App\Models\Lead;
use App\Models\Listing;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Browse and filter travel listings.
     */
    public function index(Request $request): View
    {
        $query = Listing::with(['destination', 'category', 'amenities']);

        // Keyword Search
        if ($request->filled('q')) {
            $keyword = trim($request->input('q'));
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('tagline', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('city', 'like', "%{$keyword}%");
            });
        }

        // Destination Filter
        if ($request->filled('destination')) {
            $query->whereHas('destination', function ($q) use ($request) {
                $q->where('slug', $request->input('destination'));
            });
        }

        // Category Filter
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->input('category'));
            });
        }

        // Price Level Filter
        if ($request->filled('price')) {
            $query->where('price_level', $request->input('price'));
        }

        // Minimum Rating Filter
        if ($request->filled('rating')) {
            $query->where('rating', '>=', (float) $request->input('rating'));
        }

        // Sorting
        $sort = $request->input('sort', 'featured');
        if ($sort === 'rating') {
            $query->orderByDesc('rating')->orderByDesc('review_count');
        } elseif ($sort === 'price_asc') {
            $query->orderBy('price_avg');
        } elseif ($sort === 'price_desc') {
            $query->orderByDesc('price_avg');
        } elseif ($sort === 'newest') {
            $query->latest();
        } else {
            $query->orderByDesc('is_featured')
                ->orderByDesc('rating');
        }

        $listings = $query->paginate(9)->withQueryString();
        $destinations = Destination::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $amenities = Amenity::orderBy('name')->get();

        return view('listings.index', compact(
            'listings',
            'destinations',
            'categories',
            'amenities'
        ));
    }

    /**
     * Display a single travel listing detail page.
     */
    public function show(string $slug): View
    {
        $listing = Listing::with(['destination', 'category', 'amenities', 'reviews'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedListings = Listing::with(['destination', 'category'])
            ->where('id', '!=', $listing->id)
            ->where(function ($q) use ($listing) {
                $q->where('destination_id', $listing->destination_id)
                    ->orWhere('category_id', $listing->category_id);
            })
            ->take(3)
            ->get();

        return view('listings.show', compact('listing', 'relatedListings'));
    }

    /**
     * Submit an ownership claim for a listing.
     */
    public function claim(Request $request, Listing $listing): RedirectResponse
    {
        $validated = $request->validate([
            'claimant_name' => ['required', 'string', 'max:255'],
            'business_email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'job_title' => ['nullable', 'string', 'max:100'],
            'verification_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $validated['listing_id'] = $listing->id;
        $validated['status'] = 'pending';

        Claim::create($validated);

        return back()->with('success', 'Your claim request has been submitted! Our verification team will contact you within 24 hours to confirm ownership and activate your Pro Merchant badge.');
    }

    /**
     * Send a direct inquiry lead to the business.
     */
    public function lead(Request $request, Listing $listing): RedirectResponse
    {
        $validated = $request->validate([
            'guest_name' => ['required', 'string', 'max:255'],
            'guest_email' => ['required', 'email', 'max:255'],
            'guest_phone' => ['nullable', 'string', 'max:50'],
            'travel_date' => ['nullable', 'date'],
            'guests_count' => ['required', 'integer', 'min:1', 'max:50'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $validated['listing_id'] = $listing->id;
        $validated['status'] = 'new';

        Lead::create($validated);

        return back()->with('success', 'Your inquiry has been sent directly to ' . $listing->title . '! They will respond to your email shortly.');
    }

    /**
     * Submit a guest review for a listing.
     */
    public function review(Request $request, Listing $listing): RedirectResponse
    {
        $validated = $request->validate([
            'author_name' => ['required', 'string', 'max:255'],
            'author_email' => ['required', 'email', 'max:255'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['nullable', 'string', 'max:255'],
            'comment' => ['required', 'string', 'max:2000'],
        ]);

        $validated['listing_id'] = $listing->id;
        $validated['is_approved'] = true;

        Review::create($validated);

        // Recalculate average rating & review count
        $reviews = $listing->reviews()->get();
        $avg = $reviews->avg('rating');

        $listing->update([
            'rating' => round($avg, 2),
            'review_count' => $listing->review_count + 1,
        ]);

        return back()->with('success', 'Thank you! Your verified review has been published.');
    }
}
