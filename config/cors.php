<?php
    return [
        'paths' => ['api/*'],
        'allowed_methods' => ['*'],
       'allowed_origins' => ['http://localhost:3000', 'https://agora-francia-frontend.vercel.app'], // Your React app URL
        'allowed_headers' => ['*'],
        'exposed_headers' => [],
        'max_age' => 0,
        'supports_credentials' => false,
    ];
    
