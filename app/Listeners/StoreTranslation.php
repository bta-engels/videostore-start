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
        $data = array_merge($where, ['content' => $this->toObject($event->model, $event->data)]);
        $translation = Translation::firstWhere($where) ?? new Translation();
        $translation->fill($data)->save();
    }

    /**
     * Get the translation attribute.
     *
     * @return stdClass
     */
    private function toObject($model, array $translatables)
    {
        $obj = new stdClass();
        foreach ($translatables as $attr) {
            $obj->$attr = $model->$attr;
        }
        return $obj;
    }
}
