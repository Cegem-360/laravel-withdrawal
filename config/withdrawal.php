<?php

declare(strict_types=1);

use Cegem360\Withdrawal\Models\WithdrawalDeclaration;

return [
    'seller' => [
        'name' => env('WITHDRAWAL_SELLER_NAME', ''),
        'address' => env('WITHDRAWAL_SELLER_ADDRESS', ''),
        'email' => env('WITHDRAWAL_SELLER_EMAIL', ''),
    ],

    'notify_email' => env('WITHDRAWAL_NOTIFY_EMAIL'),

    'route' => [
        'prefix' => env('WITHDRAWAL_ROUTE_PREFIX', 'elallasi-nyilatkozat'),
        'middleware' => ['web'],
    ],

    'table' => 'withdrawal_declarations',

    'model' => WithdrawalDeclaration::class,

    'redirect_after' => null,
];
