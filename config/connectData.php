<?php

$dotenv = \Dotenv\Dotenv::create(__DIR__ . '/..');
$dotenv->load();

return [
    'production' => [
        'url' => 'https://production-uri.com/transactional/journey',
        'apiKey' => getenv('APP_ENV_PRODUCTION') ?: 'APP_ENV_PRODUCTION'
    ],
    'staging' => [
        'url' => 'https://staging-uri.com/transactional/journey',
        'apiKey' => getenv('APP_ENV_STAGING') ?: 'APP_ENV_STAGING'
    ],
    'development' => [
        'url' => 'https://testing-uri.com/transactional/journey',
        'apiKey' => getenv('APP_ENV_DEVELOPMENT') ?: 'APP_ENV_DEVELOPMENT'
    ]
];
