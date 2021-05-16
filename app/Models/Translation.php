<?php
namespace App\Models;

use App;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use stdClass;

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
 * @property-read Model|Eloquent $translatable
 * @method static Builder|Translation storeTranslations()
 */
class Translation extends Model {
    use HasFactory;
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

    public function scopeStoreTranslation($model, array $validated, $language = null)
    {
        if(!$model->translatables) {
            return null;
        }
        if(!$language) {
            $language = App::getLocale();
        }
        $where = [
            'language'              => $language,
            'translatable_id'       => $model->id,
            'translatable_type'     => get_class($model),
        ];
        $data = array_merge($where, ['content' => $this->toObject($validated, $model->translatables)]);
        $translation = self::firstWhere($where) ?? new static();
        $translation->fill($data)->save();
    }

    /**
     * Get the translation attributes as object.
     *
     * @return stdClass
     */
    private function toObject(array $data, array $translatables)
    {
        $data = collect($data)->filter(function($item, $key) use($translatables)  {
            if(in_array($key, $translatables)) {
                return $item;
            }
        });
        return json_decode($data);
    }
}
