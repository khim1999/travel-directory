<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Listing;
use Illuminate\Contracts\View\View;

class DestinationController extends Controller
{
    /**
     * Display all curated travel destinations.
     */
    public function index(): View
    {
        $destinations = Destination::withCount('listings')
            ->orderBy('name')
            ->get();

        return view('destinations.index', compact('destinations'));
    }

    /**
     * Display a specific destination with its listings (Programmatic SEO Landing Page).
     */
    public function show(string $slug): View
    {
        $destination = Destination::withCount('listings')
            ->where('slug', $slug)
            ->firstOrFail();

        $listings = Listing::with(['category', 'amenities'])
            ->where('destination_id', $destination->id)
            ->orderByDesc('is_featured')
            ->orderByDesc('rating')
            ->paginate(9);

        return view('destinations.show', compact('destination', 'listings'));
    }
}
