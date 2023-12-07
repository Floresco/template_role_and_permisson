<?php

namespace App\Enums;

enum Models: string
{
    case USER = 'users';
    case Role = 'roles';
    case Permission = 'permissions';
}
