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

namespace DiscordWebhook\content\embed;

use DiscordWebhook\content\DiscordContent;
use DiscordWebhook\content\embed\property\Author;
use DiscordWebhook\content\embed\property\Color;
use DiscordWebhook\content\embed\property\Description;
use DiscordWebhook\content\embed\property\EmbedUrl;
use DiscordWebhook\content\embed\property\Footer;
use DiscordWebhook\content\embed\property\Image;
use DiscordWebhook\content\embed\property\Timestamp;
use DiscordWebhook\content\embed\property\Title;

class Embed extends DiscordContent
{

    public function __construct(
        string $title,
        ?string $description = null,
        ?int $color = null,
        ?string $url = null,
        ?Author $author = null,
        ?Footer $footer = null,
        ?string $timestamp = null
    )
    {
        $this->setTitle($title);
        foreach ([
            'description',
            'color',
            'url',
            'author',
            'footer',
            'timestamp'
        ] as $varname) {
            $var = $$varname;
            if (!is_null($var))
            {
                $functionName = 'set' . ucfirst($varname);
                $this->{$functionName}($var);
            }
        }
    }

    /**
     * @param string $title
     * @param string|null $description
     * @param integer|null $color
     * @param string|null $url
     * @param Author|null $author
     * @param Footer|null $footer
     * @return self
     */
    public static function create(
        string $title,
        ?string $description = null,
        ?int $color = null,
        ?string $url = null,
        ?Author $author = null,
        ?Footer $footer = null,
        ?string $timestamp = null
    ) : self
    {
        return new self($title, $description, $color, $url, $author, $footer, $timestamp);
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
        $this->addComponent(new EmbedUrl($url));
        return $this;
    }

    public function setColor(int $newColor) : Embed
    {
        $this->addComponent(new Color($newColor));
        return $this;
    }

    public function setAuthor(Author $author) : Embed
    {
        $this->addComponent($author);
        return $this;
    }

    public function setFooter(Footer $footer) : Embed
    {
        $this->addComponent($footer);
        return $this;
    }

    public function setTimestamp(string|int $timestamp) : Embed
    {
        $this->addComponent(new Timestamp($timestamp));
        return $this;
    }

    public function generateTimestamp() : Embed
    {
        $this->setTimestamp(time());
        return $this;
    }

    /**
     * You can add Thumbnails too @see DiscordWebhook\content\embed\property\Thumbnail
     *
     * @param Image $image
     * @return Embed
     */
    public function addImage(Image $image) : Embed
    {
        $this->addComponent($image);
        return $this;
    }

}