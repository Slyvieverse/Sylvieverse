<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Notification;
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
    //     // Create Admin User
    //     $admin = User::firstOrCreate([
    //         'name' => 'Admin User',
    //         'email' => 'admin@sylvieverse.com',
    //     ], [
    //         'password' => Hash::make('admin123'),
    //         'role' => 'admin',
    //         'email_verified_at' => now(),
    //         'profile_picture' => 'profile_pictures/admin.jpg',
    //         'theme_preference' => 'dark',
    //     ]);

        // Create Customer Users
        $customers = [];
        for ($i = 16; $i <= 25; $i++) {
            $customers[] = User::create([
                'name' => "Customer $i",
                'email' => "customer$i@sylvieverse.com",
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'email_verified_at' => now(),
                'profile_picture' => "profile_pictures/customer$i.jpg",
                'theme_preference' => 'auto',
            ]);
        }

    //     // Create Addresses for Users
    //     foreach ([$admin, ...$customers] as $user) {
    //         Address::create([
    //             'user_id' => $user->id,
    //             'address_line1' => "Neon Street $user->id",
    //             'address_line2' => 'Apartment ' . rand(1, 100),
    //             'city' => 'Cyber City',
    //             'state' => 'Neo',
    //             'postal_code' => '12345',
    //             'country' => 'Cyberland',
    //         ]);
    //     }

        // Create Categories
        $categories = [
            ['name' => 'Manhwa', 'description' => 'Korean comics with vibrant art', 'slug' => 'manhwa'],
            ['name' => 'Manga', 'description' => 'Japanese comics and graphic novels', 'slug' => 'manga'],
            ['name' => 'Webtoon', 'description' => 'Digital comics optimized for mobile', 'slug' => 'webtoon'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Create Products
        $products = [];
        $categoryIds = Category::pluck('id')->toArray();
        for ($i = 1; $i <= 20; $i++) {
            $products[] = Product::create([
                'name' => "Comic Volume $i",
                'description' => "A collectible comic volume with cyberpunk themes, volume $i.",
                'price' => 19.99 + ($i * 2),
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'stock_quantity' => rand(5, 50),
                'image_url' => "product_images/comic-$i.jpg",
                'is_featured' => $i % 3 === 0,
                'status' => 'active',
            ]);
        }

        // Create Discounts
        foreach ($products as $index => $product) {
            if ($index % 4 === 0) {
                Discount::create([
                    'product_id' => $product->id,
                    'category_id' => null,
                    'percent_off' => rand(10, 50),
                    'fixed_off' => null,
                    'start_date' => now(),
                    'end_date' => now()->addDays(7),
                ]);
            }
            if ($index % 5 === 0) {
                Discount::create([
                    'product_id' => null,
                    'category_id' => $product->category_id,
                    'percent_off' => rand(5, 20),
                    'fixed_off' => null,
                    'start_date' => now(),
                    'end_date' => now()->addDays(10),
                ]);
            }
        }

        // Create Auctions
        $auctions = [];
        foreach ($products as $index => $product) {
            if ($index % 2 === 0) {
                $auctions[] = Auction::create([
                    'product_id' => $product->id,
                    'seller_id' => $customers[array_rand($customers)]->id,
                    'starting_price' => $product->price * 0.8,
                    'current_bid' => null,
                    'bid_count' => 0,
                    'status' => 'active',
                    'start_time' => now(),
                    'planned_end_time' => now()->addDays(3),
                    'actual_end_time' => null,
                ]);
            }
        }

        // Create Bids
        foreach ($auctions as $auction) {
            $bidder = $customers[array_rand($customers)];
            $bidAmount = $auction->starting_price + rand(5, 20);
            Bid::create([
                'auction_id' => $auction->id,
                'bidder_id' => $bidder->id,
                'amount' => $bidAmount,
                'is_winner' => false,
            ]);
            $auction->update([
                'current_bid' => $bidAmount,
                'bid_count' => $auction->bid_count + 1,
            ]);
        }

        // Create Carts and Cart Items
        foreach ($customers as $customer) {
            $cart = Cart::create([
                'user_id' => $customer->id,
            ]);

            for ($i = 0; $i < rand(1, 3); $i++) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $products[array_rand($products)]->id,
                    'quantity' => rand(1, 5),
                ]);
            }
        }

        // Create Orders and Order Items
        foreach ($customers as $index => $customer) {
            $order = Order::create([
                'user_id' => $customer->id,
                'total_amount' => 0, // Will update after adding items
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_gateway' => 'stripe',
                'transaction_id' => 'txn_' . Str::random(10),
                'shipping_address' => "Neon Street $index, Cyber City, Neo, 12345, Cyberland",
            ]);

            $totalAmount = 0;
            for ($i = 0; $i < rand(1, 3); $i++) {
                $product = $products[array_rand($products)];
                $quantity = rand(1, 3);
                $priceAtPurchase = $product->price;
                $totalAmount += $priceAtPurchase * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price_at_purchase' => $priceAtPurchase,
                ]);
            }

            $order->update(['total_amount' => $totalAmount]);
        }

        // Create Watchlists
        foreach ($customers as $customer) {
            for ($i = 0; $i < rand(1, 4); $i++) {
                $isProduct = rand(0, 1);
                Watchlist::create([
                    'user_id' => $customer->id,
                    'product_id' => $isProduct ? $products[array_rand($products)]->id : null,
                    'auction_id' => !$isProduct && !empty($auctions) ? $auctions[array_rand($auctions)]->id : null,
                ]);
            }
        }

        // Create Reviews
        foreach ($orders = Order::all() as $order) {
            foreach ($order->orderItems as $orderItem) {
                if (rand(0, 1)) {
                    Review::create([
                        'user_id' => $order->user_id,
                        'product_id' => $orderItem->product_id,
                        'order_id' => $order->id,
                        'rating' => rand(1, 5),
                        'comment' => "Great comic! Volume {$orderItem->product->name} was a fantastic read.",
                    ]);
                }
            }
        }

        // Create Notifications
        foreach ($customers as $customer) {
            Notification::create([
                'user_id' => $customer->id,
                'type' => 'new_bid',
                'data' => [
                    'message' => 'Your bid on an auction has been outbid!',
                    'auction_id' => !empty($auctions) ? $auctions[array_rand($auctions)]->id : null,
                ],
                'read_at' => null,
            ]);

            Notification::create([
                'user_id' => $customer->id,
                'type' => 'order_placed',
                'data' => [
                    'message' => 'Your order has been placed successfully!',
                    'order_id' => Order::where('user_id', $customer->id)->first()->id,
                ],
                'read_at' => now(),
            ]);
        }
    }
}