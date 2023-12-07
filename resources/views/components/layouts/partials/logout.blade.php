@props([
    'action' => route('logout')
])

<form method="POST" action="{{$action}}">
    @csrf
    <button type="submit" class="dropdown-item">
        <i class="align-middle me-1" data-feather="log-out"></i> {{trans('messages.logout')}}
    </button>
</form>
