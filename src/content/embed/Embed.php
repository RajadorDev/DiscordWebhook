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

namespace DiscordWebhook\content\component;

use DiscordWebhook\content\DiscordContent;
use DiscordWebhook\content\embed\property\Author;
use DiscordWebhook\content\embed\property\Description;
use DiscordWebhook\content\embed\property\Footer;
use DiscordWebhook\content\embed\property\Title;

class Embed extends DiscordContent
{

    public function __construct(
        protected string $title,
        protected ?string $description = null,
        protected ?int $color = null,
        protected ?string $url = null,
        protected ?Author $author = null,
        protected ?Footer $footer = null
    )
    {
        $this->setTitle($title);
        foreach ([
            'description',
            'color',
            'url',
            'author',
            'footer'
        ] as $varname) {
            $var = $$varname;
            if (!is_null($varname))
            {
                $functionName = 'set' . ucfirst($varname);
                $this->{$functionName}($var);
            }
        }
    }

    public function setTitle(string $title) : Embed
    {
        $this->addComponent(new Title($title));
        return $this;
    }

    public function setDescription(string $text) : Embed
    {
        $this->addComponent(new Description($text));
        return $this;
    }

    public function setUrl(string $url) : Embed
    {
        $this->addComponent(new )
    }
}