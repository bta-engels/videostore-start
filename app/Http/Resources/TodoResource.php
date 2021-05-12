<?php

namespace App\Http\Resources;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var Todo $this
         */
        return [
            'id'    => $this->id,
            'done'  => $this->done,
            'text'  => $this->text,
            'created_at' => $this->created_at->format('d.m.Y H:i'),
        ];
    }
}
