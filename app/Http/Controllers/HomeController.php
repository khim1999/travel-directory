<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Listing;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display the travel directory homepage.
     */
    public function __invoke(): View
    {
        $featuredDestinations = Destination::where('is_featured', true)
            ->withCount('listings')
            ->take(4)
            ->get();

        $featuredListings = Listing::with(['destination', 'category'])
            ->where('is_featured', true)
            ->take(6)
            ->get();

        $categories = Category::withCount('listings')->get();

        $allDestinations = Destination::orderBy('name')->get();

        $stats = [
            'total_listings' => Listing::count(),
            'total_destinations' => Destination::count(),
            'verified_merchants' => Listing::where('is_verified', true)->count(),
            'average_rating' => round(Listing::avg('rating') ?? 4.9, 1),
        ];

        return view('home', compact(
            'featuredDestinations',
            'featuredListings',
            'categories',
            'allDestinations',
            'stats'
        ));
    }
}
