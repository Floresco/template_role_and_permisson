<x-layouts.auth-layout :title="trans('messages.forgot_password')">
    <div class="d-table-cell align-middle">

        <div class="text-center mt-4">
            <h1 class="h2">{{trans('messages.reset_password')}}</h1>
            <p class="lead">
                {{trans('messages.reset_password_email')}}
            </p>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="m-sm-3">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">{{trans('messages.form.email')}}</label>
                            <input class="form-control form-control-lg" type="email" name="email"
                                   placeholder="{{trans('messages.form.email_hint')}}"/>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button class='btn btn-lg btn-primary'>{{trans('messages.reset_password')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="text-center mb-3">
            <a href='{{route('login')}}'
               class="text-decoration-underline text-uppercase">{{trans('messages.login')}}</a>
        </div>
    </div>
</x-layouts.auth-layout>
