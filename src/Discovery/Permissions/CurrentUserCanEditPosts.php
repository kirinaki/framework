<?php

namespace Kirinaki\Framework\Discovery\Permissions;

class CurrentUserCanEditPosts extends Permission
{
    public function evaluate(): bool
    {
        return current_user_can("edit_posts");
    }
}