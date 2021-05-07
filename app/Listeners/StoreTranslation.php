<?php

namespace App\Listeners;

use App;
use App\Events\OnUpdated;
use App\I18n\Translation;
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
        $data = [
            'language'              => App::getLocale(),
            'translatable_id'       => $event->model->id,
            'translatable_type'     => get_class($event->model),
            'content'               => json_encode($event->model->translatables),
        ];
        Translation::updateOrCreate($data);
    }
}
