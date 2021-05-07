<?php

namespace App\Models;

use App;
use App\Http\Resources\LanguageResource;
use Database\Factories\TodoFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
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
 * @property-read mixed $display_text
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TodoLang[] $todo_langs
 * @property-read int|null $todo_langs_count
 */
class Todo extends Model
{
    use HasFactory;

    protected $appends = ['doneState','doneIcon', 'displayText'];

    protected $fillable = ['text', 'done'];

    public function getDisplayTextAttribute() {
        return $this->current_lang_text();
    }

    public function getDoneStateAttribute()
    {
        return '<i class="fas fa-'. ($this->done ? 'check' : 'times') . ' "></i>';
    }

    public function getDoneIconAttribute()
    {
        $css = $this->done ? 'check' : 'times';
        return "<i class=\"fas fa-$css\"></i>";
    }

    public function todo_langs() {
        return $this->hasMany(TodoLang::class, 'todo_id', 'id');
    }

    public function current_lang_text () {
        $lang = App::getLocale();
        $language = Language::whereCode($lang)->get();
        $text = $this->todo_langs->where('language_id' , $language->first()->id);
        if($text && $text->count() != 0) {
            $text = $text->first()->text;
        } else {
            $text = $this->text;
        }
        return $text;
    }

    public function __toString()
    {
        return $this->displayText;
    }

    public static function booted()
    {
        static::created(function($todo) {
            $text = $todo->text;
            $languages = Language::all();
            $todo_id = $todo->id;
            foreach ($languages as $language) {
                TodoLang::create([
                    'todo_id'       =>  $todo_id,
                    'language_id'   =>  $language->id,
                    'text'          =>  $text
                ]);
            }
        });

//        static::updated(function($todo) {
//            $text = $todo->text;
//            $lang = App::getLocale();
//            $language = Language::whereCode($lang)->get()->first();
//            $todo_id = $todo->id;
//            $todo_lang = TodoLang::where('language_id', $language->id)
//                ->where('todo_id', $todo_id)->get()->first();
//            $todo_lang->update([
//                'todo_id' => $todo_id,
//                'language_id'   =>  $language->id,
//                'text'  => $text]);
//        });

    }

}
