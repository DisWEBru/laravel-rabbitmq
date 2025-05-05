<?php

namespace Diswebru\LaravelRabbitMQ\Interfaces;

use Closure;

interface ConsumerInterface
{
    public function start(Closure $handler): void;
}
