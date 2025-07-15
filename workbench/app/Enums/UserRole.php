<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case MODERATOR = 'moderator';
    case USER = 'user';
    case GUEST = 'guest';
    case EDITOR = 'editor';
    case VIEWER = 'viewer';
}
