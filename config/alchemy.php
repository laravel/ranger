<?php

return [
    'generate' => [
        'route' => [
            'actions' => env('ranger_GENERATE_ROUTE_ACTIONS', true),
            'routes' => env('ranger_GENERATE_ROUTES', true),
            'form_variant' => env('ranger_GENERATE_FORM_VARIANT', true),
        ],
        'models' => env('ranger_GENERATE_MODELS', true),
    ],
];
