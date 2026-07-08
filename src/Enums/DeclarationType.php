<?php

declare(strict_types=1);

namespace Cegem360\Elallas\Enums;

enum DeclarationType: string
{
    case Elallas = 'elallas';
    case Felmondas = 'felmondas';

    public function label(): string
    {
        return match ($this) {
            self::Elallas => 'Elállás',
            self::Felmondas => 'Felmondás',
        };
    }
}
