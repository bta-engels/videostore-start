<?php
namespace App\I18n;

use Str;
use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

trait Translatable
{
    private static $_lang;
    protected static $langClass;
    protected static $foreignKey;
    protected static $translatables;
    protected $appends = ['lang'];

    public static function boot()
    {
        parent::boot();
        static::$_lang = Language::whereCode(App::getLocale())->first();
        static::$langClass = static::getLangClass();
        static::$translatables = static::getTranslatables();
        static::$foreignKey = static::getTranslatableForeignKey();
    }

    public static function booted()
    {
        static::created(function ($model) {
            Language::all()->map(function (Language $language) use ($model) {
                $data = [
                    'language_id'   => $language->id,
                    static::$foreignKey => $model->id,
                ];
                foreach (static::$translatables as $attr) {
                    $data[$attr] = $model->$attr;
                }
                (new static::$langClass)::create($data);
            });
        });
        static::updated(function ($model) {
            $where = [
                'language_id'  => static::$_lang->id,
                static::$foreignKey => $model->id,
            ];
            $data = [
                'language_id'   => static::$_lang->id,
                static::$foreignKey => $model->id,
            ];
            foreach (static::getTranslatables() as $attr) {
                $data[$attr] = $model->$attr;
            }
            (new static::$langClass)::updateOrInsert($where, $data);
        });
    }

    public function translations()
    {
        return $this->hasMany(static::getLangClass());
    }

    public function getLangAttribute($attribute)
    {
        $entity = $this->translations()
                ->whereLanguageId(static::$_lang->id)
                ->first() ?? $this;
        return class_basename($entity).': '.$entity->getAttribute($attribute);
    }

    public function __get($attribute) {
        if(in_array($attribute, static::$translatables) ) {
            $entity = $this->translations()
                ->whereLanguageId(static::$_lang->id)
                ->first() ?? $this;
            return class_basename($entity).': '.$entity->getAttribute($attribute);
        }
        return parent::__get($attribute);
    }

    public function __call($method, $arguments)
    {
        foreach(static::$translatables as $attr) {
            // e.g. "getTitleAttribute"
            if (method_exists($this, $method) && $method === 'get'. Str::studly($attr).'Attribute') {
                return $this->{$attr};
            }
        }
        return parent::__call($method, $arguments);
    }
/*
    static function getLangClass() {}
    static function getTranslatables() {}
    static function getTranslatableForeignKey() {}
*/
}
