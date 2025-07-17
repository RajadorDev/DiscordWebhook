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

namespace DiscordWebhook\utils;

final class DiscordComponentUtils
{

    /**
     * @param array<string,mixed> $data
     * @param array<string,mixed> $list
     * @param callable|null $callback `(mixed) : bool`
     */
    public static function addIfTrue(array &$data, array $list, ?callable $callback = null) : void 
    {
        $callback = $callback ?? fn (mixed $value) : bool => !is_null($value);
        foreach ($list as $id => $value)
        {
            if ($callback($value))
            {
                $data[$id] = $value;
            }
        }
    }

    public static function timestamp(float $time) : string  
    {
        return date('Y-m-d\TH:i:s\Z', (int) $time);
    }
    
}