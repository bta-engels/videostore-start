<?php
namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * App\Models\TodoLang
 *
 * @property int $todo_id
 * @property int $language_id
 * @property string $text
 * @property-read Collection|Language[] $languages
 * @property-read int|null $languages_count
 * @method static Builder|TodoLang newModelQuery()
 * @method static Builder|TodoLang newQuery()
 * @method static Builder|TodoLang query()
 * @method static Builder|TodoLang whereLanguageId($value)
 * @method static Builder|TodoLang whereText($value)
 * @method static Builder|TodoLang whereTodoId($value)
 * @mixin Eloquent
 * @method static Builder|TodoLang current()
 */
class TodoLang extends Model
{
    protected $table = 'todos_lang';
    protected $fillable = ['language_id', 'todo_id', 'text'];
    public $timestamps = false;
}
