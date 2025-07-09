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

use JsonSerializable;
use DiscordWebhook\content\component\DiscordComponent;

abstract class DiscordContent implements JsonSerializable
{

    /** @var array<string,DiscordComponent> */
    protected array $components = [];

    public function addComponent(DiscordComponent $component) : DiscordContent
    {
        $this->components[$component->getId()] = $component;
        return $this;
    }

    /**
     * @param string|DiscordComponent $component
     * @return boolean Return true if the component is registered here
     */
    public function removeComponent(string|DiscordComponent $component) : bool 
    {
        $componentId = $component instanceof DiscordComponent ? $component->getId() : $component;
        if (isset($this->components[$componentId]))
        {
            unset($this->components[$componentId]);
            return true;
        }
        return false;
    }

    public function getComponent(string $id) : ?DiscordComponent
    {
        return $this->components[$id] ?? null;
    }

    public function hasComponent(string $id) : bool 
    {
        return !is_null($this->getComponent($id));
    }

    /**
     * @return DiscordComponent[]
     */
    public function getComponents() : array
    {
        return $this->components;
    }

    public function jsonSerialize() : mixed
    {
        $components = [];
        foreach ($this->getComponents() as $component)
        {
            if ($component->canBeUsed())
            {
                $components[$component->getId()] = $component->jsonSerialize();
            }
        }
        return array_merge(
            $components,
            $this->serializeExtraData()
        );
    }

    public function serializeExtraData() : array
    {
        return [];
    }

}