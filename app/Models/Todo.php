<?php

namespace App\Models;

use Database\Factories\TodoFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

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
 */
class Todo extends Model
{
    use HasFactory;
    protected $appends = ['doneState','doneIcon','lang'];
    protected $fillable = ['text', 'done'];

    public static function booted()
    {
        static::created(function (Todo $model) {
            Language::all()->map(function (Language $language) use ($model) {
                TodoLang::create([
                    'text'          => $model->text,
                    'todo_id'       => $model->id,
                    'language_id'   => $language->id,
                ]);
            });
        });
        static::updated(function (Todo $model) {
            $lang = Language::whereCode(App::getLocale())->first();
            $where = [
                'todo_id'      => $model->id,
                'language_id'  => $lang->id,
            ];
            TodoLang::where($where)
                ->update([
                    'text'          => $model->text,
                    'todo_id'       => $model->id,
                    'language_id'   => $lang->id,
                ]);
        });
    }

    public function getDoneStateAttribute()
    {
        if($this->done) {
            return "DONE";
        } else {
            return "NOT DONE";
        }
    }

    public function langs()
    {
        return $this->hasMany(TodoLang::class);
    }

    public function getLangAttribute() {
        $lang = Language::whereCode(App::getLocale())->first();
        return $this->langs()
            ->where('language_id', $lang->id)
            ->first()
        ;
    }

    public function getDoneIconAttribute()
    {
        $css = $this->done ? 'check' : 'times';
        return "<i class=\"fas fa-$css\"></i>";
    }

    public function __toString()
    {
        return $this->text;
    }

}
