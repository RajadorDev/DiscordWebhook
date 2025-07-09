<?php

declare (strict_types=1);

require __DIR__ . '\\..\\vendor\\autoload.php';

use DiscordWebhook\content\DiscordMessage;
use DiscordWebhook\content\embed\Embed;
use DiscordWebhook\content\embed\property\Footer;
use DiscordWebhook\WebHook;

$settings = [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYSTATUS => false];
$message = DiscordMessage::create()
->setTextContent("This is a test");
WebHook::staticSend(
    "https://discord.com/api/webhooks/1310599698310103120/VHWxvQ_rAlkw-eyTKaIxunbzrn09wvREX9r0FkT97VpwSIVL2wqlCHpUSPA4IofFZt85",
     $message, 
     curlSettings: $settings
)
->send($message->addEmbed(
    Embed::create('testezinhoouu')
    ->setDescription('Olá mundo')
), curlSettings: $settings);