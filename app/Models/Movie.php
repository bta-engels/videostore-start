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
 * @property-read Translation $translatables
 * @method static Builder|Movie translated()
 */
class Movie extends Model {
    use Translatable;
    protected $fillable = [
        'author_id',
        'title',
        'price',
        'image'
    ];
    protected $translatables = ['title'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
