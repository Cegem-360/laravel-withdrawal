<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal\Tests\Feature;

use Cegem360\Withdrawal\Mail\DeclarationReceivedConfirmation;
use Cegem360\Withdrawal\Mail\DeclarationSubmittedNotification;
use Cegem360\Withdrawal\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

class RobustnessTest extends TestCase
{
    use RefreshDatabase;

    public function test_works_without_seller_or_notify_config(): void
    {
        Mail::fake();
        config(['withdrawal.seller' => ['name' => '', 'address' => '', 'email' => '']]);
        config(['withdrawal.notify_email' => '']);

        $this->get('/elallasi-nyilatkozat')->assertOk();

        $this->post('/elallasi-nyilatkozat', [
            'type' => 'withdrawal',
            'consumer_name' => 'Teszt Elek',
            'consumer_address' => '1011 Budapest, Fő utca 1.',
            'consumer_email' => 'vevo@example.com',
            'subject' => 'Kerékpár',
            'contract_date' => '2026-07-01',
        ])->assertRedirect(route('withdrawal.success'));

        $this->assertDatabaseCount('withdrawal_declarations', 1);
        Mail::assertSent(DeclarationReceivedConfirmation::class);
        Mail::assertNotSent(DeclarationSubmittedNotification::class);
    }
}
