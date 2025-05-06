<?php

namespace Diswebru\LaravelRabbitMQ;

use PhpAmqpLib\Message\AMQPMessage as BaseAMQPMessage;

class AMQPMessage extends BaseAMQPMessage
{
    public function getJson()
    {
        return json_decode($this->body, true);
    }

    public static function fromBaseMessage(BaseAMQPMessage $base): self
    {
        $msg = new self($base->getBody(), $base->get_properties());

        $msg->delivery_info = $base->delivery_info;

        return $msg;
    }
}
