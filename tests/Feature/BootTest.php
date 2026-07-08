<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal\Tests\Feature;

use Cegem360\Withdrawal\Tests\TestCase;

class BootTest extends TestCase
{
    public function test_config_is_loaded(): void
    {
        $this->assertSame('elallasi-nyilatkozat', config('withdrawal.route.prefix'));
        $this->assertSame('Teszt Bolt Kft.', config('withdrawal.seller.name'));
    }
}
