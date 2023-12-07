<?php
$action = session('action') ?? 'create';

$btn_route = route('user_management.users.index');
$btn_text = trans('messages.back');
$color = "secondary";
$icon = "fas fa-arrow-left";

if ($action === 'update') {
    $form_route = route('user_management.users.update', ['user' => $user->id]);

} elseif ($action === 'view') {
    $form_route = '#';
    $btn_route = route('user_management.users.edit', ['user' => $user->id]);
    $color = 'warning';
    $icon = 'far fa-fw fa-edit';
    $btn_text = trans('messages.update');
} else {
    $form_route = route('user_management.users.store');
}
?>
<x-layouts.layout :title="$title">
    <x-slot:head_btn>
        <x-layouts.partials.head-button
            :text="$btn_text"
            :url="$btn_route"
            :color="$color"
            :icon="$icon"
        />
    </x-slot:head_btn>
    <div>
        <x-layouts.partials.alert/>
    </div>
    <x-user-management.users.form
        :roles="$roles"
        :action="$action"
        :form_route="$form_route"
        :user="$action != 'create' ? $user : null"
    />
    <x-slot:js>
        <script>
            $('.all_checker').click(function () {
                $("input[value$=' " + $(this).data('model') + "']").each(function () {
                    $(this).prop('checked', true)
                });
            })

            $('.all_unchecker').click(function () {
                $("input[value$=' " + $(this).data('model') + "']").each(function () {
                    $(this).prop('checked', false)
                });
            })
        </script>
    </x-slot:js>
</x-layouts.layout>


