<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Listing;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default Admin / Demo User
        User::firstOrCreate(
            ['email' => 'admin@traveldirectory.test'],
            [
                'name' => 'Directory Admin',
                'password' => bcrypt('password'),
            ]
        );

        // 1. Destinations
        $destinations = [
            [
                'name' => 'Bali',
                'slug' => 'bali',
                'country' => 'Indonesia',
                'tagline' => 'Island of the Gods, tropical beaches & spiritual serenity',
                'description' => 'From the emerald terraced rice fields of Ubud to the cliffside temples of Uluwatu, Bali blends spiritual enchantment with world-class hospitality.',
                'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
            ],
            [
                'name' => 'Santorini',
                'slug' => 'santorini',
                'country' => 'Greece',
                'tagline' => 'Iconic whitewashed cliffs and Aegean sunsets',
                'description' => 'Famous for cliff-hanging whitewashed villas, cobalt blue domes, volcanic beaches, and the world’s most celebrated sunset vistas over the caldera.',
                'image_url' => 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
            ],
            [
                'name' => 'Kyoto',
                'slug' => 'kyoto',
                'country' => 'Japan',
                'tagline' => 'Historic shrines, tranquil zen gardens & tea traditions',
                'description' => 'Japan’s cultural heart features thousands of classical Buddhist temples, serene zen gardens, historic geisha districts in Gion, and traditional ryokans.',
                'image_url' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
            ],
            [
                'name' => 'Amalfi Coast',
                'slug' => 'amalfi-coast',
                'country' => 'Italy',
                'tagline' => 'Dramatic coastal cliffs, pastel villages & Italian elegance',
                'description' => 'A UNESCO World Heritage coastline perched dramatically over turquoise Mediterranean waters, lined with fragrant lemon groves and pastel cliffside towns.',
                'image_url' => 'https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
            ],
            [
                'name' => 'Banff',
                'slug' => 'banff',
                'country' => 'Canada',
                'tagline' => 'Glacial turquoise lakes & majestic Rocky Mountains',
                'description' => 'Set in the heart of the Canadian Rockies, Banff National Park is home to radiant turquoise glacial lakes, alpine hikes, and luxury mountain lodges.',
                'image_url' => 'https://images.unsplash.com/photo-1503614472-8c93d56e92ce?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => false,
            ],
            [
                'name' => 'Queenstown',
                'slug' => 'queenstown',
                'country' => 'New Zealand',
                'tagline' => 'The world capital of adventure, alpine lakes & pinot noir',
                'description' => 'Nestled on the shores of Lake Wakatipu against the dramatic Southern Alps, Queenstown offers world-class skiing, fjord cruises, and boutique wineries.',
                'image_url' => 'https://images.unsplash.com/photo-1507699622108-4be3abd695ad?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => false,
            ],
        ];

        $destinationModels = [];
        foreach ($destinations as $d) {
            $destinationModels[$d['slug']] = Destination::create($d);
        }

        // 2. Categories
        $categories = [
            [
                'name' => 'Boutique Hotels & Resorts',
                'slug' => 'boutique-hotels',
                'icon' => 'building-office-2',
                'description' => 'Handpicked design hotels, luxury eco-resorts, and heritage retreats.',
            ],
            [
                'name' => 'Private Villas & Chalets',
                'slug' => 'villas-and-chalets',
                'icon' => 'home-modern',
                'description' => 'Exclusive hillside villas, infinity-pool hideaways, and alpine chalets.',
            ],
            [
                'name' => 'Fine Dining & Gastronomy',
                'slug' => 'dining-and-gastronomy',
                'icon' => 'sparkles',
                'description' => 'Michelin-starred restaurants, cliffside dining, and farm-to-table experiences.',
            ],
            [
                'name' => 'Tours & Outdoor Adventures',
                'slug' => 'tours-and-adventures',
                'icon' => 'map',
                'description' => 'Guided private treks, scuba diving, boat charters, and cultural tours.',
            ],
            [
                'name' => 'Wellness & Holistic Spas',
                'slug' => 'wellness-and-spas',
                'icon' => 'heart',
                'description' => 'Ayurvedic sanctuaries, thermal springs, yoga pavilions, and hydrotherapy spas.',
            ],
            [
                'name' => 'Cultural Workshops & Arts',
                'slug' => 'culture-and-arts',
                'icon' => 'ticket',
                'description' => 'Traditional tea ceremonies, culinary masterclasses, and artisan craft studios.',
            ],
        ];

        $categoryModels = [];
        foreach ($categories as $c) {
            $categoryModels[$c['slug']] = Category::create($c);
        }

        // 3. Amenities
        $amenities = [
            ['name' => 'High-Speed Wi-Fi', 'slug' => 'wifi', 'icon' => 'wifi'],
            ['name' => 'Infinity Pool', 'slug' => 'pool', 'icon' => 'water'],
            ['name' => 'Panoramic Ocean/Mountain View', 'slug' => 'view', 'icon' => 'eye'],
            ['name' => 'Complimentary Gourmet Breakfast', 'slug' => 'breakfast', 'icon' => 'coffee'],
            ['name' => 'Pet-Friendly', 'slug' => 'pets', 'icon' => 'heart'],
            ['name' => 'Airport Private Chauffeur', 'slug' => 'shuttle', 'icon' => 'truck'],
            ['name' => 'Climate Control / AC', 'slug' => 'ac', 'icon' => 'sparkles'],
            ['name' => 'Holistic Spa & Steam Room', 'slug' => 'spa', 'icon' => 'sparkles'],
        ];

        $amenityModels = [];
        foreach ($amenities as $a) {
            $amenityModels[$a['slug']] = Amenity::create($a);
        }

        // 4. Curated Travel Listings
        $listings = [
            [
                'destination_id' => $destinationModels['bali']->id,
                'category_id' => $categoryModels['boutique-hotels']->id,
                'title' => 'Mandapa, a Ritz-Carlton Reserve',
                'slug' => 'mandapa-ritz-carlton-reserve-ubud',
                'tagline' => 'Secluded luxury sanctuary along the sacred Ayung River',
                'description' => 'Nestled amidst the lush jungle canopy and rolling hills of Ubud, Mandapa offers an intimate sensory journey. Guests enjoy standalone villas featuring traditional Balinese architecture, personal butler service (Patih), open-air dining pavilions by the river, and bespoke holistic healing rituals.',
                'price_level' => '$$$$',
                'price_avg' => 850.00,
                'address' => 'Jl. Raya Kedewatan, Banjar Kedewatan',
                'city' => 'Ubud',
                'country' => 'Indonesia',
                'latitude' => -8.4878,
                'longitude' => 115.2443,
                'phone' => '+62 361 4792777',
                'email' => 'reservations@mandapareserve.com',
                'website_url' => 'https://www.ritzcarlton.com/mandapa',
                'image_url' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1540541338287-41700207dee6?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=800&q=80',
                ],
                'rating' => 4.95,
                'review_count' => 142,
                'is_featured' => true,
                'is_verified' => true,
                'is_claimed' => true,
                'subscription_tier' => 'vip',
                'amenities' => ['wifi', 'pool', 'view', 'breakfast', 'shuttle', 'spa', 'ac'],
            ],
            [
                'destination_id' => $destinationModels['santorini']->id,
                'category_id' => $categoryModels['boutique-hotels']->id,
                'title' => 'Canaves Oia Suites & Spa',
                'slug' => 'canaves-oia-suites-santorini',
                'tagline' => 'Minimalist cave suites carved into the Oia Caldera cliffs',
                'description' => 'Carved into the volcanic cliffs of Oia, Canaves Oia Suites combines traditional Cycladic cliff-architecture with refined ultra-modern minimalism. Each private suite features private plunge pools overlooking the Aegean Sea, gourmet dining, and catamaran excursions.',
                'price_level' => '$$$$',
                'price_avg' => 920.00,
                'address' => 'Main Street, Oia',
                'city' => 'Santorini',
                'country' => 'Greece',
                'latitude' => 36.4618,
                'longitude' => 25.3753,
                'phone' => '+30 2286 071453',
                'email' => 'info@canaves.com',
                'website_url' => 'https://canaves.com',
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
                ],
                'rating' => 4.98,
                'review_count' => 218,
                'is_featured' => true,
                'is_verified' => true,
                'is_claimed' => true,
                'subscription_tier' => 'vip',
                'amenities' => ['wifi', 'pool', 'view', 'breakfast', 'spa', 'ac'],
            ],
            [
                'destination_id' => $destinationModels['kyoto']->id,
                'category_id' => $categoryModels['boutique-hotels']->id,
                'title' => 'Hoshinoya Kyoto',
                'slug' => 'hoshinoya-kyoto-arashiyama',
                'tagline' => 'A riverside pavilion retreat accessed only by traditional wooden boat',
                'description' => 'Located along the Oi River in the scenic Arashiyama district, Hoshinoya is a century-old riverside ryokan restored into a peerless luxury sanctuary. Guests arrive via riverboat, experience seasonal Kaiseki dinners, morning meditation with Zen monks, and traditional tatami suites.',
                'price_level' => '$$$$',
                'price_avg' => 780.00,
                'address' => '11-2 Arashiyama Genrokuzancho, Nishikyo Ward',
                'city' => 'Kyoto',
                'country' => 'Japan',
                'latitude' => 35.0116,
                'longitude' => 135.6778,
                'phone' => '+81 50-3134-8091',
                'email' => 'stay@hoshinoya.com',
                'website_url' => 'https://hoshinoya.com/kyoto',
                'image_url' => 'https://images.unsplash.com/photo-1503899036084-c55cdd92da26?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1528164344705-475426879c0d?auto=format&fit=crop&w=800&q=80',
                ],
                'rating' => 4.92,
                'review_count' => 97,
                'is_featured' => true,
                'is_verified' => true,
                'is_claimed' => true,
                'subscription_tier' => 'pro',
                'amenities' => ['wifi', 'view', 'breakfast', 'ac', 'shuttle'],
            ],
            [
                'destination_id' => $destinationModels['amalfi-coast']->id,
                'category_id' => $categoryModels['dining-and-gastronomy']->id,
                'title' => 'Ristorante La Sponda',
                'slug' => 'ristorante-la-sponda-positano',
                'tagline' => 'Illuminated by 400 candles every evening overlooking Positano',
                'description' => 'Set inside the historic Le Sirenuse hotel in Positano, La Sponda is one of the most romantic dining rooms on earth. Every evening, over 400 candles illuminate the vine-draped arches while classical Neapolitan mandolinists serenade diners savoring Mediterranean haute cuisine.',
                'price_level' => '$$$',
                'price_avg' => 160.00,
                'address' => 'Via Cristoforo Colombo 30',
                'city' => 'Positano',
                'country' => 'Italy',
                'latitude' => 40.6291,
                'longitude' => 14.4856,
                'phone' => '+39 089 875066',
                'email' => 'info@sirenuse.it',
                'website_url' => 'https://sirenuse.it/en/la-sponda',
                'image_url' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80',
                ],
                'rating' => 4.88,
                'review_count' => 164,
                'is_featured' => true,
                'is_verified' => true,
                'is_claimed' => true,
                'subscription_tier' => 'pro',
                'amenities' => ['view', 'wifi', 'ac'],
            ],
            [
                'destination_id' => $destinationModels['bali']->id,
                'category_id' => $categoryModels['villas-and-chalets']->id,
                'title' => 'Uluwatu Cliffside Sunset Villa',
                'slug' => 'uluwatu-cliffside-sunset-villa',
                'tagline' => 'Private 4-bedroom cliff villa with cantilevered glass infinity pool',
                'description' => 'Perched 150 meters above the Indian Ocean, this architectural masterpiece features an open-air pavilion, four king suites with ocean panoramas, a private chef, dedicated yoga shala, and sunset views that stretch over the horizon.',
                'price_level' => '$$$',
                'price_avg' => 620.00,
                'address' => 'Jl. Pantai Suluban',
                'city' => 'Uluwatu',
                'country' => 'Indonesia',
                'latitude' => -8.8291,
                'longitude' => 115.0844,
                'phone' => '+62 361 889211',
                'email' => 'contact@uluwatuvillas.test',
                'website_url' => null,
                'image_url' => 'https://images.unsplash.com/photo-1613977257363-707ba9348227?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
                ],
                'rating' => 4.85,
                'review_count' => 38,
                'is_featured' => false,
                'is_verified' => false,
                'is_claimed' => false, // UNCLAIMED - Perfect for "Claim This Listing" demo!
                'subscription_tier' => 'free',
                'amenities' => ['wifi', 'pool', 'view', 'breakfast', 'pets', 'ac'],
            ],
            [
                'destination_id' => $destinationModels['banff']->id,
                'category_id' => $categoryModels['boutique-hotels']->id,
                'title' => 'Fairmont Chateau Lake Louise',
                'slug' => 'fairmont-chateau-lake-louise',
                'tagline' => 'World-renowned heritage resort on the shores of glacial Lake Louise',
                'description' => 'Surrounded by soaring mountain peaks and the majestic Victoria Glacier, this historic Canadian chateau provides four-season alpine adventures including canoeing on emerald waters, world-class backcountry skiing, and fireside fondue dining.',
                'price_level' => '$$$$',
                'price_avg' => 710.00,
                'address' => '111 Lake Louise Drive',
                'city' => 'Lake Louise',
                'country' => 'Canada',
                'latitude' => 51.4177,
                'longitude' => -116.2168,
                'phone' => '+1 403 522 3511',
                'email' => 'chateaulakelouise@fairmont.com',
                'website_url' => 'https://www.fairmont.com/lake-louise',
                'image_url' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=800&q=80',
                ],
                'rating' => 4.90,
                'review_count' => 312,
                'is_featured' => true,
                'is_verified' => true,
                'is_claimed' => true,
                'subscription_tier' => 'pro',
                'amenities' => ['wifi', 'view', 'breakfast', 'spa', 'shuttle'],
            ],
            [
                'destination_id' => $destinationModels['queenstown']->id,
                'category_id' => $categoryModels['tours-and-adventures']->id,
                'title' => 'Milford Sound Heli-Flight & Glacier Landing',
                'slug' => 'milford-sound-heli-flight-glacier-landing',
                'tagline' => 'VIP scenic helicopter tour over Fiordland waterfalls & alpine ice',
                'description' => 'Soar above the awe-inspiring glaciers, dramatic granite spires, and cascading waterfalls of Fiordland National Park. Includes an exclusive landing on an ancient alpine glacier with panoramic champagne toast.',
                'price_level' => '$$$',
                'price_avg' => 450.00,
                'address' => 'Lucas Place, Queenstown Airport',
                'city' => 'Queenstown',
                'country' => 'New Zealand',
                'latitude' => -45.0211,
                'longitude' => 168.7423,
                'phone' => '+64 3 442 3016',
                'email' => 'flight@heliadventures.co.nz',
                'website_url' => null,
                'image_url' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=800&q=80',
                ],
                'rating' => 4.96,
                'review_count' => 84,
                'is_featured' => false,
                'is_verified' => false,
                'is_claimed' => false, // UNCLAIMED listing
                'subscription_tier' => 'free',
                'amenities' => ['view', 'shuttle'],
            ],
            [
                'destination_id' => $destinationModels['kyoto']->id,
                'category_id' => $categoryModels['culture-and-arts']->id,
                'title' => 'Gion Zen Tea & Ceremony Masterclass',
                'slug' => 'gion-zen-tea-ceremony-masterclass',
                'tagline' => 'Authentic chanoyu tea ritual inside a 200-year-old machiya house',
                'description' => 'Step inside an authentic preserved machiya in Gion. Learn the intricate meditative philosophy of Omotesenke tea preparation under the guidance of a 3rd-generation tea master. Includes ceremonial grade matcha and handmade wagashi sweets.',
                'price_level' => '$$',
                'price_avg' => 85.00,
                'address' => 'Miyagawacho, Higashiyama Ward',
                'city' => 'Kyoto',
                'country' => 'Japan',
                'latitude' => 35.0004,
                'longitude' => 135.7725,
                'phone' => '+81 75 561 0200',
                'email' => 'info@kyototeamaster.jp',
                'website_url' => null,
                'image_url' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [],
                'rating' => 4.97,
                'review_count' => 61,
                'is_featured' => false,
                'is_verified' => true,
                'is_claimed' => true,
                'subscription_tier' => 'pro',
                'amenities' => ['wifi', 'ac'],
            ],
            [
                'destination_id' => $destinationModels['amalfi-coast']->id,
                'category_id' => $categoryModels['villas-and-chalets']->id,
                'title' => 'Villa TreVille Cliffside Haven',
                'slug' => 'villa-treville-positano-amalfi',
                'tagline' => 'Exclusive estate once owned by legendary director Franco Zeffirelli',
                'description' => 'A boutique jewel draped over dramatic cliffs with private sea elevator access, panoramic terraces facing Positano, custom ceramic tile decor, and farm-fresh Mediterranean cuisine.',
                'price_level' => '$$$$',
                'price_avg' => 1250.00,
                'address' => 'Via Arienzo 30',
                'city' => 'Positano',
                'country' => 'Italy',
                'latitude' => 40.6273,
                'longitude' => 14.4921,
                'phone' => '+39 089 8122401',
                'email' => 'concierge@villatreville.com',
                'website_url' => 'https://villatreville.com',
                'image_url' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [],
                'rating' => 4.99,
                'review_count' => 88,
                'is_featured' => true,
                'is_verified' => true,
                'is_claimed' => true,
                'subscription_tier' => 'vip',
                'amenities' => ['wifi', 'pool', 'view', 'breakfast', 'spa', 'shuttle', 'ac'],
            ],
        ];

        foreach ($listings as $listingData) {
            $amenitySlugs = $listingData['amenities'] ?? [];
            unset($listingData['amenities']);

            $listing = Listing::create($listingData);

            // Attach amenities
            $amenityIds = [];
            foreach ($amenitySlugs as $slug) {
                if (isset($amenityModels[$slug])) {
                    $amenityIds[] = $amenityModels[$slug]->id;
                }
            }
            if (!empty($amenityIds)) {
                $listing->amenities()->sync($amenityIds);
            }

            // Seed realistic reviews
            Review::create([
                'listing_id' => $listing->id,
                'author_name' => 'Sarah Jenkins',
                'author_email' => 'sarah.j@traveler.com',
                'rating' => 5,
                'title' => 'Unbelievable experience, exceeded expectations!',
                'comment' => 'From the moment we arrived, the service, atmosphere, and attention to detail were world-class. Worth every single penny.',
                'is_approved' => true,
            ]);

            Review::create([
                'listing_id' => $listing->id,
                'author_name' => 'Marco Rossi',
                'author_email' => 'marco@adventures.it',
                'rating' => 5,
                'title' => 'Stunning location and unforgettable hospitality',
                'comment' => 'We spent 4 days here during our honeymoon. The views are even more breathtaking than the pictures show.',
                'is_approved' => true,
            ]);
        }
    }
}
