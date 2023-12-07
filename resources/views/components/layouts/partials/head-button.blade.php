
@if($gateway && Auth::user()->canAny($gateway) || !$gateway)
    <a
        href="{{$url ?? '#'}}"
        class="btn btn-{{$color ?? 'primary'}} float-end mt-n1"
        @if($modal && $idm)
            data-bs-toggle="modal"
        data-bs-target="#{{$idm}}"
        @endif
    >
        <i class="{{$icon ?? 'fas fa-plus'}}"></i> @if($modal && $idm)
            {{$text}}
        @else
            {{$text}}
        @endif
    </a>
@endif
