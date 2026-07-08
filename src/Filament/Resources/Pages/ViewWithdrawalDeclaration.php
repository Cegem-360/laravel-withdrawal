<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal\Filament\Resources\Pages;

use Cegem360\Withdrawal\Filament\Resources\WithdrawalDeclarationResource;
use Filament\Resources\Pages\ViewRecord;

class ViewWithdrawalDeclaration extends ViewRecord
{
    protected static string $resource = WithdrawalDeclarationResource::class;
}
