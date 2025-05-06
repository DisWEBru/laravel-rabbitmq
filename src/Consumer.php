<?php

namespace Diswebru\LaravelRabbitMQ;

use Diswebru\LaravelRabbitMQ\Interfaces\ConsumerInterface;
use Closure;

class Consumer extends MessageAbstract implements ConsumerInterface
{
    public function run(Closure $handler): void
    {
        $this->connect();

        $this->channel->queue_declare('queue', false, true, false, false);

        $this->channel->queue_bind('queue', "app.topic.{$this->topicName}");

        $this->channel->basic_consume('queue', '', false, false, false, false,
            function (\PhpAmqpLib\Message\AMQPMessage $msg) use ($handler) {
                $msg = AMQPMessage::fromBaseMessage($msg);
                // $msg->body - text
                // $msg->getJson() - array
                $handler($msg);

                $this->channel->basic_ack($msg->delivery_info['delivery_tag']);
            });

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public static function setTopic(string $name): self
    {
        return (new self())->topic($name);
    }
}
