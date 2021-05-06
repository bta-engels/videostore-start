<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieLang extends Model
{
    protected $table = 'movies_lang';
    protected $fillable = ['language_id', 'movie_id', 'title'];
    public $timestamps = false;

    public function __toString()
    {
        return $this->title;
    }
}
