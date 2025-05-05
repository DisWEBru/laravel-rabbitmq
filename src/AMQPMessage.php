<?php

namespace Diswebru\LaravelRabbitMQ;

use PhpAmqpLib\Message\AMQPMessage as BaseAMQPMessage;

class AMQPMessage extends BaseAMQPMessage
{
    public function getJson()
    {
        return json_decode($this->body, true);
    }
}
