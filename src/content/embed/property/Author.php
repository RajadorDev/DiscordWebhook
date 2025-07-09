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

class Author extends StaticComponent
{

    /**
     * @param string $name Embed author name
     * @param string|null $url You can use this url to a user profile
     * @param string|null $iconUrl Need to be a image url
     */
    public static function create(string $name, ?string $url = null, ?string $iconUrl = null) : self 
    {
        return new self($name, $url, $iconUrl);
    }
    
    public function __construct(string $name, ?string $url = null, ?string $iconUrl = null)
    {
        $data = ['name' => $name];
        DiscordComponentUtils::addIfTrue(
            $data,
            [
                'url' => $url,
                'icon_url' => $iconUrl
            ],
            fn (mixed $value) : bool => (!is_null($value) && UrlComponent::parseUrl($value))
        );
        parent::__construct($data);
    }

    public function getId(): string
    {
        return 'author';
    }

}