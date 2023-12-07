@php
    $menu_user_management = [
    [
        'text' => trans('messages.users'),
        'href' => route('user_management.users.index'),
        'active' => 'user_management.users.*',
        'has_badge' => true,
        'badge_text' => \App\Models\User::query()->withoutRole('Super Admin')->count(),
        'badge_color' => 'primary',
        'gateway' => [\App\Utils\Utils::namePerm(\App\Enums\Permissions::ViewAny, \App\Enums\Models::USER)]
    ],
    [
        'text' => trans('messages.roles'),
        'href' => route('user_management.roles.index'),
        'active' => 'user_management.roles.*',
        'has_badge' => true,
        'badge_text' => \App\Models\Role::query()->whereNotIn('name', ['Super Admin'])->count(),
        'badge_color' => 'primary',
        'gateway' => [\App\Utils\Utils::namePerm(\App\Enums\Permissions::ViewAny, \App\Enums\Models::Role)]

    ]
];
@endphp
<ul class="sidebar-nav">

    <x-layouts.partials.sidebar-header text="Pages"/>
    <x-layouts.partials.sidebar-item
        :text="trans('messages.Dashboard')"
        :href="route('dashboard')"
        icon="sliders"
        active="dashboard"
    />
    <x-layouts.partials.sidebar-dropdown
        text="{{trans('messages.user_management')}}"
        target="user_management"
        icon="users"
        show="user_management"
        :items="$menu_user_management"
        :gateway="array_map(fn($item) =>  $item['gateway'], $menu_user_management)"
    />
    {{--    TODO A ameliorer    --}}

</ul>

