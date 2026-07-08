<?php

declare(strict_types=1);

namespace Cegem360\Elallas\Events;

use Cegem360\Elallas\Models\WithdrawalDeclaration;
use Illuminate\Foundation\Events\Dispatchable;

class WithdrawalDeclarationSubmitted
{
    use Dispatchable;

    public function __construct(public WithdrawalDeclaration $declaration) {}
}
