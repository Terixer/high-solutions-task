<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'height' => $this->height === 'unknown' ? null : (int) $this->height,
            'mass' => $this->mass === 'unknown' ? null : (int) $this->mass,
            'hair_color' => $this->hair_color === 'unknown' ? null : $this->hair_color,
            'skin_color' => $this->skin_color === 'unknown' ? null : $this->skin_color,
            'eye_color' => $this->eye_color === 'unknown' ? null : $this->eye_color,
            'birth_year' => $this->birth_year === 'unknown' ? null : $this->birth_year,
            'gender' => $this->gender === 'n/a' ? null : $this->gender,
            'url' => route('people.show', [
                'person' => $this->name
            ])
        ];
    }
}
