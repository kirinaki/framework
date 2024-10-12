<?php

namespace Kirinaki\Framework\Discovery\Permissions;

use Kirinaki\Framework\Support\Facades\Wordpress;

class CurrentUserCanManageOptions extends Permission
{
    public function evaluate(): bool
    {
        return Wordpress::currentUserCan("manage_options");
    }
}