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

use DiscordWebhook\content\DiscordMessage;
use DiscordWebhook\content\DiscordSavedMessage;
use DiscordWebhook\exception\InvalidDiscordWebhookException;
use DiscordWebhook\exception\WebhookSendException;
use Exception;
use InvalidArgumentException;
use JsonException;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class WebHook 
{

    const DISCORD_HOST = 'discord.com';

    const WEBHOOK_API_PATH = 'webhook';

    const DATA_URL = 'webhook_url';

    const DATA_CONTENT = 'webhook_content';

    const CURL_SETTINGS = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYSTATUS => true,
        CURLOPT_POST => true
    ];

    public function __construct(
        protected string $url
    )
    {
        $this->parseURL();
    }

    public static function create(string $url) : WebHook
    {
        return new WebHook($url);
    }

    /**
     * @param string $url
     * @return void
     * @throws InvalidDiscordWebhookException
     */
    public static function checkURL(string $url) : void
    {
        $url = parse_url(self::DISCORD_HOST);
        if (!is_array($url) || !isset($url['host'], $url['path']) || strtolower($url['host']) != self::DISCORD_HOST || !str_contains(self::WEBHOOK_API_PATH, $url['path']))
        {
            throw new InvalidDiscordWebhookException($url);
        }
    }

    protected function parseURL() : void 
    {
        WebHook::checkURL($this->url);
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

    /**
     * You can send a serialized webhook using this method
     * 
     * @param string $fileName
     * @param integer $timeout
     * @param array|null $curlSettings
     * @param boolean $mergeSettings
     * @return WebHook
     */
    public static function sendFrom(string $fileName, int $timeout = 5, array $curlSettings = null, bool $mergeSettings = true) : WebHook
    {
        if (file_exists($fileName) && is_file($fileName))
        {
            $data = file_get_contents($fileName);
            $data = json_decode($data, true);
            if (isset($data[self::DATA_CONTENT], $data[self::DATA_URL]))
            {
                $message = new DiscordSavedMessage($data[self::DATA_CONTENT]);
                $webhook = new WebHook($data[self::DATA_URL]);
                $webhook->send($message, $timeout, $curlSettings, $mergeSettings);
                return $webhook;
            } else {
                throw new InvalidArgumentException("File $fileName have no valid webhook data");
            }
        } else {
            throw new FileNotFoundException("File $fileName does not found");
        }
    }

    /**
     * @param DiscordMessage $message
     * @param string $folderName 
     * @param string $fileName `DO NOT USE EXTENSION`
     * @param bool $replace If true will replace the old file (if already exists)
     * @return void
     */
    public function save(DiscordMessage $message, string $folderName, string $fileName, bool $replace = true) : void
    {
        if (!file_exists($folderName))
        {
            mkdir($folderName, recursive: true);
        }
        $totalPath = rtrim($folderName, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName . '.json';
        if (!file_exists($totalPath) || $replace)
        {
            $data = [
                self::DATA_URL => $this->getUrl(),
                self::DATA_CONTENT => $message->jsonSerialize()
            ];
            file_put_contents($totalPath, json_encode($data));
        } else {
            throw new Exception("Webhook message $totalPath already exists");
        }
    }

    /**
     * @param DiscordMessage $message
     * @param integer $timeout
     * @param array|null $curlSettings
     * @param boolean $mergeDefaultSettings
     * @return void
     * @throws WebhookSendException
     */
    public function send(DiscordMessage $message, int $timeout = 5, ?array $curlSettings = null, bool $mergeDefaultSettings = true) : void 
    {
        $message->valid();
        if ($curlSettings)
        {
            if ($mergeDefaultSettings)
            {
                $curlSettings = array_merge(self::CURL_SETTINGS, $curlSettings);
            }
        } else {
            $curlSettings = self::CURL_SETTINGS;
        }
        $curl = curl_init($this->getUrl());
        curl_setopt($curl, CURLOPT_POSTFIELDS, $message->jsonSerialize());
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt_array($curl, $curlSettings);
        $response = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($error = curl_error($curl))
        {
            curl_close($curl);
            throw new WebhookSendException($error);
        }
        if ($code > 299)
        {
            try {
                $response = json_decode($response, true, flags: JSON_THROW_ON_ERROR);
                if (isset($response['message']))
                {
                    $response = "ERROR: {$response['message']}";
                } else {
                    $response = '';
                }
            } catch (JsonException $error) {
                $response = '';
            }
            throw new WebhookSendException("HTTP code: $code $response");
        }
    }

}