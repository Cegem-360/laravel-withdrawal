<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal\Mail;

use Cegem360\Withdrawal\Models\WithdrawalDeclaration;
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
        return new Envelope(subject: __('withdrawal::withdrawal.merchant_subject'));
    }

    public function content(): Content
    {
        return new Content(view: 'withdrawal::emails.merchant-notification', with: [
            'declaration' => $this->declaration,
        ]);
    }
}
