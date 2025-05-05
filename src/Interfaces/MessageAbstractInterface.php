<?php

namespace Diswebru\LaravelRabbitMQ\Interfaces;

use Diswebru\LaravelRabbitMQ\MessageAbstract;

interface MessageAbstractInterface
{
    public function topic(string $name): MessageAbstract;
}
