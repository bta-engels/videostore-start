<?php

namespace App\Models;

use Closure;
use Eloquent;
use App\I18n\Translatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
 * @method static Builder|Movie hasNestedUsingJoins($relations, $operator = '>=', $count = 1, $boolean = 'and', ?Closure $callback = null)
 * @method static Builder|Movie joinNestedRelationship(string $relationships, $callback = null, $joinType = 'join', $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Movie joinRelation($relationName, $callback = null, $joinType = 'join', $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Movie joinRelationship($relationName, $callback = null, $joinType = 'join', $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Movie joinRelationshipUsingAlias($relationName, $callback = null, bool $disableExtraConditions = false)
 * @method static Builder|Movie leftJoinRelation($relation, $callback = null, $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Movie leftJoinRelationship($relation, $callback = null, $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Movie leftJoinRelationshipUsingAlias($relationName, $callback = null, bool $disableExtraConditions = false)
 * @method static Builder|Movie orderByLeftPowerJoins($sort, $direction = 'asc')
 * @method static Builder|Movie orderByLeftPowerJoinsAvg($sort, $direction = 'asc')
 * @method static Builder|Movie orderByLeftPowerJoinsCount($sort, $direction = 'asc')
 * @method static Builder|Movie orderByLeftPowerJoinsMax($sort, $direction = 'asc')
 * @method static Builder|Movie orderByLeftPowerJoinsMin($sort, $direction = 'asc')
 * @method static Builder|Movie orderByLeftPowerJoinsSum($sort, $direction = 'asc')
 * @method static Builder|Movie orderByPowerJoins($sort, $direction = 'asc', $aggregation = null, $joinType = 'join')
 * @method static Builder|Movie orderByPowerJoinsAvg($sort, $direction = 'asc')
 * @method static Builder|Movie orderByPowerJoinsCount($sort, $direction = 'asc')
 * @method static Builder|Movie orderByPowerJoinsMax($sort, $direction = 'asc')
 * @method static Builder|Movie orderByPowerJoinsMin($sort, $direction = 'asc')
 * @method static Builder|Movie orderByPowerJoinsSum($sort, $direction = 'asc')
 * @method static Builder|Movie powerJoinDoesntHave($relation, $boolean = 'and', ?Closure $callback = null)
 * @method static Builder|Movie powerJoinHas($relation, $operator = '>=', $count = 1, $boolean = 'and', ?Closure $callback = null)
 * @method static Builder|Movie powerJoinWhereHas($relation, ?Closure $callback = null, $operator = '>=', $count = 1)
 * @method static Builder|Movie rightJoinRelation($relation, $callback = null, $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Movie rightJoinRelationship($relation, $callback = null, $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Movie rightJoinRelationshipUsingAlias($relationName, $callback = null, bool $disableExtraConditions = false)
 * @property-read Collection|Translation[] $translations
 * @property-read int|null $translations_count
 */
class Movie extends Model {
    use Translatable;

    protected $fillable = [
        'author_id',
        'title',
        'price',
        'image'
    ];
    public $translatables = ['title'];
    public $selectColumns = [
        'id',
        'author_id',
        'title',
        'price',
        'image',
        'created_at',
        'updated_at',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
