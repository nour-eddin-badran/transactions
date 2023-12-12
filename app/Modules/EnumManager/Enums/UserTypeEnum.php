<?php

namespace App\Modules\EnumManager\Enums;

use App\Modules\EnumManager\EnumTrait;

class UserTypeEnum
{
    use EnumTrait;

    const PAYER = 'payer';
    const MANAGERIAL = 'managerial';
}
