<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal\Models;

use Cegem360\Withdrawal\Enums\DeclarationType;
use Illuminate\Database\Eloquent\Model;

class WithdrawalDeclaration extends Model
{
    protected $guarded = [];

    public function getTable(): string
    {
        return config('withdrawal.table', 'withdrawal_declarations');
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
