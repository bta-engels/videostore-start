<?php
/**
 * @see: https://pineco.de/simple-eloquent-model-translations/
 * @see: https://laravel.com/docs/8.x/eloquent-relationships#one-to-many-polymorphic-relations
 */
namespace App\I18n;

use stdClass;
use Illuminate\Support\Str;
use App\Models\Translation;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Builder;

trait Translatable {

    /**
     * Get all of the models's translations.
     *
     * @return Builder
     */
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    /**
     * Get the translation attribute.
     *
     * @return Translation
     */
    public function getTransAttribute()
    {
        $data = $this->translations->firstWhere('language', App::getLocale());
        if($data) {
            return $data->content;
        }
        return $this;
    }

    public function __get($attribute)
    {
        if (in_array($attribute, $this->translatables)) {
            $translation = $this->translations->firstWhere('language', App::getLocale());
            if($translation && $translation->content) {
                $content = $translation->content;
                return $content->$attribute;
            }
            return $this->getAttribute($attribute);
        }
        return parent::__get($attribute);
    }

    public function getTranslatables()
    {
        return ($this->translatables && count($this->translatables) > 0) ? $this->translatables : null;
    }
}
