<?php
namespace App\Models;

use Closure;
use Eloquent;
use App\I18n\Translatable;
use Database\Factories\TodoFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Todo
 *
 * @property int $id
 * @property int $done
 * @property string $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static TodoFactory factory(...$parameters)
 * @method static Builder|Todo newModelQuery()
 * @method static Builder|Todo newQuery()
 * @method static Builder|Todo query()
 * @method static Builder|Todo whereCreatedAt($value)
 * @method static Builder|Todo whereDone($value)
 * @method static Builder|Todo whereId($value)
 * @method static Builder|Todo whereText($value)
 * @method static Builder|Todo whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read mixed $done_icon
 * @property-read mixed $done_state
 * @property-read mixed $lang
 * @property-read Collection|TodoLang[] $langs
 * @property-read int|null $langs_count
 * @method static Builder|Todo lang()
 * @property-read Translation $translatables
 * @method static Builder|Todo translated()
 * @method static Builder|Todo hasNestedUsingJoins($relations, $operator = '>=', $count = 1, $boolean = 'and', ?Closure $callback = null)
 * @method static Builder|Todo joinNestedRelationship(string $relationships, $callback = null, $joinType = 'join', $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Todo joinRelation($relationName, $callback = null, $joinType = 'join', $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Todo joinRelationship($relationName, $callback = null, $joinType = 'join', $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Todo joinRelationshipUsingAlias($relationName, $callback = null, bool $disableExtraConditions = false)
 * @method static Builder|Todo leftJoinRelation($relation, $callback = null, $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Todo leftJoinRelationship($relation, $callback = null, $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Todo leftJoinRelationshipUsingAlias($relationName, $callback = null, bool $disableExtraConditions = false)
 * @method static Builder|Todo orderByLeftPowerJoins($sort, $direction = 'asc')
 * @method static Builder|Todo orderByLeftPowerJoinsAvg($sort, $direction = 'asc')
 * @method static Builder|Todo orderByLeftPowerJoinsCount($sort, $direction = 'asc')
 * @method static Builder|Todo orderByLeftPowerJoinsMax($sort, $direction = 'asc')
 * @method static Builder|Todo orderByLeftPowerJoinsMin($sort, $direction = 'asc')
 * @method static Builder|Todo orderByLeftPowerJoinsSum($sort, $direction = 'asc')
 * @method static Builder|Todo orderByPowerJoins($sort, $direction = 'asc', $aggregation = null, $joinType = 'join')
 * @method static Builder|Todo orderByPowerJoinsAvg($sort, $direction = 'asc')
 * @method static Builder|Todo orderByPowerJoinsCount($sort, $direction = 'asc')
 * @method static Builder|Todo orderByPowerJoinsMax($sort, $direction = 'asc')
 * @method static Builder|Todo orderByPowerJoinsMin($sort, $direction = 'asc')
 * @method static Builder|Todo orderByPowerJoinsSum($sort, $direction = 'asc')
 * @method static Builder|Todo powerJoinDoesntHave($relation, $boolean = 'and', ?Closure $callback = null)
 * @method static Builder|Todo powerJoinHas($relation, $operator = '>=', $count = 1, $boolean = 'and', ?Closure $callback = null)
 * @method static Builder|Todo powerJoinWhereHas($relation, ?Closure $callback = null, $operator = '>=', $count = 1)
 * @method static Builder|Todo rightJoinRelation($relation, $callback = null, $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Todo rightJoinRelationship($relation, $callback = null, $useAlias = false, bool $disableExtraConditions = false)
 * @method static Builder|Todo rightJoinRelationshipUsingAlias($relationName, $callback = null, bool $disableExtraConditions = false)
 * @property-read Collection|Translation[] $translations
 * @property-read int|null $translations_count
 */
class Todo extends Model
{
    use Translatable, HasFactory;

    protected $appends = ['doneState','doneIcon'];
    protected $fillable = ['text', 'done'];

    public $translatables = ['text'];
    public $selectColumns = [
        'id',
        'done',
        'text',
        'created_at',
        'updated_at',
    ];

    public function getDoneStateAttribute()
    {
        if($this->done) {
            return 'DONE';
        } else {
            return 'NOT DONE';
        }
    }

    public function getDoneIconAttribute()
    {
        $css = $this->done ? 'check' : 'times';
        return "<i class=\"fas fa-$css\"></i>";
    }
}
