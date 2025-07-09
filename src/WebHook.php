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


class WebHook 
{

    public function __construct(
        protected string $url
    )
    {
        $this->parseURL();
    }

    protected function parseURL() : void 
    {
        WebHookAPI::checkURL($this->url);
    }

    public function getUrl() : string 
    {
        return $this->url;
    }

    public function setUrl(string $url) : void 
    {
        $this->url = $url;
        $this->parseURL();
    }

    public function send()
    {
        
    }
}