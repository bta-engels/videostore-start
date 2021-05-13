<?php
namespace App\I18n;

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
    public function scopeTranslated(Builder $query, $id = null)
    {
        if (!isset($this->translatables) || count($this->translatables) < 1) {
            return $query;
        }
        $table = $this->getTable();
        $this
            ->setSelect($query, $table)
            ->setJoin($query, $table)
        ;

        if($id > 0) {
            $query->firstWhere($table . '.id','=', $id);
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @return $this
     */
    private function setSelect(Builder &$query, $table)
    {
        $attributes = collect($this->selectColumns)
            ->keyBy(function ($value) use ($table) { return "{$table}.{$value}"; })
            ->map(function ($attribute) use ($table) {
                return "{$table}.{$attribute}";
            })
        ;
        $extra = collect([]);
        foreach ($this->translatables as $field) {
            $extra->put("{$table}.{$field}", "IF(translations.id IS NOT NULL, JSON_VALUE(translations.content, '$.{$field}'), {$table}.{$field}) AS {$field}");
        }
        $attributes = $attributes->merge($extra);

        $sql = $attributes->implode(',');
        $query->selectRaw($sql);

        return $this;
    }

    /**
     * @param Builder $query
     * @return $this
     */
    private function setJoin(Builder &$query, $table)
    {
        $query
            ->from($table)
            ->leftJoin('translations', function (JoinClause $q) use ($table) {
                $q->on('translations.translatable_id', '=', $table.'.id')
                    ->where('translations.translatable_type', '=', static::class)
                    ->where('translations.language', '=', App::getLocale())
                ;
            });
        return $this;
    }
/*
    public function __call($method, $parameters) {
        $result = parent::__call($method, $parameters);
        echo "$method<br>";
        switch ($method) {
            case 'translated':
                dump($result->get());
                break;
            case 'hydrate':
                dump($result->first());
                break;
        }
        return $result;
    }
*/
}
