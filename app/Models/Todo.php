<?php
namespace App\Models;

use Eloquent;
use App\I18n\Translatable;
use Database\Factories\TodoFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
 */
class Todo extends Model
{
    use Translatable;

    private static $_lang;
    protected $appends = ['doneState','doneIcon','lang'];
    protected $fillable = ['text', 'done'];
    protected $translatables = ['text'];


    public function getDoneStateAttribute()
    {
        if($this->done) {
            return "DONE";
        } else {
            return "NOT DONE";
        }
    }

    public function getDoneIconAttribute()
    {
        $css = $this->done ? 'check' : 'times';
        return "<i class=\"fas fa-$css\"></i>";
    }
}
