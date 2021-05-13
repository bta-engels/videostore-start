<?php

namespace App\Listeners;

use App;
use App\Events\OnUpdated;
use App\Models\Translation;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
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
        $translatables = $event->model->translatables;
        if(!$translatables) {
            return null;
        }

        $where = [
            'language'              => App::getLocale(),
            'translatable_id'       => $event->model->id,
            'translatable_type'     => get_class($event->model),
        ];
        $data = array_merge($where, ['content' =>  $this->toObject($event->model, $translatables)]);

        $translation = Translation::firstWhere($where) ?? new Translation();
        $translation->fill($data)->save();
    }

    /**
     * Get the translation attribute.
     *
     * @return Translation
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
