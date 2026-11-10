<?php

namespace Tests\Feature;

use App\Models\Claim;
use App\Models\Destination;
use App\Models\Lead;
use App\Models\Listing;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\ListingLeadReceived;
use Tests\TestCase;

class TravelDirectoryTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    /**
     * Test that the directory homepage loads successfully.
     */
    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('VoyageDirectory');
        $response->assertSee('Where will the road take you?');
        $response->assertSee('Places to explore');
        $response->assertSee('Independent stays, locally led experiences');
        $response->assertSee('name="q"', false);
        $response->assertSee('name="destination"', false);
        $response->assertSee('name="category"', false);
        $response->assertSee('role="listbox" aria-label="Choose a destination"', false);
        $response->assertSee('role="listbox" aria-label="Choose an experience"', false);
        $response->assertDontSee('<select', false);
        $response->assertSee('Find your stay');
    }

    /**
     * Test listings index page with search and filtering.
     */
    public function test_listings_index_loads_and_filters(): void
    {
        $listing = Listing::first();
        $this->assertNotNull($listing);

        // General index
        $response = $this->get('/listings');
        $response->assertStatus(200);
        $response->assertSee($listing->title);

        // Destination filter
        $responseFiltered = $this->get('/listings?destination=' . $listing->destination->slug);
        $responseFiltered->assertStatus(200);
        $responseFiltered->assertSee($listing->title);

        $unclaimed = Listing::where('is_claimed', false)->first();
        $claimed = Listing::where('is_claimed', true)->first();
        $this->assertNotNull($unclaimed);
        $this->assertNotNull($claimed);

        $responseUnclaimed = $this->get('/listings?unclaimed=1');
        $responseUnclaimed->assertStatus(200);
        $responseUnclaimed->assertSee($unclaimed->title);
        $responseUnclaimed->assertDontSee($claimed->title);
    }

    /**
     * Test single listing detail page renders properly with schema data.
     */
    public function test_listing_detail_page_renders(): void
    {
        $listing = Listing::first();
        $this->assertNotNull($listing);

        $response = $this->get('/listings/' . $listing->slug);

        $response->assertStatus(200);
        $response->assertSee($listing->title);
        $response->assertSee('LodgingBusiness'); // Schema check
        $response->assertSee('Traveler Reviews');
    }

    /**
     * Test destinations index and individual destination show pages.
     */
    public function test_destinations_pages_render(): void
    {
        $destination = Destination::first();
        $this->assertNotNull($destination);

        $responseIndex = $this->get('/destinations');
        $responseIndex->assertStatus(200);
        $responseIndex->assertSee($destination->name);

        $responseShow = $this->get('/destinations/' . $destination->slug);
        $responseShow->assertStatus(200);
        $responseShow->assertSee($destination->name);
    }

    /**
     * Test monetization and pricing plans page renders.
     */
    public function test_pricing_page_renders(): void
    {
        $response = $this->get('/pricing');

        $response->assertStatus(200);
        $response->assertSee('Pro Merchant Growth');
        $response->assertSee('VIP Destination Partner');
        $response->assertSee('$39');
        $response->assertSee('$89');
    }

    /**
     * Test direct traveler lead inquiry submission.
     */
    public function test_traveler_can_submit_direct_lead_inquiry(): void
    {
        Mail::fake();

        $listing = Listing::first();
        $this->assertNotNull($listing);

        $payload = [
            'guest_name' => 'John Traveler',
            'guest_email' => 'john@traveler.com',
            'guest_phone' => '+1 555-0199',
            'travel_date' => now()->addDays(30)->toDateString(),
            'guests_count' => 2,
            'message' => 'Hello, is there airport transfer included for late arrivals?',
        ];

        $response = $this->post('/listings/' . $listing->id . '/lead', $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('leads', [
            'listing_id' => $listing->id,
            'guest_email' => 'john@traveler.com',
        ]);

        Mail::assertSent(ListingLeadReceived::class, function (ListingLeadReceived $mail) use ($listing): bool {
            return $mail->hasTo($listing->email)
                && $mail->hasReplyTo('john@traveler.com');
        });
    }

    /**
     * Test business owner can submit a claim for an existing listing.
     */
    public function test_business_owner_can_submit_claim_request(): void
    {
        $listing = Listing::where('is_claimed', false)->first() ?? Listing::first();
        $this->assertNotNull($listing);

        $payload = [
            'claimant_name' => 'Hotel General Manager',
            'business_email' => 'gm@luxuryresort.com',
            'phone' => '+62 361 999888',
            'job_title' => 'General Manager',
            'verification_notes' => 'I am the GM, see official domain contact matching this email.',
        ];

        $response = $this->post('/listings/' . $listing->id . '/claim', $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('claims', [
            'listing_id' => $listing->id,
            'business_email' => 'gm@luxuryresort.com',
            'status' => 'pending',
        ]);
    }

    /**
     * Test customer review submission and automatic average rating recalculation.
     */
    public function test_customer_can_submit_review(): void
    {
        $listing = Listing::first();
        $this->assertNotNull($listing);

        $initialReviewCount = $listing->reviews()->count();

        $payload = [
            'author_name' => 'Elena Gilbert',
            'author_email' => 'elena@travel.org',
            'rating' => 5,
            'title' => 'Magical vacation!',
            'comment' => 'One of the best stays of my life. Beautiful views and top tier breakfast.',
        ];

        $response = $this->post('/listings/' . $listing->id . '/review', $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('reviews', [
            'listing_id' => $listing->id,
            'author_email' => 'elena@travel.org',
            'rating' => 5,
        ]);

        $listing->refresh();
        $this->assertEquals($initialReviewCount + 1, $listing->review_count);
        $this->assertEquals(
            round((float) $listing->reviews()->avg('rating'), 2),
            $listing->rating
        );
    }
}
