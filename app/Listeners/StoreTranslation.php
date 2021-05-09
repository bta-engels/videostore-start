<?php

namespace App\Listeners;

use App;
use App\Events\OnUpdated;
use App\Models\Translation;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
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
        if(!$event->model->getTranslatables()) {
            return null;
        }

        $where = [
            'language'              => App::getLocale(),
            'translatable_id'       => $event->model->id,
            'translatable_type'     => get_class($event->model),
        ];
        $data = array_merge($where, ['content' => $event->model->translatables]);

        $translation = Translation::firstWhere($where) ?? new Translation();
        $translation->fill($data)->save();
    }
}
