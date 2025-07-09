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

namespace DiscordWebhook\content\embed\property;

use DiscordWebhook\content\component\StaticComponent;
use DiscordWebhook\utils\DiscordComponentUtils;

class Footer extends StaticComponent
{

    /**
     * @param string $text
     * @param string|null $iconUrl
     * @param string|null $timestamp
     */
    public function __construct(string $text, ?string $iconUrl = null, ? string $timestamp = null)
    {
        $data = ['text' => $text];
        DiscordComponentUtils::addIfNotNull($data, [
            'icon_url' => $iconUrl,
            'timestamp' => $timestamp
        ]);
        parent::__construct($data);
    }

    public function getId(): string
    {
        return 'footer';
    }

}