<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Mockery\Undefined;

class SpotResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //  
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'serve' => $this->serve,
            'capacity' => $this->capacity,
            'available_vaccine'=>$this->whenLoaded('spot_vaccine',VaccineResources::make($this->spot_vaccine->vaccine->first))
            // 'capacity' => $this->spot_vaccine,
            // 'available_vaccines' =>[
            //     'Sinovac' => $false,
            //     'AstraZaneca' => $false,
            //     'Moderna' => $false,
            //     'Pfizer' => $false,
            //     'Sinnoparm' => $false,
            // ],
        ];
    }
}
