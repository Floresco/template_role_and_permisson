@props([
    'text',
    'target',
    'icon' => null,
    'show' => null,
    'items' => [],
    'gateway' => null
])
@if($gateway && Auth::user()->canAny($gateway) || !$gateway)
    @php
        $show_collapsed = request()->routeIs(["$show.*"]);
    @endphp

    <li class="sidebar-item {{$show_collapsed ? 'active' :  ''}}">
        <a data-bs-target="#{{$target}}" data-bs-toggle="collapse"
           class="sidebar-link {{$show_collapsed ? '' :  'collapsed'}}">
            <i class="align-middle" data-feather="{{$icon ?? 'list'}}"></i> <span class="align-middle">{{$text}}</span>
        </a>
        <ul id="{{$target}}"
            class="sidebar-dropdown list-unstyled collapse {{$show_collapsed ? 'show' :  ''}}"
            data-bs-parent="#sidebar">
            @foreach($items as $item)
                <x-layouts.partials.sidebar-item
                    :text="$item['text']"
                    :href="$item['href']"
                    :is_sub="true"
                    :has_badge="$item['has_badge'] ?? false"
                    :badge_text="$item['badge_text'] ?? null"
                    :badge_color="$item['badge_color'] ?? null"
                    :active="$item['active'] ?? null"
                    :gateway="$item['gateway'] ?? []"
                />
            @endforeach
        </ul>
    </li>

@endif

