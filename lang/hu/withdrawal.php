<?php

declare(strict_types=1);

return [
    'page_title' => 'Elállási/Felmondási nyilatkozat',
    'intro' => 'A 45/2014. (II. 26.) Korm. rendelet alapján a szerződéstől való elállási/felmondási szándék esetén töltse ki és küldje be az alábbi nyilatkozatot. A beérkezést tartós adathordozón (e-mailben) haladéktalanul visszaigazoljuk. A fogyasztót a termék átvételétől számított 14 napon belül illeti meg az indokolás nélküli elállás joga.',
    'template_heading' => 'Elállási/Felmondási nyilatkozatminta',
    'template_note' => '(csak a szerződéstől való elállási/felmondási szándék esetén töltse ki és juttassa vissza)',
    'addressee' => 'Címzett',
    'statement' => 'Alulírott(ak) kijelentem/kijelentjük, hogy gyakorlom/gyakoroljuk elállási/felmondási jogomat/jogunkat az alábbi termék(ek) adásvételére vagy az alábbi szolgáltatás nyújtására irányuló szerződés tekintetében:',
    'fields' => [
        'type' => 'A nyilatkozat típusa',
        'subject' => 'A termék(ek)/szolgáltatás megnevezése',
        'contract_date' => 'Szerződéskötés / átvétel időpontja',
        'consumer_name' => 'A fogyasztó(k) neve',
        'consumer_address' => 'A fogyasztó(k) címe',
        'consumer_email' => 'A fogyasztó(k) e-mail címe',
        'order_reference' => 'Rendelési azonosító (ha van)',
        'message' => 'Megjegyzés',
        'dated' => 'Kelt',
    ],
    'signature_note' => 'Aláírás (kizárólag papíron tett nyilatkozat esetén). Online beküldés esetén a nyilatkozat aláírás nélkül is érvényes.',
    'submit' => 'Nyilatkozat beküldése',
    'success_title' => 'A nyilatkozatot megkaptuk',
    'success_body' => 'Köszönjük. A beérkezést e-mailben visszaigazoltuk a megadott címre.',
    'confirmation_subject' => 'Elállási/felmondási nyilatkozat visszaigazolása',
    'confirmation_intro' => 'Ezúton visszaigazoljuk, hogy az alábbi elállási/felmondási nyilatkozata hozzánk beérkezett:',
    'merchant_subject' => 'Új elállási/felmondási nyilatkozat érkezett',
    'merchant_intro' => 'Új elállási/felmondási nyilatkozat érkezett az alábbi adatokkal:',
    'email_footer' => 'Ez az e-mail a 45/2014. (II. 26.) Korm. rendelet szerinti, tartós adathordozón adott visszaigazolás. Kérjük, őrizze meg.',
];
