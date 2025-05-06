<?php

namespace Diswebru\LaravelRabbitMQ;

use Diswebru\LaravelRabbitMQ\Interfaces\PublishInterface;
use PhpAmqpLib\Message\AMQPMessage;

class Publish extends MessageAbstract implements PublishInterface
{
    public function sent(array $message): void
    {
        $this->connect();

        $msg = new AMQPMessage(json_encode($message), ['content_type' => 'application/json']);

        $this->channel->basic_publish($msg, "app.topic.{$this->topicName}");

        $this->channel->close();
        $this->connection->close();
    }

    public static function setTopic(string $name): self
    {
        return (new self())->topic($name);
    }
}
