<?php

declare(strict_types=1);

namespace Cegem360\Elallas\Models;

use Cegem360\Elallas\Enums\DeclarationType;
use Illuminate\Database\Eloquent\Model;

class WithdrawalDeclaration extends Model
{
    protected $guarded = [];

    public function getTable(): string
    {
        return config('elallas.table', 'elallas_declarations');
    }

    protected function casts(): array
    {
        return [
            'type' => DeclarationType::class,
            'contract_date' => 'date',
            'submitted_at' => 'datetime',
        ];
    }
}
