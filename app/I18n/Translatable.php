<?php
/**
 * @see: https://pineco.de/simple-eloquent-model-translations/
 * @see: https://laravel.com/docs/8.x/eloquent-relationships#one-to-many-polymorphic-relations
 */
namespace App\I18n;

use stdClass;
use App\Models\Translation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

/**
 * Trait Translatable
 * @package App\I18n
 */
trait Translatable {

    /**
     * @param Builder $query
     * @return Builder|null
     */
    public function scopeTranslated(Builder $query)
    {
        if( !isset($this->translatables) || count($this->translatables) < 1) {
            return $query;
        }
        $query = $this->prepareSelect($query);
        $query = $this->prepareQuery($query);

        return $query;
    }

    /**
     * @param Builder $query
     * @return $this
     */
    private function prepareSelect(Builder $query)
    {
        $table = $query->getModel()->getTable();
        $attributes = collect(Schema::getColumnListing($table))
            ->keyBy(function ($value) use ($table) { return "{$table}.{$value}"; })
            ->map(function ($attribute) use ($table) {
                return "{$table}.{$attribute} AS $attribute";
            })
        ;
        $extra = collect([]);
        foreach ($this->translatables as $field) {
            $extra->put("{$table}.{$field}", "IF(translations.content IS NOT NULL, JSON_VALUE(translations.content, '$.{$field}'), {$table}.{$field}) AS {$field}");
        }
        $attributes = $attributes->merge($extra);

        $sql = $attributes->implode(',');
        $query->selectRaw($sql);

        return $query;
    }

    /**
     * @param Builder $query
     * @return $this
     */
    private function prepareQuery(Builder $query)
    {
        $table  = $query->getModel()->getTable();
        $query
            ->leftJoin('translations', function (JoinClause $q) use ($table) {
                $q->on('translations.translatable_id', '=', $table.'.id')
                    ->where('translations.translatable_type', '=', addslashes(static::class))
                    ->where('translations.language', '=', App::getLocale())
                ;
            });

        return $query;
    }
}
