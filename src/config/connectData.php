<?php

return [
    'production' => [
        'url' => 'https://production-apigateway.fashionphile.com/transactional/journey',
        'apiKey' => $_ENV['APP_ENV_PRODUCTION'] ?? 'APP_ENV_PRODUCTION'
    ],
    'staging' => [
        'url' => 'https://staging-apigateway.fashionphile.com/transactional/journey',
        'apiKey' => $_ENV['APP_ENV_STAGING'] ?? 'APP_ENV_STAGING'
    ],
    'development' => [
        'url' => 'https://testing-apigateway.fashionphile.com/transactional/journey',
        'apiKey' => $_ENV['APP_ENV_DEVELOPMENT'] ?? 'APP_ENV_DEVELOPMENT'
    ]
];
