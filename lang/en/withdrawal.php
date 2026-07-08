<?php

declare(strict_types=1);

return [
    'page_title' => 'Withdrawal / cancellation declaration',
    'intro' => 'Under Hungarian Government Decree 45/2014. (II. 26.), fill in and submit the declaration below to withdraw from or cancel the contract. We will confirm receipt on a durable medium (by email) without delay. The consumer has the right to withdraw without justification within 14 days of receiving the goods.',
    'template_heading' => 'Withdrawal / cancellation declaration template',
    'template_note' => '(complete and return only if you intend to withdraw from or cancel the contract)',
    'addressee' => 'Addressee',
    'statement' => 'I/we hereby declare that I/we exercise my/our right of withdrawal or cancellation in respect of the contract for the sale of the following goods or the provision of the following service:',
    'fields' => [
        'type' => 'Declaration type',
        'subject' => 'Goods / service',
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
    'confirmation_subject' => 'Confirmation of your withdrawal / cancellation declaration',
    'confirmation_intro' => 'We hereby confirm that we have received your withdrawal / cancellation declaration below:',
    'merchant_subject' => 'New withdrawal / cancellation declaration received',
    'merchant_intro' => 'A new withdrawal / cancellation declaration has been received with the following details:',
    'email_footer' => 'This email is your confirmation on a durable medium under Hungarian Government Decree 45/2014. (II. 26.). Please keep it for your records.',
];
