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

class EmbedList extends DiscordComponent
{

    /** @var Embed[] */
    protected array $embeds = [];

    public function getId(): string
    {
        return 'embeds';
    }

    public function count() : int 
    {
        return count($this->embeds);
    }

    public function canBeUsed() : bool 
    {
        return (bool) $this->count();
    }

    /** @return Embed[] */
    public function getAll() : array 
    {
        return $this->embeds;
    }

    public function add(Embed $embed) : EmbedList
    {
        $this->embeds[] = $embed;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return array_map(
            fn (Embed $embed) : array => $embed->jsonSerialize(),
            $this->embeds
        );
    }

}