<?php

return [
    'name' => getenv('APP_NAME'),
    'version' => [
        'alias' => 'candy',
        'numeric' => [
            'ver' => '1.0',
            'meta' => 'Updates decription',
        ]
    ],
    'debug' => getenv('DEBUG')
];