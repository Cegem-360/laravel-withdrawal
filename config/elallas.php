<?php

declare(strict_types=1);

use Cegem360\Elallas\Models\WithdrawalDeclaration;

return [
    'seller' => [
        'name' => env('ELALLAS_SELLER_NAME', ''),
        'address' => env('ELALLAS_SELLER_ADDRESS', ''),
        'email' => env('ELALLAS_SELLER_EMAIL', ''),
    ],

    'notify_email' => env('ELALLAS_NOTIFY_EMAIL'),

    'route' => [
        'prefix' => env('ELALLAS_ROUTE_PREFIX', 'elallasi-nyilatkozat'),
        'middleware' => ['web'],
    ],

    'table' => 'elallas_declarations',

    'model' => WithdrawalDeclaration::class,

    'redirect_after' => null,
];
