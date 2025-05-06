<?php

namespace Diswebru\LaravelRabbitMQ\Interfaces;

use Closure;

interface ConsumerInterface
{
    public function run(Closure $handler): void;
}
