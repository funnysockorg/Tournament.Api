<?php

namespace App\Libraries\Discord\DTO;

use Illuminate\Http\Client\Response;

class DiscordUserDTO
{
    private string $discordId;
    private string $name;
    private string $avatarHash;

    public function __construct(Response $response)
    {
        $userData = json_decode($response->body());

        if (!empty($userData->id)) {
            $this->discordId = $userData->id;
        }

        if (!empty($userData->username)) {
            $this->name = $userData->username;
        }

        if (!empty($userData->avatar)) {
            $this->avatarHash = $userData->avatar;
        }
    }

    public function getDiscordId(): string
    {
        return $this->discordId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAvatarHash(): string
    {
        return $this->avatarHash;
    }

    public function toJsonString(): string
    {
        return json_encode([
            'user_id' => $this->discordId,
            'user_name' => $this->name,
            'avatar_hash' => $this->avatarHash,
        ]);
    }

    public function isEmpty(): bool
    {
        return empty($this->discordId) 
        || empty($this->name) 
        || empty($this->avatarHash);
    }
}