<?php

namespace App\Models;

use App\Libraries\Discord\DiscordUserData;
use App\Libraries\Discord\DTO\DiscordUserDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'discord_id',
        'name',
        'avatar_hash',
        'access_token',
        'refresh_token',
        'token_expires_in',
    ];

    // Maybe latter add Access Token and Refresh Token
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    protected function casts(): array
    {
        return [
            'token_expires_in' => 'datetime',
        ];
    }

    public function build(DiscordUserDTO $discordUserDTO): void
    {
        
    }
}
