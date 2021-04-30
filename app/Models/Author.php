<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    //protected $table = 'authors';
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return "$this->firstname $this->lastname";
    }

    public function movies() {
        return $this->hasMany(Movie::class, 'author_id', 'id');
    }

    public function __toString(): string
    {
        return "$this->firstname $this->lastname";
    }


}
