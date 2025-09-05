<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Pick a random category that is NOT a main category (has a parent_category_id)
        $category = Category::whereNotNull('parent_category_id')->inRandomOrder()->first();

        

        return [
            'category_id' => $category ? $category->id : null,
            'product_name' => $this->faker->words(3, true), // e.g. "Dog Chew Toy"
            'price' => $this->faker->randomFloat(2, 5, 100), // prices between 5 and 100
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(640, 480, 'pets', true),
        ];
    }
}
