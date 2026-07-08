<?php

declare(strict_types=1);

namespace Cegem360\Elallas\Filament;

use Cegem360\Elallas\Filament\Resources\WithdrawalDeclarationResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class ElallasPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'elallas';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            WithdrawalDeclarationResource::class,
        ]);
    }

    public function boot(Panel $panel): void {}
}
