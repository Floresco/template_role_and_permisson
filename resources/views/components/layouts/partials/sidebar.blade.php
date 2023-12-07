<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class='sidebar-brand' href='{{route('dashboard')}}'>
            <span class="sidebar-brand-text align-middle">
                {{config('app.name')}} <sup><small class="badge bg-warning-light text-uppercase">🩺</small></sup>
            </span>
        </a>

        <x-layouts.partials.sidebar-menu/>


    </div>
</nav>
