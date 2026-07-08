<?php

declare(strict_types=1);

return [
    'page_title' => 'Widerrufs- / Kündigungserklärung',
    'intro' => 'Gemäß der ungarischen Regierungsverordnung 45/2014. (II. 26.) füllen Sie die nachstehende Erklärung aus und senden Sie sie ab, um vom Vertrag zurückzutreten oder ihn zu kündigen. Wir bestätigen den Eingang unverzüglich auf einem dauerhaften Datenträger (per E-Mail). Der Verbraucher hat das Recht, innerhalb von 14 Tagen nach Erhalt der Ware ohne Angabe von Gründen zu widerrufen.',
    // Gesetzlicher Mustertext (Verordnung 45/2014) — bleibt auf Ungarisch, da dies der rechtsverbindliche Wortlaut ist.
    'template_heading' => 'Elállási/Felmondási nyilatkozatminta',
    'template_note' => '(csak a szerződéstől való elállási/felmondási szándék esetén töltse ki és juttassa vissza)',
    'addressee' => 'Empfänger',
    'statement' => 'Alulírott(ak) kijelentem/kijelentjük, hogy gyakorlom/gyakoroljuk elállási/felmondási jogomat/jogunkat az alábbi termék(ek) adásvételére vagy az alábbi szolgáltatás nyújtására irányuló szerződés tekintetében:',
    'fields' => [
        'type' => 'Art der Erklärung',
        'subject' => 'Ware / Dienstleistung',
        'contract_date' => 'Datum des Abschlusses / Erhalts',
        'consumer_name' => 'Name des Verbrauchers',
        'consumer_address' => 'Anschrift des Verbrauchers',
        'consumer_email' => 'E-Mail-Adresse des Verbrauchers',
        'order_reference' => 'Bestellreferenz (falls vorhanden)',
        'message' => 'Anmerkung',
        'dated' => 'Datum',
    ],
    'signature_note' => 'Unterschrift (nur bei Erklärungen in Papierform). Bei Online-Übermittlung ist die Erklärung auch ohne Unterschrift gültig.',
    'submit' => 'Erklärung absenden',
    'success_title' => 'Wir haben Ihre Erklärung erhalten',
    'success_body' => 'Vielen Dank. Wir haben den Eingang per E-Mail an die von Ihnen angegebene Adresse bestätigt.',
    'confirmation_subject' => 'Bestätigung Ihrer Widerrufs- / Kündigungserklärung',
    'confirmation_intro' => 'Ezúton visszaigazoljuk, hogy az alábbi elállási/felmondási nyilatkozata hozzánk beérkezett:',
    'merchant_subject' => 'Neue Widerrufs- / Kündigungserklärung eingegangen',
    'merchant_intro' => 'Es ist eine neue Widerrufs- / Kündigungserklärung mit den folgenden Angaben eingegangen:',
];
