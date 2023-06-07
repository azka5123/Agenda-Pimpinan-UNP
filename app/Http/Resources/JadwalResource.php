<?php

namespace App\Http\Resources;

use App\Models\User;
use Hashids\Hashids;
// use Hashids\Hashids;
use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids as FacadesHashids;

class JadwalResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'keterangan' => $this->keterangan,
            'start_time' => $this->start_time,
            'finish_time' => $this->finish_time,
            'data_user' => $this->whenLoaded('rUser'),

        ];
    }
}
