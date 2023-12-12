<?php

use App\Modules\EnumManager\Enums\{PermissionTypeEnum, RoleTypeEnum};

return [

    RoleTypeEnum::ADMIN => [
        PermissionTypeEnum::USER_INDEX_PERMISSION,
        PermissionTypeEnum::USER_CREATE_PERMISSION,
        PermissionTypeEnum::USER_STORE_PERMISSION,
        PermissionTypeEnum::USER_SHOW_PERMISSION,
        PermissionTypeEnum::USER_EDIT_PERMISSION,
        PermissionTypeEnum::USER_UPDATE_PERMISSION,

        PermissionTypeEnum::TRANSACTION_INDEX_PERMISSION,
        PermissionTypeEnum::TRANSACTION_CREATE_PERMISSION,
        PermissionTypeEnum::TRANSACTION_STORE_PERMISSION,
        PermissionTypeEnum::TRANSACTION_SHOW_PERMISSION,
        PermissionTypeEnum::TRANSACTION_EDIT_PERMISSION,
        PermissionTypeEnum::TRANSACTION_UPDATE_PERMISSION,
    ],
];
