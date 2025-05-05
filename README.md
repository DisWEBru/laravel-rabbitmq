# Laravel RabbitMQ

## Installation

```bash
composer require diswebru/laravel-rabbitmq
```

You need to publish the configuration file using

```bash
php artisan vendor:publish --tag=laravel-rabbitmq-config
```

.env:

```
RABBITMQ_SSL=false
RABBITMQ_HOST=127.0.0.1
RABBITMQ_PORT=5672
RABBITMQ_USER=guest
RABBITMQ_PASSWORD=guest
```

## Examples

Sending a message to the test topic

```php
use Diswebru\LaravelRabbitMQ\Publish;

(new Publish)->topic('test')->sent(['message-key' => 'message-value']);
```

Retrieve unprocessed messages from the test topic

```php
use Diswebru\LaravelRabbitMQ\Consumer;
use Diswebru\LaravelRabbitMQ\AMQPMessage;

Consumer::start('test', function (AMQPMessage $message) {
    $data = $message->getJson();

    if (!isset($data['message-key']) && $data['message-key'] != 'message-value') {
        // There will be no commit
        throw new \Exception('Error message');
    }
});
```
