<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SurahResource extends JsonResource
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
            'number' => $this->number, 
            'name_ar' => $this->name_ar, 
            'name_en' => $this->name_en, 
            'name_en_translation' => $this->name_en_translation, 
            'type' => $this->type,
            'ayahs' => AyahResource::collection($this->whenLoaded('ayahs')),
        ];
    }
}
