<?php

return [
    /**
     * ---------------------------------------------------------
     * Language configurations
     * ---------------------------------------------------------
     */
    'default' => 'file',
    'supported' => ['en', 'es'],
    'default_locale' => 'en',
    'url_segment' => 1,
    'file' => [],
    'deepl' => [
        'use_source_catalog' => true,
        'auth_key' => '',
        'source_locale' => 'en',
        'cache' => [
            'enabled' => true,
            'default' => 'file',
            'ttl' => 3600,
            'prefix' => 'lang_deepl:',
        ],
    ],
    'google_translate' => [
        'use_source_catalog' => true,
        'api_key' => '',
        'source_locale' => 'en',
        'cache' => [
            'enabled' => true,
            'default' => 'file',
            'ttl' => 3600,
            'prefix' => 'lang_google_translate:',
        ],
    ],
];
