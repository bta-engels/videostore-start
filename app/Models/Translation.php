<?php
/**
 * @see: https://pineco.de/simple-eloquent-model-translations/
 * @see: https://laravel.com/docs/8.x/eloquent-relationships#one-to-many-polymorphic-relations
 */
namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Translation
 *
 * @property int $id
 * @property int $translatable_id
 * @property string $translatable_type
 * @property string $language
 * @property object $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Translation newModelQuery()
 * @method static Builder|Translation newQuery()
 * @method static Builder|Translation query()
 * @method static Builder|Translation whereContent($value)
 * @method static Builder|Translation whereCreatedAt($value)
 * @method static Builder|Translation whereId($value)
 * @method static Builder|Translation whereLanguage($value)
 * @method static Builder|Translation whereTranslatableId($value)
 * @method static Builder|Translation whereTranslatableType($value)
 * @method static Builder|Translation whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Translation extends Model {
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'object',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'language',
        'translatable_id',
        'translatable_type',
    ];
}
