<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'author', 'published_year', 'user_id'];

    public function user()
{
    return $this->belongsTo(User::class);
}
}
