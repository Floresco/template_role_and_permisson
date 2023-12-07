@props([
    'roles',
    'user' => null,
    'action' => 'create',
    'form_route' => route('user_management.users.store')
])
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{trans('messages.user.user')}}</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{$form_route}}">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="role_id">{{trans('messages.role.name')}}</label>
                        <select id="role_id" name="role_id" class="form-control w-100 select2"
                                data-placeholder="{{trans('messages.form.role_name_select')}}" data-allow-clear="true"
                                data-search-placeholder="{{trans('messages.form.role_name_search')}}">
                            <option value=""></option>
                            @foreach($roles as $role)
                                <option
                                    value="{{$role['id']}}" @selected(old('role_id') == $role['id'] || in_array($role['id'],$user?->roles()->select('id')->allRelatedIds()->toArray() ?? []))>
                                    {{$role['name']}}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-danger">
                            @error('role_id'){{ $message }}@enderror
                        </small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="name">{{trans('messages.form.name')}}</label>
                        <input type="text" class="form-control" placeholder="{{trans('messages.form.name_hint')}}"
                               name="name" id="name" autocomplete="off" value="{{old('name') ?? $user?->name }}"
                        >
                        <small class="text-danger">
                            @error('name'){{ $message }}@enderror
                        </small>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="email">{{trans('messages.form.email')}}</label>
                        <input type="email" class="form-control"
                               placeholder="{{trans('messages.form.email_hint')}}"
                               name="email" id="email" autocomplete="off"
                               value="{{old('email') ?? $user?->email }}"
                        >
                        <small class="text-danger">
                            @error('email'){{ $message }}@enderror
                        </small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="password">{{trans('messages.form.password')}}</label>
                        <div class="input-group">
                            <input type="password" class="form-control"
                                   placeholder="{{$action === 'update' ? trans('messages.form.password__update_hint') : trans('messages.form.password_hint')}}"
                                   name="password" id="password" autocomplete="off"
                                   value="{{old('password')}}"
                            >
                            <button class="btn btn-github" type="button">
                                <i class="align-middle me-2 fas fa-fw fa-eye" onclick="toggle_pwd(this)"></i>
                            </button>
                        </div>
                        <small class="text-danger">
                            @error('password'){{ $message }}@enderror
                        </small>
                    </div>
                </div>
                @if($action != 'view')
                    @if($action === 'update')
                        <input type="hidden" name="action" value="{{$action}}">
                    @endif
                    <button type="submit" class="btn btn-primary">
                        <i class="far fa-smile"></i> {{$action === 'update' ? trans('messages.update') : trans('messages.create')}}
                    </button>
                @endif

            </form>
        </div>
    </div>
</div>

