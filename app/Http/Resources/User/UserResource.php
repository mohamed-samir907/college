<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'level'             => $this->level,
            'group'             => $this->group,
            'payment_verified'  => $this->payment_verified,
            'created_at'        => (string) $this->created_at,
            'updated_at'        => (string) $this->updated_at
        ];
    }
}