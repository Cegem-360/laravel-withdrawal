<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal\Tests\Feature;

use Cegem360\Withdrawal\Models\WithdrawalDeclaration;
use Cegem360\Withdrawal\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    public function test_form_page_renders_with_seller(): void
    {
        $this->get('/elallasi-nyilatkozat')
            ->assertOk()
            ->assertSee('Teszt Bolt Kft.')
            ->assertSee('Elállási/Felmondási nyilatkozatminta');
    }

    public function test_valid_submission_is_stored(): void
    {
        $response = $this->post('/elallasi-nyilatkozat', [
            'type' => 'withdrawal',
            'consumer_name' => 'Teszt Elek',
            'consumer_address' => '1011 Budapest, Fő utca 1.',
            'consumer_email' => 'teszt@example.com',
            'subject' => 'Kerékpár',
            'contract_date' => '2026-07-01',
        ]);

        $response->assertRedirect(route('withdrawal.success'));

        $this->assertDatabaseCount('withdrawal_declarations', 1);
        $record = WithdrawalDeclaration::first();
        $this->assertSame('Teszt Elek', $record->consumer_name);
        $this->assertNotNull($record->submitted_at);
    }

    public function test_validation_rejects_missing_fields(): void
    {
        $this->post('/elallasi-nyilatkozat', [
            'consumer_email' => 'not-an-email',
        ])->assertSessionHasErrors(['type', 'consumer_name', 'subject', 'contract_date', 'consumer_email']);

        $this->assertDatabaseCount('withdrawal_declarations', 0);
    }

    public function test_honeypot_blocks_submission(): void
    {
        $this->post('/elallasi-nyilatkozat', [
            'type' => 'withdrawal',
            'consumer_name' => 'Bot',
            'consumer_address' => 'X',
            'consumer_email' => 'bot@example.com',
            'subject' => 'X',
            'contract_date' => '2026-07-01',
            'website' => 'http://spam.example',
        ])->assertSessionHasErrors('website');

        $this->assertDatabaseCount('withdrawal_declarations', 0);
    }
}
