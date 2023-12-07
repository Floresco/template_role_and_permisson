<?php

namespace App\Utils;

use App\Enums\Models;
use App\Enums\Permissions;

class Utils
{
    public static function namePerm(Permissions $permissions, Models $models): string
    {
        return $permissions->value . ' ' . $models->value;
    }

    public static function genList(array $items): string
    {
        if (sizeof($items) === 1) {
            return $items[0];
        }
        $list = '<ul>';
        foreach ($items as $item) {
            $list .= '<li>' . $item . '</li>';
        }
        $list .= '</ul>';
        return $list;
    }
}
