@props(['roles'])
<?php

use App\Enums\Models;
use App\Enums\Permissions;
use App\Utils\Utils;

$header = "<th>" . trans('messages.role.name') . "</th>"
    . "<th>" . trans('messages.role.description') . "</th>"
    . "<th>" . trans('messages.role.guard_name') . "</th>"
    . "<th class=\"table-action text-center\" style=\"width: 10px;\"></th>"
    . "<th class=\"table-action text-center\" style=\"width: 10px;\"></th>"
    . "<th class=\"table-action text-center\" style=\"width: 10px;\"></th>"
?>

<table class="table table-striped table-bordered table-hover table-responsive-lg is-search-table" style="width:100%">
    <thead>
    <tr>
        {!! $header !!}
    </tr>
    </thead>
    <tbody>
    <?php /** @var \App\Models\Role[] $roles */ ?>
    @forelse($roles as $role)
        <tr>
            <td class="visible">{{$role->name}}</td>
            <td>{{$role->description}}</td>
            <td>{{$role->guard_name}}</td>
            <td class="table-action text-center" style="width: 10px;">
                @can(Utils::namePerm(Permissions::View, Models::Role))
                    <a href="{{route('user_management.roles.show', ['role' => $role->id])}}"><i
                            class="align-middle text-primary" data-feather="eye"></i></a>
                @endcan
            </td>
            <td class="table-action text-center" style="width: 10px;">
                @can(Utils::namePerm(Permissions::Update, Models::Role))
                    <a href="{{route('user_management.roles.edit', ['role' => $role->id])}}"><i
                            class="align-middle text-primary" data-feather="edit-2"></i></a>
                @endcan
            </td>
            <td class="table-action text-center" style="width: 10px;">
                @can(Utils::namePerm(Permissions::Delete, Models::Role))
                        <?php
                        $format_info = new stdClass();
                        $format_info->name = strtoupper($role->name);
                        $format_info->guard_name = strtoupper($role->guard_name);
                        $format_info->data = [];
                        $info = str_replace("'", "&#697", str_replace('"', '###', json_encode($format_info)));
                        $url_submit = route('user_management.roles.destroy', ['role' => $role->id])
                        ?>
                    <a href="javascript:void(0)"><i
                            class="align-middle text-danger" data-feather="trash"
                            onclick="confirm_delete('{!! $url_submit !!}', '{!! $info !!}')"></i></a>
                @endcan

            </td>
        </tr>
    @empty
        <x-layouts.partials.alert
            :message="trans('messages.empty_array')"
            :title="trans('messages.empty')"
            type="warning"
        />
    @endforelse

    </tbody>
    <tfoot>
    <tr>
        {!! $header !!}
    </tr>
    </tfoot>
</table>
