<?php

declare (strict_types=1);

/***
 *   
 * Rajador Developer
 * 
 * ▒█▀▀█ ░█▀▀█ ░░░▒█ ░█▀▀█ ▒█▀▀▄ ▒█▀▀▀█ ▒█▀▀█ 
 * ▒█▄▄▀ ▒█▄▄█ ░▄░▒█ ▒█▄▄█ ▒█░▒█ ▒█░░▒█ ▒█▄▄▀ 
 * ▒█░▒█ ▒█░▒█ ▒█▄▄█ ▒█░▒█ ▒█▄▄▀ ▒█▄▄▄█ ▒█░▒█
 * 
 * GitHub: https://github.com/RajadorDev
 * 
 * Discord: rajadortv
 * 
 * 
**/

namespace DiscordWebhook;

use DiscordWebhook\exception\InvalidDiscordWebhookException;

final class WebHookAPI 
{

    const DISCORD_HOST = 'discord.com';

    const WEBHOOK_API_PATH = 'webhook';

    /**
     * @param string $url
     * @return void
     * @throws InvalidDiscordWebhookException
     */
    public static function checkURL(string $url) : void
    {
        $url = parse_url(self::DISCORD_HOST);
        if (!is_array($url) || !isset($url['host'], $url['path']) || strtolower($url['host']) != self::DISCORD_HOST || !str_contains(self::WEBHOOK_API_PATH, $url['path']))
        {
            throw new InvalidDiscordWebhookException($url);
        }
    }

}