<?php

declare(strict_types=1);

return [
    'page_title' => 'Withdrawal/Cancellation declaration',
    'intro' => 'Under Hungarian Government Decree 45/2014. (II. 26.), fill in and submit the declaration below to withdraw from or cancel the contract. We will confirm receipt on a durable medium (by email) without delay.',
    'template_heading' => 'Elállási/Felmondási nyilatkozatminta',
    'template_note' => '(fill in and return only if you wish to withdraw from/cancel the contract)',
    'addressee' => 'Addressee',
    'statement' => 'I/We hereby give notice that I/we withdraw from/cancel my/our contract for the sale of the following goods or the supply of the following service:',
    'fields' => [
        'type' => 'Declaration type',
        'subject' => 'Goods/service',
        'contract_date' => 'Date of conclusion / receipt',
        'consumer_name' => 'Consumer name(s)',
        'consumer_address' => 'Consumer address',
        'consumer_email' => 'Consumer email',
        'order_reference' => 'Order reference (if any)',
        'message' => 'Note',
        'dated' => 'Dated',
    ],
    'signature_note' => 'Signature (only for paper declarations). For online submissions the declaration is valid without a signature.',
    'submit' => 'Submit declaration',
    'success_title' => 'We received your declaration',
    'success_body' => 'Thank you. We have confirmed receipt by email to the address you provided.',
    'confirmation_subject' => 'Confirmation of your withdrawal/cancellation declaration',
    'confirmation_intro' => 'We hereby confirm that we have received your withdrawal/cancellation declaration below:',
    'merchant_subject' => 'New withdrawal/cancellation declaration received',
];
