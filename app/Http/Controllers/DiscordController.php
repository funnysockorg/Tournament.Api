<?php

namespace App\Http\Controllers;

use App\Libraries\Discord\DiscordAuth;
use App\Libraries\Discord\DiscordSessionKeys;
use App\Libraries\Discord\DiscordUserData;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DiscordController extends Controller
{
    public function getUserToken(string $code): JsonResponse
    {
        $response = (new DiscordAuth())->auth($code);

        $tokenData = json_decode($response->body());

        if (!empty($tokenData->error_description)) {
            return response()->json([
                'status' => 'failed',
                'reason' => $tokenData->error_description,
            ], 400);
        }

        return respinse()->json([
            'token' => $tokenData->access_token,
            'expiresIn' => Carbon::now()->addSeconds($tokenData->expires_in)->timestamp,
        ], 200);

    }

    public function getUserData(): JsonResponse
    {
        $userToken = session()->get(DiscordSessionKeys::ACCESS_TOKEN);

        $userData = (new DiscordUserData())->getUserData($userToken);

        if ($userData->isEmpty()) {
            return response()->json(['error' => 'Ошибка! Данные пользователя не удалось получить!']);
        }

        return response()->json($userData->toJsonString(), 200);
    }
}
