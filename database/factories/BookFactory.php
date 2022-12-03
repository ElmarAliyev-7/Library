<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'about' => fake()->text(),
            'count' => fake()->randomNumber(),
            'publishing_at' => fake()->date(),
            'company_id' => fake()->numberBetween(1, Company::count()),
        ];
    }
}
