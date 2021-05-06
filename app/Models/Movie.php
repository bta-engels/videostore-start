<?php

namespace App\Models;

use App\I18n\ITranslatable;
use App\I18n\Translatable;
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
class Movie extends Model implements ITranslatable
{
    use Translatable;

    private static $_lang;
    protected $fillable = ['author_id', 'title', 'price', 'image'];
    protected $appends = ['lang'];
    protected $with = ['translations'];

    public function withAuthor($id) {
        return self::where("id", $id);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    static function getLangClass()
    {
        return MovieLang::class;
    }

    static function getTranslatables()
    {
        return ['title'];
    }

    static function getTranslatableForeignKey()
    {
        return 'movie_id';
    }


}
