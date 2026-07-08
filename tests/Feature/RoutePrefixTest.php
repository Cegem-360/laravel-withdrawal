<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal\Tests\Feature;

use Cegem360\Withdrawal\Tests\TestCase;

class RoutePrefixTest extends TestCase
{
    protected function defineEnvironment($app): void
    {
        parent::defineEnvironment($app);
        // Simulate a misconfigured / empty prefix.
        $app['config']->set('withdrawal.route.prefix', '');
    }

    public function test_empty_prefix_does_not_hijack_host_root(): void
    {
        // The host app root must NOT be captured by the package.
        $this->get('/')->assertNotFound();

        // The form falls back to the default prefix instead.
        $this->get('/elallasi-nyilatkozat')->assertOk();
    }
}
