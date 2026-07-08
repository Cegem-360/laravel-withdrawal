<?php

declare(strict_types=1);

namespace Cegem360\Elallas\Tests\Feature;

use Cegem360\Elallas\Events\WithdrawalDeclarationSubmitted;
use Cegem360\Elallas\Mail\DeclarationReceivedConfirmation;
use Cegem360\Elallas\Mail\DeclarationSubmittedNotification;
use Cegem360\Elallas\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class MailTest extends TestCase
{
    use RefreshDatabase;

    private function payload(): array
    {
        return [
            'type' => 'elallas',
            'consumer_name' => 'Teszt Elek',
            'consumer_address' => '1011 Budapest, Fő utca 1.',
            'consumer_email' => 'vevo@example.com',
            'subject' => 'Kerékpár',
            'contract_date' => '2026-07-01',
        ];
    }

    public function test_confirmation_and_notification_are_sent(): void
    {
        Mail::fake();

        $this->post('/elallasi-nyilatkozat', $this->payload())->assertRedirect();

        Mail::assertSent(DeclarationReceivedConfirmation::class, function ($mail): bool {
            return $mail->hasTo('vevo@example.com');
        });
        Mail::assertSent(DeclarationSubmittedNotification::class, function ($mail): bool {
            return $mail->hasTo('bolt@example.com');
        });
    }

    public function test_event_is_dispatched(): void
    {
        Event::fake();

        $this->post('/elallasi-nyilatkozat', $this->payload())->assertRedirect();

        Event::assertDispatched(WithdrawalDeclarationSubmitted::class);
    }

    public function test_confirmation_email_renders_statement(): void
    {
        Mail::fake();

        $this->post('/elallasi-nyilatkozat', $this->payload());

        Mail::assertSent(DeclarationReceivedConfirmation::class, function (DeclarationReceivedConfirmation $mail): bool {
            $rendered = $mail->render();

            return str_contains($rendered, 'Teszt Bolt Kft.')
                && str_contains($rendered, 'Kerékpár')
                && str_contains($rendered, 'elállási/felmondási jogomat');
        });
    }

    public function test_merchant_notification_falls_back_to_seller_email(): void
    {
        Mail::fake();
        config(['elallas.notify_email' => '']);
        config(['elallas.seller.email' => 'fallback@example.com']);

        $this->post('/elallasi-nyilatkozat', $this->payload());

        Mail::assertSent(DeclarationSubmittedNotification::class, function (DeclarationSubmittedNotification $mail): bool {
            return $mail->hasTo('fallback@example.com');
        });
    }
}
