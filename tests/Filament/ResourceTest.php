<?php

declare(strict_types=1);

namespace Cegem360\Elallas\Tests\Filament;

use Cegem360\Elallas\Filament\ElallasPlugin;
use Cegem360\Elallas\Filament\Resources\WithdrawalDeclarationResource;
use Cegem360\Elallas\Models\WithdrawalDeclaration;
use Cegem360\Elallas\Tests\TestCase;

class ResourceTest extends TestCase
{
    public function test_plugin_and_resource_wiring(): void
    {
        $this->assertSame('elallas', ElallasPlugin::make()->getId());
        $this->assertSame(WithdrawalDeclaration::class, WithdrawalDeclarationResource::getModel());
        $this->assertFalse(WithdrawalDeclarationResource::canCreate());
        $this->assertTrue(method_exists(WithdrawalDeclarationResource::class, 'infolist'));
    }
}
