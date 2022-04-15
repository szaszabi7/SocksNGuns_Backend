<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class ItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "image" => $this->image ? URL::to($this->image) : null,
            "name" => $this->name,
            "price" => $this->price,
            "quantity" => $this->quantity,
            "availability" => $this->availability,
            "category" => $this->category,
            "category_id" => $this->category_id
        ];
    }
}
