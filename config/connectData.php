<?php

return [
    'production' => [
        'url' => $_ENV('EMAIL_CLOUD_URL_PROD') ?? 'https://www.fakeurl.test',
        'apiKey' => $_ENV['EMAIL_CLOUD_KEY_PROD'] ?? 'EMAIL_CLOUD_KEY'
    ],
    'staging' => [
        'url' => $_ENV('EMAIL_CLOUD_URL_STAGING') ?? 'https://www.fakeurl.test',
        'apiKey' => $_ENV['EMAIL_CLOUD_KEY_STAGING'] ?? 'EMAIL_CLOUD_KEY'
    ],
    'development' => [
        'url' => $_ENV('EMAIL_CLOUD_URL_DEV') ?? 'https://www.fakeurl.test',
        'apiKey' => $_ENV['EMAIL_CLOUD_KEY_DEV'] ?? 'EMAIL_CLOUD_KEY'
    ]
];
