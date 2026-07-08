<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal\Tests\Filament;

use Cegem360\Withdrawal\Filament\Resources\WithdrawalDeclarationResource;
use Cegem360\Withdrawal\Filament\WithdrawalPlugin;
use Cegem360\Withdrawal\Models\WithdrawalDeclaration;
use Cegem360\Withdrawal\Tests\TestCase;

class ResourceTest extends TestCase
{
    public function test_plugin_and_resource_wiring(): void
    {
        $this->assertSame('withdrawal', WithdrawalPlugin::make()->getId());
        $this->assertSame(WithdrawalDeclaration::class, WithdrawalDeclarationResource::getModel());
        $this->assertFalse(WithdrawalDeclarationResource::canCreate());
        $this->assertTrue(method_exists(WithdrawalDeclarationResource::class, 'infolist'));
    }
}
