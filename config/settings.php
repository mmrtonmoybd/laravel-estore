<?php
return [
/*
Item displaying limit for pagination
*/
'max_item_per_page' => \App\Setting::getValue('item_per_page'),

'max_discounded_item' => \App\Setting::getValue('item_per_column'),

'max_related_item' => \App\Setting::getValue('item_per_column'),

'max_latest_item' => \App\Setting::getValue('item_per_column'),
//Tax that will be charge in checkout
'vat' => \App\Setting::getValue('vat'),

//stripe secret key
'stripe_secret' => \App\Setting::getValue('stripe_secret'),

//stripe publishable key
'stripe_publishable' => \App\Setting::getValue('stripe_public'),

//stripe currency that will be used in checkout
'stripe_currency' => \App\Setting::getValue('currency'),
]
?>