<?php
$choosen_perms = session('choosen_perms') ?? [];
$action = session('action') ?? 'create';

$btn_route = route('user_management.roles.index');
$btn_text = trans('messages.back');
$color = "secondary";
$icon = "fas fa-arrow-left";

if ($action === 'update') {
    $form_route = route('user_management.roles.update', ['role' => $role->id]);

} elseif ($action === 'view') {
    $form_route = '#';
    $btn_route = route('user_management.roles.edit', ['role' => $role->id]);
    $color = 'warning';
    $icon = 'far fa-fw fa-edit';
    $btn_text = trans('messages.update');
} else {
    $form_route = route('user_management.roles.store');
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
    <x-user-management.roles.form
        :permissions="$permissions"
        :models="\App\Enums\Models::cases()"
        :choosen_perms="$choosen_perms"
        :action="$action"
        :form_route="$form_route"
        :role="$action != 'create' ? $role : null"
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


