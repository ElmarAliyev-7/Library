<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
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
        Book::factory()
            ->count(10)->create()->each(function (Book $book) {
                $book->book_authors()->attach(Author::query()->inRandomOrder()->take(5)->get()->pluck('id')->toArray());
            });
    }
}
