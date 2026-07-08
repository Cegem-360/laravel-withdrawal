<?php

declare(strict_types=1);

namespace Cegem360\Elallas\Filament\Resources\Pages;

use Cegem360\Elallas\Filament\Resources\WithdrawalDeclarationResource;
use Filament\Resources\Pages\ListRecords;

class ListWithdrawalDeclarations extends ListRecords
{
    protected static string $resource = WithdrawalDeclarationResource::class;
}
