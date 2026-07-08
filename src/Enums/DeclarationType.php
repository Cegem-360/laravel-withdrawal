<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal\Enums;

enum DeclarationType: string
{
    case Withdrawal = 'withdrawal';
    case Termination = 'termination';

    public function label(): string
    {
        return match ($this) {
            self::Withdrawal => 'Elállás',
            self::Termination => 'Felmondás',
        };
    }
}
