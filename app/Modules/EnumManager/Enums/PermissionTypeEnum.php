<?php

namespace App\Modules\EnumManager\Enums;

use App\Modules\EnumManager\EnumTrait;

class PermissionTypeEnum
{
    use EnumTrait;

    const HOME_PERMISSION = 'home';

    const USER_INDEX_PERMISSION = 'index user';
    const USER_CREATE_PERMISSION = 'create user';
    const USER_STORE_PERMISSION = 'store user';
    const USER_SHOW_PERMISSION = 'show user';
    const USER_EDIT_PERMISSION = 'edit user';
    const USER_UPDATE_PERMISSION = 'update user';

    const ARTICLE_INDEX_PERMISSION = 'index article';
    const ARTICLE_CREATE_PERMISSION = 'create article';
    const ARTICLE_STORE_PERMISSION = 'store article';
    const ARTICLE_SHOW_PERMISSION = 'show article';
    const ARTICLE_EDIT_PERMISSION = 'edit article';
    const ARTICLE_UPDATE_PERMISSION = 'update article';
    const ARTICLE_APPROVE_PERMISSION = 'update approve';

    const TRANSACTION_INDEX_PERMISSION = 'index transaction';
    const TRANSACTION_CREATE_PERMISSION = 'create transaction';
    const TRANSACTION_STORE_PERMISSION = 'store transaction';
    const TRANSACTION_SHOW_PERMISSION = 'show transaction';
    const TRANSACTION_EDIT_PERMISSION = 'edit transaction';
    const TRANSACTION_UPDATE_PERMISSION = 'update transaction';

}

