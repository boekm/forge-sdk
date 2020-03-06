<?php

return [
    /**
     * Your Forge API token.
     */
    'token' => env('FORGE_TOKEN'),

    /**
     * Here you may specify default credentials for specific providers.
     *
     * Provider shortcodes:
     *
     * - DigitalOcean: "ocean2"
     * - Linode: "linode"
     * - AWS: "aws"
     */
    'default_credentials' => [
        'ocean2' => env('FORGE_DO_CREDENTIALS'),
    ],

    'recipe' => env('FORGE_RECIPE'),
];
