<?php

namespace App\Traits;

trait UserClaims
{
    /**
     * Get the claims from request headers
     */
    private function claims(): object
    {
        $tokenParts = explode(".", request()->bearerToken());
        $rawPayload = strtr($tokenParts[1], '-_', '+/');
        $payload = base64_decode($rawPayload);

        return json_decode($payload);
    }

    /**
    * Get user UUID
    */
    public function getUserUUID(): string
    {
        return $this->claims()->sub;
    }
}
