<?php

namespace App\Utilities;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class TelegramMessage
{
    public static function send(string $text, string $chatId = null): Response
    {
        return Http::post(
            sprintf('https://api.telegram.org/bot%s/sendMessage', config('services.telegram.bot_token')),
            [
                'chat_id' => $chatId ?: config('services.telegram.chat_id'),
                'text' => $text,
            ]
        );
    }
}
