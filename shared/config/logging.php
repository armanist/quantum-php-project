<?php

return [
    /**
     * ---------------------------------------------------------
     * Logging configurations
     * ---------------------------------------------------------
     */
    'default' => 'single',

    'single' => [
        'path' => logs_dir() . DS . 'app.log',
        'level' => 'info',
    ],

    'daily' => [
        'path' => logs_dir(),
        'level' => 'warning',
    ],

    /**
     * In debug mode the web app keeps its log messages in memory for the debug toolbar.
     * Only the last `limit` messages are kept; 0 keeps every message.
     */
    'message' => [
        'limit' => 1000,
    ],
];
