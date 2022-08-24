<?php

namespace App\Traits;

trait UserClaims
{
    /**
     * Get the token from request header
     */
    private function getToken(): string | null
    {
        $token = request()->bearerToken();

        return $token;
    }

    /**
     * Get the claims from request headers
     */
    private function claims(): object | false
    {
        $token = $this->getToken();

        if (!$token) {
            return false;
        }

        $tokenChunks = explode(".", $token);
        $rawPayload = strtr($tokenChunks[1], '-_', '+/');
        $payload = base64_decode($rawPayload);

        return json_decode($payload);
    }

    /**
    * Get user UUID
    */
    public function getUserUUID(): string | false
    {
        if (!$this->claims()) {
            return false;
        }

        return $this->claims()->sub;
    }
}
