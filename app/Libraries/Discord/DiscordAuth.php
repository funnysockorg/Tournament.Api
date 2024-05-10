<?php

namespace App\Libraries\Discord;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class DiscordAuth
{
    private string $oauthUrl = 'https://discord.com/api/oauth2/token';
    
    public function auth(string $discordCode): Response
    {
        $data = [
            'grant_type' => 'authorization_code',
            'code' => $discordCode,
            'redirect_uri' => route('api.discord.callback'),

        ];

        $clientId = config('discord.client_id');
        $secretKey = config('discord.secret_key');

        return Http::asForm()
            ->withHeaders(['Content-Type' => 'application/x-www-form-urlencoded'])
            ->withBasicAuth($clientId, $secretKey)
            ->post($this->oauthUrl, $data);
    }
}