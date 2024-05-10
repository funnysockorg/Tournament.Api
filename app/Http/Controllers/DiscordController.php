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
    //TODO FOR TESTS, DELETE AFTER RELEAS
    public function index(): JsonResponse
    {
        return response()->json(session()->all());
    }

    public function discordRedirectGetCode(): RedirectResponse
    {
        return redirect(config('discord.redirect_url'));

    }

    public function discordAuth(Request $request): JsonResponse
    {
        $discordCode = $request->get('code');

        if (empty($discordCode)) {
            return response()->json(['error' => 'Отсуствует code!'], 400);
        }

        if (session()->has(DiscordSessionKeys::ACCESS_TOKEN)) {
            return response()->json([], 200);
        }

        $response = (new DiscordAuth())->auth($discordCode);

        $tokenData = json_decode($response->body());

        if (!empty($tokenData->error_description)) {
            return response()->json([
                'error' => 'Произошла ошибка при получении токена!',
                'message' => $tokenData->error_description,
            ], 400);
        }

        session()->put([
            DiscordSessionKeys::ACCESS_TOKEN => $tokenData->access_token,
            DiscordSessionKeys::REFRESH_TOKEN => $tokenData->refresh_token,
            DiscordSessionKeys::EXPIRES_IN => Carbon::now()->addSeconds($tokenData->expires_in)->toString(),
        ]);

        return response()->json([], 200);
    }

    public function getUserData(): JsonResponse
    {
        $userToken = session()->get(DiscordSessionKeys::ACCESS_TOKEN);

        $discordUserDataService = new DiscordUserData();

        $userData = $discordUserDataService->getUserData($userToken);

        if ($userData->isEmpty()) {
            return response()->json(['error' => 'Ошибка! Данные пользователя не удалось получить!']);
        }

        return response()->json($userData->toJsonString(), 200);
    }
}
