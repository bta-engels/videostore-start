<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /*
     * Get the author of the movie
     */
    public function author() {
        return $this->belongsTo(Author::class);
    }

    public function __toString()
    {
        return "$this->title";
    }
}
