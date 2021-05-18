<?php
namespace App\Http\Resources;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
         * @var Movie $this
         */
        return [
            'id'        => $this->id,
            'author'    => $this->author,
            'title'     => $this->title,
            'price'     => $this->price,
        ];
    }
}
