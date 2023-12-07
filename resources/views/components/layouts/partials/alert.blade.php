@if($message)
    <div class="alert alert-{{$type}} {{$dismiss ? 'alert-dismissible' : ''}}" role="alert">
        @if($dismiss)
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
        <div class="alert-icon">
            <i class="far fa-fw fa-bell"></i>
        </div>
        <div class="alert-message">
            <strong>{{$title}}</strong> {{$message}}
        </div>
    </div>
@endif

