<?php

declare(strict_types=1);

namespace Cegem360\Elallas\Mail;

use Cegem360\Elallas\Models\WithdrawalDeclaration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeclarationSubmittedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public WithdrawalDeclaration $declaration) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: __('elallas::elallas.merchant_subject'));
    }

    public function content(): Content
    {
        return new Content(view: 'elallas::emails.merchant-notification', with: [
            'declaration' => $this->declaration,
        ]);
    }
}
