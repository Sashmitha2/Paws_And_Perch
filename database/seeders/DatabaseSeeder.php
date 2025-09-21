<?php

namespace Database\Seeders;

 use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
           'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(AdminUserSeeder::class);


        //creating main and sub categories 
        $maincategory = [   
            'dog' => Category::factory()->create(['name'=>'Dog', 'slug'=>'dog']),

            'cat' => Category::factory()->create(['name'=>'Cat', 'slug'=>'cat']),

            'bird' => Category::factory()->create(['name'=>'Bird', 'slug'=>'bird']),
        ];
        

        //sub categories for dog
        $dogsub=['Food','Toys_and_Accessories', 'Grooming'];
        foreach ($dogsub as $sub) {
            Category::factory()->create([
                'name' => $sub,
                'slug' => strtolower($sub),
                'parent_category_id' => $maincategory['dog']->id,
            ]);

        }

        //sub categories for cats
        $catsub=['Food','Toys_and_Accessories', 'Grooming'];
        foreach ($catsub as $sub) {
            Category::factory()->create([
                'name' => $sub,
                'slug' => strtolower($sub),
                'parent_category_id' => $maincategory['cat']->id,
            ]);
        }

        //sub categories for birds
        $birdsub=['Food','Cages'];
        foreach ($birdsub as $sub) {
            Category::factory()->create([
                'name' => $sub,
                'slug' => strtolower($sub),
                'parent_category_id' => $maincategory['bird']->id,
            ]);
        }
        

        // //creating products linked to categories
        $products = Product::factory(15)->create();


        // //creating 7 users
         $customers = User::factory(7)->create([
             'role'=>'Customer',
             'password'=>Hash::make('password'),
         ]);

        foreach ($customers as $customer) {

        // Create 1 cart per customer
        $carts = Cart::factory()->create([
            'user_id' => $customer->id,
            'status' => 'active',
        ]);

    //     // Create 1-3 orders per customer
        $orders = Order::factory(rand(1, 3))->create([
            'user_id' => $customer->id,
            'order_status' => 'pending',
        ])->each(function ($order) use ($products) {
            $total = 0;

            // Create 1-5 order items for each order
            $items = OrderItem::factory(rand(1, 5))->make();

            foreach ($items as $item) {
                $product = $products->random();


                $item->order_id = $order->id;
                $item->product_id = $product->id;
                $item->price = $product->price;
                $item->save();

                $total += $item->price * $item->quantity;
            }
        

            // Update order's total amount
            $order->total_amount = $total;
            $order->order_status = 'completed'; // or whatever logic you want
            $order->save();
        

        // Create payment for the order
        Payment::factory()->create([
            'order_id' => $order->id,
            'amount' => $total,
            'payment_method' => 'Card',
            'payment_status' => 'completed',
        ]);

    });
}

}

}