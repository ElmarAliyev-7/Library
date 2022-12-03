<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'about',
        'count',
        'publishing_at',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class,BookAuthor::class);
    }
}
