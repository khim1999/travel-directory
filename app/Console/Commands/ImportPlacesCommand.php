<?php

namespace App\Console\Commands;

use App\Models\Amenity;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Listing;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImportPlacesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'directory:import-places 
                            {destination : The slug of the destination (e.g. bali, santorini, tokyo)}
                            {--category= : Specific category slug (optional)}
                            {--limit=5 : Number of places to ingest}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ingest and seed business places for automated claim-listing outreach';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $destinationSlug = $this->argument('destination');
        $destination = Destination::firstOrCreate(
            ['slug' => $destinationSlug],
            [
                'name' => Str::title(str_replace('-', ' ', $destinationSlug)),
                'country' => 'Global',
                'tagline' => 'Curated travel experiences and boutique accommodations',
                'description' => 'Discovered through our automated directory ingestion pipeline.',
                'image_url' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80',
            ]
        );

        $categorySlug = $this->option('category') ?? 'boutique-hotels';
        $category = Category::where('slug', $categorySlug)->first() ?? Category::first();

        if (!$category) {
            $this->error("Category not found. Run database seeder first.");
            return self::FAILURE;
        }

        $limit = (int) $this->option('limit');
        $this->info("Ingesting {$limit} places for {$destination->name} under category: {$category->name}...");

        $sampleNames = [
            'Boutique Cliffside Eco-Resort',
            'Azure Ocean Bay Villas',
            'Heritage Garden Sanctuary',
            'Sunset Horizon Retreat',
            'Secret Palm Wellness Lodge',
        ];

        $amenities = Amenity::take(4)->pluck('id')->toArray();
        $importedCount = 0;

        for ($i = 0; $i < min($limit, count($sampleNames)); $i++) {
            $title = "{$destination->name} " . $sampleNames[$i];
            $slug = Str::slug($title . '-' . rand(100, 999));

            $listing = Listing::firstOrCreate(
                ['slug' => $slug],
                [
                    'destination_id' => $destination->id,
                    'category_id' => $category->id,
                    'title' => $title,
                    'tagline' => "Handpicked destination stay in the heart of {$destination->name}",
                    'description' => "Discovered via our automated directory ingestion engine. This property features premium amenities, verified location coordinates, and direct guest communication channels.",
                    'price_level' => '$$$',
                    'price_avg' => rand(250, 650),
                    'city' => $destination->name,
                    'country' => $destination->country,
                    'latitude' => 0.0,
                    'longitude' => 0.0,
                    'phone' => '+1 (555) ' . rand(100, 999) . '-' . rand(1000, 9999),
                    'email' => 'contact@' . Str::slug($title) . '.test',
                    'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
                    'rating' => 4.85,
                    'review_count' => rand(15, 60),
                    'is_featured' => false,
                    'is_verified' => false,
                    'is_claimed' => false, // Crucial: seeded as unclaimed to trigger the claim funnel
                    'subscription_tier' => 'free',
                ]
            );

            if (!empty($amenities)) {
                $listing->amenities()->sync($amenities);
            }

            $importedCount++;
            $this->line("  ✓ Ingested unclaimed listing: <comment>{$listing->title}</comment>");
        }

        $this->newLine();
        $this->info("Successfully ingested {$importedCount} listings for {$destination->name}!");
        $this->info("All listings are marked as 'unclaimed' and ready for the automated 'Claim Your Profile' merchant acquisition campaign.");

        return self::SUCCESS;
    }
}
