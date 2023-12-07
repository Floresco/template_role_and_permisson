<x-layouts.auth-layout :title="trans('messages.login')">
    <div class="d-table-cell align-middle">

        <div class="text-center mt-4">
            <h1 class="h2">{{trans('messages.welcome')}}</h1>
            <p class="lead">
                {{trans('messages.login_hint')}}
            </p>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="m-sm-3">
                    <div class="row">
                        <div class="col">
                            <hr>
                        </div>
                        <div
                            class="col-auto text-uppercase d-flex align-items-center">{{trans(config('app.name'))}}</div>
                        <div class="col">
                            <hr>
                        </div>
                    </div>
                    <div>
                        <x-layouts.partials.alert />
                    </div>
                    <form method="post" action="{{route('do-login')}}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{trans('messages.form.email')}}</label>
                            <input class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   type="email" name="email" value="{{ old('email') }}"
                                   placeholder="{{trans('messages.form.email_hint')}}"/>
                            <small class="text-danger">
                                @error('email'){{ $message }}@enderror
                            </small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{trans('messages.form.password')}}</label>
                            <input class="form-control form-control-lg @error('password') is-invalid @enderror"
                                   type="password" name="password" value="{{ old('password') }}"
                                   placeholder="{{trans('messages.form.password_hint')}}"/>
                            <small class="text-danger">
                                @error('password'){{ $message }}@enderror
                            </small>
                            <div>
                                <small>
                                    <a href='{{route('forget-password')}}'>{{trans('messages.forgot_password')}}?</a>
                                </small>
                            </div>

                        </div>

                        <div>
                            <div class="form-check align-items-center">
                                <input id="remember_token" type="checkbox" class="form-check-input"
                                       value="yes" name="remember_token" checked>
                                <label class="form-check-label text-small"
                                       for="remember_token">{{trans('messages.remember_me')}}</label>

                            </div>

                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button class='btn btn-lg btn-primary'>{{trans('messages.login')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth-layout>
