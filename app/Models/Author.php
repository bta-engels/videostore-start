<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * App\Models\Author
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property-read mixed $name
 * @property-read Collection|Movie[] $movies
 * @property-read int|null $movies_count
 * @method static Builder|Author newModelQuery()
 * @method static Builder|Author newQuery()
 * @method static Builder|Author query()
 * @method static Builder|Author whereFirstname($value)
 * @method static Builder|Author whereId($value)
 * @method static Builder|Author whereLastname($value)
 * @mixin Eloquent
 * @method static Builder|Author options()
 */

class Author extends Model
{
    use HasFactory;
    // laravel expect table-name as plural from class name
    //protected $table = 'authors';
    protected $appends = ['name'];
    public $timestamps = false;
    protected $fillable = ['firstname', 'lastname'];

    public function getNameAttribute()
    {
        return "$this->firstname $this->lastname";
    }

    public function movies() {
        return $this->hasMany(Movie::class, 'author_id', 'id');
    }

    public function scopeOptions(Builder $query) {
        $key = config('cache.key_authors_options');

        if(!Cache::has($key)) {
            $authors = $query->get()
                ->keyBy('id')
                ->map->name;
            $authors->prepend('Bitte wählen', '');
            // save cache for 5 minutes
            Cache::put($key, $authors, 300);
        }
        return Cache::get($key);
    }

    public function __toString(): string
    {
        return "$this->firstname $this->lastname";
    }


}
