<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'surname',
    ];

    public function author_books()
    {
        return $this->belongsToMany(Book::class,BookAuthor::class);
    }
}
