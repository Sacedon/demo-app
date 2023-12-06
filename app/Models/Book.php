<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Borrow;
use App\Models\User;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['image_path', 'title', 'description', 'author', 'published_year', 'user_id', 'status'];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public function isAvailable()
    {
        return $this->status === 'available';
    }
}
