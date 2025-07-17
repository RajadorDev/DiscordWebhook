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
use DiscordWebhook\utils\DiscordComponentUtils;

class Footer extends StaticComponent
{

    /**
     * @param string $text
     * @param string|null $iconURL
     * @return self
     */
    public static function create(string $text, ?string $iconURL = null) : self 
    {
        return new self($text, $iconURL);
    }

    /**
     * @param string $text
     * @param string|null $iconUrl
     */
    public function __construct(string $text, ?string $iconUrl = null)
    {
        $data = ['text' => $text];
        DiscordComponentUtils::addIfTrue($data, [
            'icon_url' => $iconUrl
        ]);
        if (isset($data['icon_url']))
        {
            UrlComponent::parseUrl($data['icon_url']);
        }
        parent::__construct($data);
    }

    public function getId(): string
    {
        return 'footer';
    }

}