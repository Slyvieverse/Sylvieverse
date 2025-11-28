<?php

namespace Database\Seeders;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Models\Watchlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@sylvieverse.com'],
            [
                'name'              => 'Sylvie Admin',
                'password'          => Hash::make('admin123'),
                'role'              => 'admin',
                'email_verified_at' => now(),
                'theme_preference'  => 'dark',
            ]
        );

        // 2. 15 Customers
        $customers = collect();
        for ($i = 1; $i <= 15; $i++) {
            $customers->push(User::create([
                'name'              => "User $i",
                'email'             => "user$i@sylvieverse.com",
                'password'          => Hash::make('password123'),
                'role'              => 'customer',
                'email_verified_at' => now(),
                'theme_preference'  => 'auto',
            ]));
        }

        // 3. Categories
        $cats = ['Manhwa', 'Manga', 'Webtoon', 'Light Novel'];
        foreach ($cats as $c) {
            Category::create([
                'name'        => $c,
                'slug'        => str()->slug($c),
                'description' => "Best $c collections",
            ]);
        }

        $categoryIds = Category::pluck('id')->toArray();

        // 4. ADMIN CREATES 30 NORMAL PRODUCTS (shop items – full stock)
        $shopProducts = collect();
        for ($i = 1; $i <= 30; $i++) {
            $shopProducts->push(Product::create([
                'name'           => "Official Volume $i",
                'description'    => "High-quality official release – Volume $i",
                'price'          => round(19.99 + $i * 1.5, 2),
                'category_id'    => $categoryIds[array_rand($categoryIds)],
                'stock_quantity' => rand(15, 100),
                'image_url'      => "https://picsum.photos/seed/shop$i/600/900",
                'is_featured'    => $i <= 10 ? true : false,
                'status'         => 'active',
                'user_id'  => 1
            ]));
        }

        // Admin discounts
        foreach ($shopProducts->random(8) as $p) {
            Discount::create([
                'product_id'  => $p->id,
                'percent_off' => rand(15, 50),
                'start_date'  => now(),
                'end_date'    => now()->addDays(rand(5, 20)),
            ]);
        }

        // 5. CUSTOMERS CREATE AUCTION-ONLY PRODUCTS (1 unit each)
        foreach ($customers->random(12) as $customer) {
            $itemsToCreate = rand(1, 3);

            for ($j = 0; $j < $itemsToCreate; $j++) {
                // Customer creates a unique 1-of-1 product
                $product = Product::create([
                    'name'           => $customer->name . "'s Personal Copy #" . fake()->unique()->numberBetween(100, 9999),
                    'description'    => "Used / signed / rare personal copy. One of a kind.",
                    'price'          => round(rand(5000, 25000) / 100, 2),
                    'category_id'    => $categoryIds[array_rand($categoryIds)],
                    'stock_quantity' => 1,                                 // ONLY ONE
                    'image_url'      => "https://picsum.photos/seed/auc{$customer->id}_$j/600/900",
                    'is_featured'    => false,
                    'status'         => 'active',
                ]);

                // Immediately create auction for this product
                Auction::create([
                    'product_id'       => $product->id,
                    'seller_id'        => $customer->id,
                    'starting_price'   => round($product->price * 0.65, 2),
                    'current_bid'      => null,
                    'bid_count'        => 0,
                    'status'           => 'active',
                    'start_time'       => now()->subHours(rand(1, 72)),
                    'planned_end_time' => now()->addHours(rand(24, 168)),
                ]);
            }
        }

        // 6. Random bids on auctions
        foreach (Auction::all() as $auction) {
            $bidCount = rand(0, 12);
            $current  = $auction->starting_price;

            for ($i = 0; $i < $bidCount; $i++) {
                $bidder = $customers->random();
                $amount = $current + rand(8, 75);

                Bid::create([
                    'auction_id' => $auction->id,
                    'bidder_id'  => $bidder->id,
                    'amount'     => $amount,
                ]);

                $current = $amount;
            }

            if ($bidCount > 0) {
                $auction->update([
                    'current_bid' => $current,
                    'bid_count'   => $bidCount,
                ]);
            }
        }

        // 7. Carts (only shop products)
        foreach ($customers as $customer) {
            $cart = Cart::create(['user_id' => $customer->id]);

            foreach ($shopProducts->random(rand(1, 5)) as $p) {
                CartItem::create([
                    'cart_id'    => $cart->id,
                    'product_id' => $p->id,
                    'quantity'   => rand(1, 3),
                ]);
            }
        }

        // 8. Completed orders + reviews
        foreach ($customers->random(10) as $customer) {
            $order = Order::create([
                'user_id'         => $customer->id,
                'total_amount'    => 0,
                'status'          => 'completed',
                'payment_status'  => 'paid',
                'payment_gateway' => 'stripe',
                'transaction_id'  => 'txn_' . Str::random(20),
                'shipping_address'=> 'Neon District, Cyber City',
                'created_at'      => now()->subDays(rand(1, 45)),
            ]);

            $total = 0;
            foreach ($shopProducts->random(rand(1, 4)) as $p) {
                $qty = rand(1, 2);
                OrderItem::create([
                    'order_id'          => $order->id,
                    'product_id'        => $p->id,
                    'quantity'          => $qty,
                    'price_at_purchase' => $p->price,
                ]);
                $total += $p->price * $qty;
            }
            $order->update(['total_amount' => $total]);

            // Some reviews
            foreach ($order->orderItems()->with('product')->get() as $item) {
                if (rand(0, 1)) {
                    Review::create([
                        'user_id'   => $customer->id,
                        'product_id'=> $item->product_id,
                        'order_id'  => $order->id,
                        'rating'    => rand(4, 5),
                        'comment'   => ['Amazing quality!', 'Fast shipping', 'Love this volume'][array_rand([0,1,2])],
                    ]);
                }
            }
        }

        // 9. Watchlists
        foreach ($customers as $customer) {
            // Watch some shop products
            foreach ($shopProducts->random(6) as $p) {
                Watchlist::firstOrCreate([
                    'user_id'    => $customer->id,
                    'product_id' => $p->id,
                ]);
            }

            // Watch some auctions
            foreach (Auction::inRandomOrder()->take(4)->get() as $auction) {
                Watchlist::firstOrCreate([
                    'user_id'    => $customer->id,
                    'auction_id' => $auction->id,
                ]);
            }
        }

        $this->command->info("SylvieVerse seeded perfectly!");
        $this->command->info("Admin → admin@sylvieverse.com / admin123");
        $this->command->info("30 shop products (admin) + ~25 auction items (customers, 1 stock each)");
    }
}
