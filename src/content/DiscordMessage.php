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

namespace DiscordWebhook\content;

use DiscordWebhook\content\component\Avatar;
use DiscordWebhook\content\component\EmbedList;
use DiscordWebhook\content\component\TextContent;
use DiscordWebhook\content\component\Username;
use DiscordWebhook\exception\InvalidMessageException;

class DiscordMessage extends DiscordContent
{

    /** @var EmbedList */
    protected EmbedList $embeds;

    public function __construct(
        ?string $content = null,
        ?string $username = null,
        ?string $avatarUrl = null,
        array $embeds = []
    )
    {
        foreach (['content' => 'setTextContent', 'username' => 'setUsername', 'avatarUrl' => 'setAvatar'] as $varName => $varSetter)
        {
            $var = $$varName;
            if (!is_null($var))
            {
                $this->{$varSetter}($var);
            }
        }
        foreach ($embeds as $embed)
        {
            $this->embeds->add($embed);
        }
    }

    public function setTextContent(string $text) : DiscordMessage
    {
        $this->addComponent(new TextContent($text));
        return $this;
    }

    public function setUsername(string $username) : DiscordMessage
    {
        $this->addComponent(new Username($username));
        return $this;
    }

    public function setAvatar(string $url) : DiscordMessage
    {
        $this->addComponent(new Avatar($url));
        return $this;
    }

    public function valid() : void 
    {
        if (!$this->hasComponent('content') && !$this->embeds->canBeUsed())
        {
            throw new InvalidMessageException('Webhook message must to have TextContent component or at least a embed');
        }
    }

}