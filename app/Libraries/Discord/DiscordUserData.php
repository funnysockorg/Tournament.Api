<?php

namespace App\Libraries\Discord;

use App\Libraries\Discord\DTO\DiscordUserDTO;
use Illuminate\Support\Facades\Http;

class DiscordUserData
{
    private string $userDataUrl = 'https://discordapp.com/api/users/@me';

    public function getUserData(string $userToken): DiscordUserDTO|null
    {
        $response = Http::withHeader('Authorization', "Bearer {$userToken}")->get($this->userDataUrl);
        
        $userDataDTO = new DiscordUserDTO($response);

        return $userDataDTO->isEmpty() ? null : $userDataDTO; 
    }
}