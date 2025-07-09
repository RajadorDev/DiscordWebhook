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
use DiscordWebhook\content\component\UrlComponent;

class Image extends StaticComponent
{
    public function __construct(string $url)
    {
        UrlComponent::parseUrl($url);
        parent::__construct(['url' => $url]);
    }

    public function getId(): string
    {
        return 'image';
    }
    
}