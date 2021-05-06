<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

/**
 * App\Models\Movie
 *
 * @property int $id
 * @property int $author_id
 * @property string $title
 * @property string $price
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Author $author
 * @method static Builder|Movie newModelQuery()
 * @method static Builder|Movie newQuery()
 * @method static Builder|Movie query()
 * @method static Builder|Movie whereAuthorId($value)
 * @method static Builder|Movie whereCreatedAt($value)
 * @method static Builder|Movie whereId($value)
 * @method static Builder|Movie whereImage($value)
 * @method static Builder|Movie wherePrice($value)
 * @method static Builder|Movie whereTitle($value)
 * @method static Builder|Movie whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Movie extends Model
{
    use HasFactory;
    private static $_lang;
    protected $fillable = ['author_id', 'title', 'price', 'image'];
    protected $appends = ['lang'];

    public static function boot()
    {
        parent::boot();
        static::$_lang = Language::whereCode(App::getLocale())->first();
    }

    public static function booted()
    {
        static::created(function (Movie $model) {
            Language::all()->map(function (Language $language) use ($model) {
                MovieLang::create([
                    'title'         => $model->title,
                    'movie_id'      => $model->id,
                    'language_id'   => $language->id,
                ]);
            });
        });
        static::updated(function (Movie $model) {
            $where = [
                'movie_id'      => $model->id,
                'language_id'   => static::$_lang->id,
            ];

            MovieLang::updateOrInsert($where, [
                'title'         => $model->title,
                'movie_id'      => $model->id,
                'language_id'   => static::$_lang->id,
            ]);
        });
    }

    public function langs()
    {
        return $this->hasMany(MovieLang::class);
    }

    public function getLangAttribute() {
        return $this->langs()
            ->whereLanguageId(static::$_lang->id)
            ->first() ?? $this;
    }

    public function withAuthor($id) {
        return self::where("id", $id);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
