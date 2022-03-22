<?php

return [
    'production' => [
        'url' => $_ENV('EMAIL_CLOUD_URL_PROD') ?? 'https://production-apigateway.fashionphile.com/transactional/journey',
        'apiKey' => $_ENV['EMAIL_CLOUD_KEY_PROD'] ?? 'EMAIL_CLOUD_KEY'
    ],
    'staging' => [
        'url' => $_ENV('EMAIL_CLOUD_URL_STAGING') ?? 'https://staging-apigateway.fashionphile.com/transactional/journey',
        'apiKey' => $_ENV['EMAIL_CLOUD_KEY_STAGING'] ?? 'EMAIL_CLOUD_KEY'
    ],
    'development' => [
        'url' => $_ENV('EMAIL_CLOUD_URL_DEV') ?? 'https://testing-apigateway.fashionphile.com/transactional/journey',
        'apiKey' => $_ENV['EMAIL_CLOUD_KEY_DEV'] ?? 'EMAIL_CLOUD_KEY'
    ]
];
