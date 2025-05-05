<?php

namespace Diswebru\LaravelRabbitMQ;

use Diswebru\LaravelRabbitMQ\Interfaces\MessageAbstractInterface;
use PhpAmqpLib\Connection\AMQPSSLConnection;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Channel\AMQPChannel;

abstract class MessageAbstract implements MessageAbstractInterface
{
    protected string $topicName;
    protected AMQPSSLConnection|AMQPStreamConnection $connection;
    protected AMQPChannel $channel;

    public function topic(string $name): MessageAbstract
    {
        $this->topicName = $name;

        return $this;
    }

    protected function connect(): void
    {
        if (config('rabbitmq.ssl')) {
            $this->connection = new AMQPSSLConnection(
                host: config('rabbitmq.host'),
                port: config('rabbitmq.port'),
                user: config('rabbitmq.user'),
                password: config('rabbitmq.password'),
                vhost: '/',
                ssl_options: $this->sslOptions(),
            );
        } else {
            $this->connection = new AMQPStreamConnection(
                host: config('rabbitmq.host'),
                port: config('rabbitmq.port'),
                user: config('rabbitmq.user'),
                password: config('rabbitmq.password'),
                vhost: '/',
            );
        }

        $this->channel = $this->connection->channel();

        $this->channel->exchange_declare("app.topic.{$this->topicName}", 'topic', false, true, false);
    }

    protected function sslOptions(): array
    {
        return [
            'verify_peer'       => config('rabbitmq.verify_peer'),
            'verify_peer_name'  => config('rabbitmq.verify_peer_name'),
            'allow_self_signed' => config('rabbitmq.allow_self_signed'),
            'crypto_method'     => config('rabbitmq.crypto_method'),
        ];
    }
}
