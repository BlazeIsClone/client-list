<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'id'                => (string) $this->id,
            'email'             => $this->email,
            'first_name'        => $this->first_name,
            'last_name'         => $this->last_name,
            'primary_phone'     => $this->primary_phone,
            'secondary_phone'   => $this->secondary_phone,
            'timezone'          => $this->timezone,
            'company_id'        => $this->company_id,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'company'           => new CompanyResource(
                $this->whenLoaded('company')
            ),
        ];
    }
}
