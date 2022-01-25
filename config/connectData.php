<?php

return [
    'production' => [
        'url' => $_ENV('EMAIL_CLOUD_URL') ?? 'https://www.fakeurl.test',
        'apiKey' => $_ENV['EMAIL_CLOUD_KEY'] ?? 'EMAIL_CLOUD_KEY'
    ],
    'staging' => [
        'url' => $_ENV('EMAIL_CLOUD_URL') ?? 'https://www.fakeurl.test',
        'apiKey' => $_ENV['EMAIL_CLOUD_KEY'] ?? 'EMAIL_CLOUD_KEY'
    ],
    'development' => [
        'url' => $_ENV('EMAIL_CLOUD_URL') ?? 'https://www.fakeurl.test',
        'apiKey' => $_ENV['EMAIL_CLOUD_KEY'] ?? 'EMAIL_CLOUD_KEY'
    ]
];
