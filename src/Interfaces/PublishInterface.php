<?php

namespace Diswebru\LaravelRabbitMQ\Interfaces;

interface PublishInterface
{
    public function sent(array $message): void;
}
