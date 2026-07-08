<?php

declare(strict_types=1);

return [
    'page_title' => 'Declaración de desistimiento / rescisión',
    'intro' => 'De conformidad con el Decreto Gubernamental húngaro 45/2014. (II. 26.), complete y envíe la declaración siguiente para desistir del contrato o rescindirlo. Confirmaremos la recepción sin demora en un soporte duradero (por correo electrónico). El consumidor tiene derecho a desistir sin justificación dentro de los 14 días siguientes a la recepción del producto.',
    // Texto estatutario del modelo (Decreto 45/2014) — se mantiene en húngaro por ser la redacción jurídicamente vinculante.
    'template_heading' => 'Elállási/Felmondási nyilatkozatminta',
    'template_note' => '(csak a szerződéstől való elállási/felmondási szándék esetén töltse ki és juttassa vissza)',
    'addressee' => 'Destinatario',
    'statement' => 'Alulírott(ak) kijelentem/kijelentjük, hogy gyakorlom/gyakoroljuk elállási/felmondási jogomat/jogunkat az alábbi termék(ek) adásvételére vagy az alábbi szolgáltatás nyújtására irányuló szerződés tekintetében:',
    'fields' => [
        'type' => 'Tipo de declaración',
        'subject' => 'Producto / servicio',
        'contract_date' => 'Fecha de celebración / recepción',
        'consumer_name' => 'Nombre del consumidor',
        'consumer_address' => 'Dirección del consumidor',
        'consumer_email' => 'Correo electrónico del consumidor',
        'order_reference' => 'Referencia del pedido (si la hubiera)',
        'message' => 'Nota',
        'dated' => 'Fecha',
    ],
    'signature_note' => 'Firma (solo para declaraciones en papel). En los envíos en línea la declaración es válida sin firma.',
    'submit' => 'Enviar declaración',
    'success_title' => 'Hemos recibido su declaración',
    'success_body' => 'Gracias. Hemos confirmado la recepción por correo electrónico a la dirección que nos ha facilitado.',
    'confirmation_subject' => 'Confirmación de su declaración de desistimiento / rescisión',
    'confirmation_intro' => 'Ezúton visszaigazoljuk, hogy az alábbi elállási/felmondási nyilatkozata hozzánk beérkezett:',
    'merchant_subject' => 'Nueva declaración de desistimiento / rescisión recibida',
    'merchant_intro' => 'Se ha recibido una nueva declaración de desistimiento / rescisión con los siguientes datos:',
];
