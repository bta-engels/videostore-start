<?php
/**
 * @see: https://pineco.de/simple-eloquent-model-translations/
 */
namespace App\I18n;

use Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use stdClass;
use function MongoDB\BSON\fromJSON;

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
        $data = $this->translations->firstWhere('language', App::getLocale());
        if($data) {
            return json_decode($data->content);
        }
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
