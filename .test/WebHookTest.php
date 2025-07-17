<?php

declare (strict_types=1);

require __DIR__ . '\\..\\vendor\\autoload.php';

use DiscordWebhook\content\DiscordMessage;
use DiscordWebhook\content\embed\Embed;
use DiscordWebhook\content\embed\property\Author;
use DiscordWebhook\content\embed\property\Footer;
use DiscordWebhook\utils\DiscordComponentUtils;
use DiscordWebhook\WebHook;

$settings = [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYSTATUS => false];

$url = 'https://discord.com/api/webhooks/1310599698310103120/VHWxvQ_rAlkw-eyTKaIxunbzrn09wvREX9r0FkT97VpwSIVL2wqlCHpUSPA4IofFZt85';

$webhook = WebHook::create($url);

$message = DiscordMessage::create(
    'This is the content',
    'My Username',
    'https://myrightbird.com/assets/uploads/mybird_sun_conure_on_perch.jpg',
    [
        Embed::create(
            'Teste', 
            'This is a test embed',
            url: 'https://github.com/RajadorDev/DiscordWebhook',
            author: Author::create('Rajador', 'https://github.com/RajadorDev', 'https://avatars.githubusercontent.com/u/125204182?s=400&u=85fca4a168cad68dcc0fc5a187e2f0817e865180&v=4'),
            footer: Footer::create('This is footer', 'https://static.wixstatic.com/media/19e924_216e1105c0774407b663ede3fbae9d2a~mv2.png')
        )
        ->setColor(3560428) //Blue
        ->generateTimestamp()
    ]
);

$webhook->send($message, curlSettings: $settings);