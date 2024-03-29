<?php

namespace App\Models;

use Eloquent;
use App\I18n\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
class Movie extends Model {
    use Translatable;

    protected $fillable = ['author_id', 'title', 'price', 'image'];
    public $translatables = ['title'];

    public function getTitleAttribute($value)
    {
        return $this->trans->title ?? $value;
    }

    public function withAuthor($id) {
        return self::where("id", $id);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
