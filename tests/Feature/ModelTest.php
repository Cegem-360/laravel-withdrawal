<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal\Tests\Feature;

use Cegem360\Withdrawal\Enums\DeclarationType;
use Cegem360\Withdrawal\Models\WithdrawalDeclaration;
use Cegem360\Withdrawal\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_declaration_persists_and_casts(): void
    {
        $record = WithdrawalDeclaration::create([
            'type' => DeclarationType::Withdrawal->value,
            'consumer_name' => 'Teszt Elek',
            'consumer_address' => '1011 Budapest, Fő utca 1.',
            'consumer_email' => 'teszt@example.com',
            'subject' => 'Kerékpár',
            'contract_date' => '2026-07-01',
            'submitted_at' => now(),
        ]);

        $record->refresh();

        $this->assertSame(DeclarationType::Withdrawal, $record->type);
        $this->assertSame('withdrawal_declarations', $record->getTable());
        $this->assertSame('2026-07-01', $record->contract_date->format('Y-m-d'));
        $this->assertSame('Elállás', $record->type->label());
    }
}
