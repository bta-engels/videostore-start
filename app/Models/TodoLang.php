<?php
namespace App\Models;

use App;
use Exception;
use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TodoLang
 *
 * @property int $todo_id
 * @property int $language_id
 * @property string $text
 * @method static \Illuminate\Database\Eloquent\Builder|TodoLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoLang whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoLang whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoLang whereTodoId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Language $language
 */
class TodoLang extends Model
{
    use HasCompositePrimaryKeyTrait;
    protected $table = 'todos_lang';
    public $timestamps = false;
    protected $fillable = ['text', 'todo_id', 'language_id'];

    protected $primaryKey = ['todo_id', 'language_id'];
    public $incrementing = false;

    public function update_text($text)
    {
        $this->update(['text'  => $text]);
    }

    public function test(){
        // aktuelle sprache ermittlen
        $lang = App::getLocale();
        return $lang;
    }

    public function language() {
        return $this->belongsTo(Language::class);
    }

}
