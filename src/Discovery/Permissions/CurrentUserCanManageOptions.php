<?php

namespace Kirinaki\Framework\Discovery\Permissions;

class CurrentUserCanManageOptions extends Permission
{
    public function evaluate(): bool
    {
        return current_user_can("manage_options");
    }
}