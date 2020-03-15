<?php

namespace Courses\Http\Resources;

use Courses\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'type'          => $this->type,
            'url'           => $this->url,
            'title'         => $this->title,
            'description'   => $this->description,
            'date'          => $this->date,
            'media'         => MediaResource::collection($this->media)
        ];
    }
}