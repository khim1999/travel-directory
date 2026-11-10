# VoyageDirectory — Curated Global Stays, Villas & Adventures

> **Live Interactive Demo:** [https://khim1999.github.io/travel-directory/](https://khim1999.github.io/travel-directory/)  
> **Tech Stack:** Modern PHP 8.5 / Laravel 12 • Tailwind CSS • Alpine.js • SQLite / MySQL • Stripe Billing Ready

An end-to-end, high-performance travel directory and marketplace platform engineered for long-term organic traffic growth, automated merchant acquisition, and recurring subscription revenue (MRR).

---

## 🌟 Key Features

1. **Faceted Search & Discovery Engine**
   - Live filtering by destination (*Bali, Santorini, Kyoto, Amalfi Coast, Banff, Queenstown*), category (*Boutique Hotels, Private Villas, Fine Dining, Guided Adventures, Spas*), price tier (`$`, `$$`, `$$$`, `$$$$`), and minimum star rating.

2. **Automated Merchant Acquisition ("Trojan Horse" Claim Funnel)**
   - Seed listings in targeted destinations as `unclaimed`.
   - Dedicated "Are you the owner?" banner prompting managers to claim their listing via a structured verification modal (`/listings/{id}/claim`).

3. **0% Commission Direct Booking Lead Engine**
   - Sticky direct inquiry form capturing guest name, email, travel dates, guest party size, and message.
   - Bypasses traditional 18–25% OTA fees, delivering 100% direct high-intent leads to merchants.

4. **B2B Monetization & Subscription Tiers (`/pricing`)**
   - **Claim & Basic (Free):** Profile ownership, basic contact info, and review responses.
   - **Pro Merchant Growth ($39/mo):** Verified Gold Badge, direct traveler lead capture, and do-follow SEO backlink.
   - **VIP Destination Partner ($89/mo):** Top-of-Category Sticky Spotlight, Homepage Featured spot, and monthly newsletter promotion.

5. **Programmatic SEO & Rich Snippets**
   - Dynamic landing pages under `/destinations/{slug}` with localized content.
   - Valid JSON-LD `schema.org/LodgingBusiness` and `schema.org/AggregateRating` markup for Google search rich snippets.

6. **Verified Guest Reviews**
   - 1–5 star rating reviews with automatic recalculation of average ratings and review counts.

---

## 🧪 Automated Test Suite (100% Passing)

```bash
php -d xdebug.mode=off vendor/phpunit/phpunit/phpunit
```
```
Tests:    10 passed (39 assertions)
Duration: 1.49s
```

All core routes, models, search filters, lead submissions, claim workflows, and review recalculations are fully covered by automated feature tests.

---

## 🚀 Local Setup & Installation

```bash
# 1. Clone repository
git clone https://github.com/khim1999/travel-directory.git
cd travel-directory

# 2. Install dependencies
composer install
npm install

# 3. Environment & Database
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed

# 4. Compile frontend & run server
npm run build
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.
