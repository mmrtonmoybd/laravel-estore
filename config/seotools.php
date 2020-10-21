<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        // The default configurations to be used by the meta generator.
        'defaults' => [
            'title' => env('APP_NAME', 'Moshiur'), // set false to total remove
            'titleBefore' => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description' => 'Make your life eazy. Buy best product with us.', // set false to total remove
            'separator' => ' - ',
            'keywords' => [env('APP_NAME', 'Moshiur'), 'Ecommerce', 'Online Shopping', 'T shirt'],
            'canonical' => false, // Set null for using Url::current(), set false to total remove
            'robots' => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        // Webmaster tags are always added.
        'webmaster_tags' => [
            'google' => 'kkfkkckfkkckc',
            'bing' => 'kfkkcjckcnkc',
            'alexa' => null,
            'pinterest' => null,
            'yandex' => null,
            'norton' => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        // The default configurations to be used by the opengraph generator.
        'defaults' => [
            'title' => 'Moshiur Ecommerce Site', // set false to total remove
            'description' => 'Make your life eazy. Buy best product with us.', // set false to total remove
            'url' => false, // Set null for using Url::current(), set false to total remove
            'type' => false,
            'site_name' => env('APP_NAME', 'Moshiur'),
            'images' => [env('APP_URL').'/home/home.jpg'],
        ],
    ],
    'twitter' => [
        // The default values to be used by the twitter cards generator.
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        // The default configurations to be used by the json-ld generator.
        'defaults' => [
            'title' => 'Moshiur Ecommerce', // set false to total remove
            'description' => 'Make your life eazy. Buy best product with us.', // set false to total remove
            'url' => false, // Set null for using Url::current(), set false to total remove
            'type' => 'WebPage',
            'images' => [env('APP_URL').'/home/home.jpg'],
        ],
    ],
];
