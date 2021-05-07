<?php
namespace App\I18n;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

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
    public function getTranslationAttribute()
    {
        return $this->translations->firstWhere('language', App::getLocale());
    }
}
