<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()
            ->has(
                Book::factory()
                    ->count(3)
                    ->state(function (array $attributes, Company $company) {
                        return ['company_id' => $company->id];
                    })
                ->hasAttached(Author::factory()->count(5),[], 'authors')
            )
            ->create();
    }
}
