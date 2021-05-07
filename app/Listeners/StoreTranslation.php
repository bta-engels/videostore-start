<?php

namespace App\Listeners;

use App;
use App\Events\OnUpdated;
use App\Models\Translation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        if(!isset($event->model->translatables)) {
            return null;
        }
        $where = [
            'language'              => App::getLocale(),
            'translatable_id'       => $event->model->id,
            'translatable_type'     => get_class($event->model),
        ];
        $data = array_merge($where, ['content' => json_encode($event->model->translatables)]);

        $translation = Translation::firstWhere($where) ?? new Translation();
        $translation->fill($data)->save();
    }
}
