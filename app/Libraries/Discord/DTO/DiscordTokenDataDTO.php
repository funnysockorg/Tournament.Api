<?php

namespace App\Libraries\Discord\DTO;

use Carbon\Carbon;
use Illuminate\Http\Client\Response;

class DiscordTokenDataDTO
{
    private string $accessToken;
    private string $refreshToken;
    private Carbon $expiresIn;
    private string $errorDescription;

    public function __construct(Response $response)
    {
        $tokenData = json_decode($response->body());

        if (!empty($tokenData->error_description)) {
            $this->errorDescription = $tokenData->error_description;
        }

        if (!empty($tokenData->access_token)) {
            $this->accessToken = $tokenData->access_token;
        }

        if (!empty($tokenData->refresh_token)) {
            $this->refreshToken = $tokenData->refresh_token;
        }

        if (!empty($tokenData->expires_in)) {
            $this->expiresIn = Carbon::now()->addSeconds($tokenData->expires_in);
        }
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    public function getExpiresIn(): Carbon
    {
        return $this->expiresIn;
    }

    public function getErrorDescription(): string
    {
        return $this->errorDescription;
    }
}