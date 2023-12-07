<?php

namespace App\Enums;

enum Permissions: string
{
    case ViewAny = 'view-any';
    case View = 'view';
    case Create = 'create';
    case Update = 'update';
    case Delete = 'delete';
    case Restore = 'restore';
    case Replicate = 'replicate';
    case Reorder = 'reorder';
}
