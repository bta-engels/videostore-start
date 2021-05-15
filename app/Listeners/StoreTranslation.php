<?php

namespace App\Listeners;

use App;
use App\Events\OnUpdated;
use App\Models\Translation;
use stdClass;

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
        if(!$event->model->translatables) {
            return null;
        }
        $where = [
            'language'              => App::getLocale(),
            'translatable_id'       => $event->model->id,
            'translatable_type'     => get_class($event->model),
        ];
        $data = array_merge($where, ['content' => $this->toObject($event->data, $event->model->translatables)]);
        $translation = Translation::firstWhere($where) ?? new Translation();
        $translation->fill($data)->save();
    }

    /**
     * Get the translation attribute.
     *
     * @return stdClass
     */
    private function toObject(array $data, array $translatables)
    {
        $data = collect($data)->filter(function($item, $key) use ($translatables) {
            if(in_array($key, $translatables)) {
                return $item;
            }
        });
        return json_decode($data);
    }
}
