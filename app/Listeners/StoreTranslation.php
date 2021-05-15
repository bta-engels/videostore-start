<?php

namespace App\Listeners;

use App;
use App\Events\OnUpdated;
use App\Models\Translation;

class StoreTranslation
{
    /**
     * Handle the event.
     *
     * @param  OnUpdated  $event
     * @return void
     */
    public function handle(OnUpdated $event)
    {
        if(!$event->model->getTranslatables()) {
            die('nix is');
        }
        $where = [
            'language'              => App::getLocale(),
            'translatable_id'       => $event->model->id,
            'translatable_type'     => get_class($event->model),
        ];
        $data = array_merge($where, ['content' => $this->toObject($event->data)]);
        $translation = Translation::firstWhere($where) ?? new Translation();
        $translation->fill($data)->save();
    }

    /**
     * Get the translation attribute as object.
     *
     * @return Translation
     */
    public function toObject(array $data)
    {
        $obj = new stdClass();
        foreach ($this->translatables as $attr) {
            if(in_array($attr, array_keys($data))) {
                $obj->$attr = $data[$attr];
            }
        }
        return $obj;
    }
}
