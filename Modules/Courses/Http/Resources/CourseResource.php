<?php

namespace Courses\Http\Resources;

use Courses\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'name'          => $this->name,
            'level'         => $this->level,
            'group'         => $this->group,
            'categories'    => CategoryResource::collection($this->categories)
        ];
    }
}