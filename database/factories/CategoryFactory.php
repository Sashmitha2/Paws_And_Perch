<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory

{

    

    protected $model = \App\Models\Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word();

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'parent_category_id' => null,
        ];
    }

        public function subcategory($parentId, $name)
        {
            return $this->state(function () use ($parentId, $name) {
                return [
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'parent_category_id' => $parentId,
                ];
            });
        }
    
}
