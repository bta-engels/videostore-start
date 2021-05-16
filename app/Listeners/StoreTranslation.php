<?php
namespace App\Listeners;

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
        Translation::storeTranslation($event->model, $event->data);
    }
}
