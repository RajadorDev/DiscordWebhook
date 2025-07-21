# DiscordWebhook 🔗

> System created to send webhooks to Discord in an easy, fast, and intuitive way.

## Instalation ⬇️

> You can install using composer:
```bash
composer require rajador/discord-webhook
```

## Code Example: 📝

To create a webhook, use:

```php
$url = 'your_webhook_link';

$webhook = new WebHook($url);

$message = new DiscordMessage(
    'Here is the message content',
    'Username Here',
    null, // You can put an avatar URL here
    [
        (new Embed(
            'Embed Title',
            'Embed description',
            10, // Embed color
            'https://...', // Embed URL here
            new Author(
                'Embed Author Name',
                'https://...', // Author URL
                'https://...' // Author icon URL
            ),
            new Footer(
                'Footer text',
                'https://...' // Footer icon URL
            )
        ))->generateTimestamp() // Generates a timestamp
    ]
);
$webhook->send($message); // Message sent
```