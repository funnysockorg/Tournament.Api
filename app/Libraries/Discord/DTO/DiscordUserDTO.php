<?php

namespace App\Libraries\Discord\DTO;

use Illuminate\Http\Client\Response;

class DiscordUserDTO
{
    private string $discordId;
    private string $name;

    public function __construct(Response $response)
    {
        $userData = json_decode($response->body());

        if (!empty($userData->id)) {
            $this->discordId = $userData->id;
        }

        if (!empty($userData->username)) {
            $this->name = $userData->username;
        }
    }

    public function toJsonString(): string
    {
        return json_encode([
            'user_id' => $this->discordId,
            'user_name' => $this->name,
        ]);
    }

    public function isEmpty(): bool
    {
        return empty($this->discordId) || empty($this->name);
    }
}