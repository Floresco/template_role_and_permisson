@props([
    'text',
    'icon' => null,
    'is_sub' => false,
    'badge_text' => null,
    'has_badge' => false,
    'badge_color' => null,
    'href' => null,
    'active' => null,
    'gateway' => null
])
@if($gateway && Auth::user()->canAny($gateway) || !$gateway)
        <li class="sidebar-item {{request()->routeIs($active) ? 'active' : ''}}">
            <a class='sidebar-link' href='{{$href ?? '#'}}'>
                @if($is_sub)
                    {{$text}}
                @else
                    <i class="align-middle" data-feather="{{$icon ?? 'list'}}"></i> <span
                        class="align-middle">{{$text}}</span>

                @endif
                @if($has_badge && $badge_color && $badge_text)
                    <span class="sidebar-badge badge bg-{{$badge_color}}">{{$badge_text}}</span>
                @endif

            </a>
        </li>
@endif

