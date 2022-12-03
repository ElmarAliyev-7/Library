<?php

namespace App\Http\Service;

use App\Models\Book;

class BookService
{
    public function getBook($where): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return Book::query()->where($where)->firstOrFail();
    }
}
