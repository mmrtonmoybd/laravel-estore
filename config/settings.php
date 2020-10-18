<?php

return [
    // Item displaying limit for pagination
    'max_item_per_page' => env('MAX_PRODUCTS_PER_PAGE'),

    'max_discounded_item' => env('MAX_DISCOUNDED_PRODUCTS'),

    'max_related_item' => env('MAX_RELATED_PRODUCTS'),

    'max_latest_item' => env('MAX_LATEST_PRODUCTS'),
    //Tax that will be charge in checkout
    'vat' => env('VAT'),

    //stripe secret key
    'stripe_secret' => env('STRIPE_SECRET_KEY'),

    //stripe publishable key
    'stripe_publishable' => env('STRIPE_PUBLISHABLE_KEY'),

    //stripe currency that will be used in checkout
    'stripe_currency' => env('STRIPE_CURRENCY'),
];
