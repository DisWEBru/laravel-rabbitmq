<?php declare(strict_types=1);

namespace Diswebru\LaravelRabbitMQ\Providers;

use Illuminate\Support\ServiceProvider;
use Diswebru\LaravelRabbitMQ\Interfaces\PublishInterface;
use Diswebru\LaravelRabbitMQ\Publish;
use Diswebru\LaravelRabbitMQ\Interfaces\ConsumerInterface;
use Diswebru\LaravelRabbitMQ\Consumer;

class LaravelRabbitMQServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishesConfiguration();
    }

    public function register(): void
    {
        $this->app->bind(PublishInterface::class, Publish::class);

        $this->app->bind(ConsumerInterface::class, Consumer::class);
    }

    private function publishesConfiguration(): void
    {
        $this->publishes([
            __DIR__ . "/../../config/rabbitmq.php" => config_path('rabbitmq.php'),
        ], 'laravel-rabbitmq-config');
    }
}
