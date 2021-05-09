<?php
/**
 * @see: https://pineco.de/simple-eloquent-model-translations/
 * @see: https://laravel.com/docs/8.x/eloquent-relationships#one-to-many-polymorphic-relations
 */
namespace App\I18n;

use DB;
use Illuminate\Support\Facades\Schema;
use stdClass;
use Illuminate\Support\Str;
use App\Models\Translation;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

trait Translatable {

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->scopeTranslated();
    }

    public function scopeTranslated(Builder $query)
    {
        if( !isset($this->translatables) || count($this->translatables) < 1) {
            return null;
        }
        $this
            ->prepareSelect($query)
            ->prepareQuery($query)
        ;

        if($this->id) {
            $query->whereId($this->id);
        }
        $this->refresh();
        return $query;
    }

    private function prepareSelect(Builder &$query)
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
            $extra->put("{$table}.{$field}", "IF(translations.content IS NOT NULL, JSON_VALUE(translations.content, '$.{$field}'), {$table}.{$field}) AS $field");
        }
        $attributes = $attributes->merge($extra);

        $sql = $attributes->implode(',');
        $query->selectRaw($sql);
        return $this;
    }

    private function prepareQuery(Builder &$query)
    {
        $table  = $query->getModel()->getTable();
        $query
            ->leftJoin('translations', function (JoinClause $q) use ($table) {
                $q->on('translations.translatable_id', '=', $table.'.id')
                    ->where('translations.translatable_type', '=', addslashes(static::class))
                    ->where('translations.language', '=', App::getLocale())
                ;
            });
        return $this;
    }

    /**
     * Get the translation attribute.
     *
     * @return Translation
     */
    public function getTranslatablesAttribute()
    {
        $obj = new stdClass();
        foreach ($this->translatables as $attr) {
            $obj->$attr = $this->$attr;
        }
        return $obj;
    }
}
