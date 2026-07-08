<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal\Tests;

use Cegem360\Withdrawal\WithdrawalServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [WithdrawalServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('withdrawal.seller', [
            'name' => 'Teszt Bolt Kft.',
            'address' => '1011 Budapest, Fő utca 1.',
            'email' => 'bolt@example.com',
        ]);
        $app['config']->set('withdrawal.notify_email', 'bolt@example.com');
    }
}
