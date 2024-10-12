<?php

namespace Kirinaki\Framework\Discovery\Permissions;

use Kirinaki\Framework\Support\Facades\Wordpress;

class CurrentUserCanEditPosts extends Permission
{
    public function evaluate(): bool
    {
        return Wordpress::currentUserCan("edit_posts");
    }
}