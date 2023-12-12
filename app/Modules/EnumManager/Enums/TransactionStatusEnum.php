<?php

namespace App\Modules\EnumManager\Enums;

use App\Modules\EnumManager\EnumTrait;

class TransactionStatusEnum
{
    use EnumTrait;

    const PAID = 'paid';
    const OUTSTANDING = 'outstanding';
    const OVERDUE = 'overdue';
}
