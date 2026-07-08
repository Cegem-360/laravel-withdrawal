<?php

declare(strict_types=1);

namespace Cegem360\Elallas\Tests\Feature;

use Cegem360\Elallas\Tests\TestCase;

class BootTest extends TestCase
{
    public function test_config_is_loaded(): void
    {
        $this->assertSame('elallasi-nyilatkozat', config('elallas.route.prefix'));
        $this->assertSame('Teszt Bolt Kft.', config('elallas.seller.name'));
    }
}
