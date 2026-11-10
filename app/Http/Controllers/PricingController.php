<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PricingController extends Controller
{
    /**
     * Display subscription & monetization plans for travel business owners.
     */
    public function __invoke(): View
    {
        $plans = [
            [
                'name' => 'Claim & Basic',
                'price' => 0,
                'cadence' => 'Forever Free',
                'description' => 'For individual tour guides and boutique operators claiming their basic public directory profile.',
                'features' => [
                    'Claim your business profile',
                    'Update opening hours & contact details',
                    'Standard directory search indexing',
                    'Direct customer review responses',
                    'Standard customer support',
                ],
                'highlight' => false,
                'cta' => 'Claim Free Listing',
                'cta_url' => '/listings',
            ],
            [
                'name' => 'Pro Merchant Growth',
                'price' => 39,
                'cadence' => 'per month',
                'description' => 'For verified boutique hotels, villa owners, and restaurants wanting direct booking leads and top search priority.',
                'features' => [
                    'Everything in Basic',
                    'Verified Gold Trust Badge',
                    'Direct traveler lead inquiry capture form',
                    'Do-Follow SEO backlink to your website',
                    'Priority category search placement',
                    'Zero booking commissions',
                    'Monthly performance analytics (views & clicks)',
                ],
                'highlight' => true,
                'badge' => 'Most Popular for High ROI',
                'cta' => 'Start 14-Day Free Trial',
                'cta_url' => '#contact-sales',
            ],
            [
                'name' => 'VIP Destination Partner',
                'price' => 89,
                'cadence' => 'per month',
                'description' => 'For premier luxury resorts, private jet/yacht charters, and iconic destination attractions.',
                'features' => [
                    'Everything in Pro Merchant',
                    'Top-of-Category Sticky Spotlight (Always #1)',
                    'Homepage Featured Section inclusion',
                    'Full high-res photo & video gallery (unlimited)',
                    'Monthly spotlight feature in traveler newsletter',
                    'Dedicated account concierge & custom promotion',
                ],
                'highlight' => false,
                'cta' => 'Become a VIP Partner',
                'cta_url' => '#contact-sales',
            ],
        ];

        return view('pricing', compact('plans'));
    }
}
