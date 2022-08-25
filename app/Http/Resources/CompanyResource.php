<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        $clients = $this->whenLoaded('clients');

        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'logo' => $this->logo,
            'email' => $this->email,
            'domain' => $this->domain,
            'description' => $this->description,
            'primary_phone' => $this->primary_phone,
            'secondary_phone' => $this->secondary_phone,
            'address' => $this->address,
            'clients' => ClientResource::collection($clients),
            'user' => new UserResource($this->user),
        ];
    }
}
