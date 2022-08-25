<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => (string) $this->id,
            'email' => $this->email,
            'title' => $this->title,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'primary_phone' => $this->primary_phone,
            'secondary_phone' => $this->secondary_phone,
            'avatar' => $this->avatar,
            'job_title' => $this->job_title,
            'timezone' => $this->timezone,
            'company_id' => $this->company_id,
            'company' => new CompanyResource($this->whenLoaded('company')),
            'user' => new UserResource($this->user),
        ];
    }
}
