<?php
$env = include('config/connectData.php');
return [
    'production' => [
        'url' => 'https://production-uri.com/transactional/journey',
        'apiKey' => 'unknownkeygoeshere'
    ],
    'staging' => [
        'url' => 'https://staging-uri.com/transactional/journey',
        'apiKey' => 'unknownkeygoeshere2'
    ],
    'development' => [
        'url' => 'https://testing-uri.com/transactional/journey',
        'apiKey' => 'unknownkeygoeshere3'
    ]
];
