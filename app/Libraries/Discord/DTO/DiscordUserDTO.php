<?php

namespace App\Libraries\Discord\DTO;

use Illuminate\Http\Client\Response;

class DiscordUserDTO
{
    private string $userId;
    private string $userName;

    public function __construct(Response $response)
    {
        $userData = json_decode($response->body());

        if (!empty($userData->id)) {
            $this->userId = $userData->id;
        }

        if (!empty($userData->username)) {
            $this->userName = $userData->username;
        }
    }

    public function toJsonString(): string
    {
        return json_encode([
            'user_id' => $this->userId,
            'user_name' => $this->userName,
        ]);
    }

    public function isEmpty(): bool
    {
        return empty($this->userId) || empty($this->userName);
    }
}