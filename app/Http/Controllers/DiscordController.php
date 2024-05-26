<?php

namespace App\Http\Controllers;

use App\Libraries\Discord\DiscordAuth;
use App\Libraries\Discord\DiscordUserData;
use App\Libraries\Discord\DTO\DiscordTokenDataDTO;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class DiscordController extends Controller
{
    public function getUserToken(string $code): JsonResponse
    {
        $response = (new DiscordAuth())->auth($code);

        $tokenDataDTO = new DiscordTokenDataDTO($response);

        if (!empty($tokenDataDTO->getErrorDescription())) {
            return response()->json([
                'status' => 'failed',
                'reason' => $tokenDataDTO->getErrorDescription(),
            ], 400);
        }

        $userDataDTO = (new DiscordUserData())->getUserData($tokenDataDTO->getAccessToken());

        if (empty($userDataDTO->isEmpty())) {
            return response()->json([
                'status' => 'failed',
                'reason' => 'Данные полученные по токену оказались пустыми!',
            ], 400);
        }

        User::createFromDiscordData($userData, $tokenDataDTO)

        return response()->json([
            'token' => $tokenDataDTO->getAccessToken(),
            'expiresIn' => $tokenDataDTO->getExpiresIn()->timestamp,
        ], 200);
    }

    // public function getUserData(): JsonResponse
    // {
    //     $userToken = session()->get(DiscordSessionKeys::ACCESS_TOKEN);

    //     $userData = (new DiscordUserData())->getUserData($userToken);

    //     if ($userData->isEmpty()) {
    //         return response()->json(['error' => 'Ошибка! Данные пользователя не удалось получить!']);
    //     }

    //     return response()->json($userData->toJsonString(), 200);
    // }
}
