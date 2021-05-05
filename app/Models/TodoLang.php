<?php
namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\App;

/**
 * App\Models\TodoLang
 *
 * @property int $todo_id
 * @property int $language_id
 * @property string $text
 * @property-read Collection|Language[] $languages
 * @property-read int|null $languages_count
 * @method static \Illuminate\Database\Eloquent\Builder|TodoLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoLang whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoLang whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoLang whereTodoId($value)
 * @mixin Eloquent
 */
class TodoLang extends Model
{
    protected $table = 'todos_lang';
    protected $fillable = ['language_id', 'todo_id', 'text'];
    protected $appends = ['current'];
    public $timestamps = false;

    public function __toString()
    {
        return $this->text;
    }
}
