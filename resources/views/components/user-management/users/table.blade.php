@props(['users'])
<?php

use App\Enums\Models;
use App\Enums\Permissions;
use App\Utils\Utils;

$header = "<th>" . trans('messages.user.name') . "</th>"
    . "<th>" . trans('messages.user.email') . "</th>"
    . "<th>" . trans('messages.roles') . "</th>"
    . "<th class=\"table-action text-center\" style=\"width: 10px;\"></th>"
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
    <?php /** @var \App\Models\User[] $users */ ?>
    @forelse($users as $user)
        <tr>
            <td class="visible">{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{!! \App\Utils\Utils::genList($user->getRoleNames()->toArray()) !!}</td>
            <td>{!! $user->email_verified_at != null
            ? '<i class="align-middle text-success" data-feather="user-check"></i>'
            : '<i class="align-middle text-danger" data-feather="user-x"></i>'
             !!}</td>
            <td class="table-action text-center" style="width: 10px;">
                @can(Utils::namePerm(Permissions::View, Models::USER))
                    <a href="{{route('user_management.users.show', ['user' => $user->id])}}"><i
                            class="align-middle text-primary" data-feather="eye"></i></a>
                @endcan
            </td>
            <td class="table-action text-center" style="width: 10px;">
                @can(Utils::namePerm(Permissions::Update, Models::USER))

                    <a href="{{route('user_management.users.edit', ['user' => $user->id])}}"><i
                            class="align-middle text-primary" data-feather="edit-2"></i></a>
                @endcan

            </td>
            <td class="table-action text-center" style="width: 10px;">
                @can(Utils::namePerm(Permissions::Delete, Models::USER))
                        <?php
                        $format_info = new stdClass();
                        $format_info->name = strtoupper($user->name);
                        $format_info->guard_name = strtoupper($user->email);
                        $format_info->data = [];
                        $info = str_replace("'", "&#697", str_replace('"', '###', json_encode($format_info)));
                        $url_submit = route('user_management.users.destroy', ['user' => $user->id])
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
