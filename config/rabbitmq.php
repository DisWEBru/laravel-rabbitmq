<?php

return [
    'ssl' => env('RABBITMQ_SSL', false),

    'host' => env('RABBITMQ_HOST', '127.0.0.1'),
    'port' => env('RABBITMQ_PORT', 5672),
    'user' => env('RABBITMQ_USER', 'guest'),
    'password' => env('RABBITMQ_PASSWORD', 'guest'),

    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true,
    'crypto_method' => STREAM_CRYPTO_METHOD_TLS_CLIENT,
];
