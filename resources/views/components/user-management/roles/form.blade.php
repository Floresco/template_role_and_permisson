@props([
    'permissions',
    'models',
    'role' => null,
    'choosen_perms' => [],
    'action' => 'create',
    'form_route' => route('user_management.roles.store')
])

<?php

use App\Models\Role;

/** @var Role $role */
if (empty($choosen_perms)) {
    $selected_perms = array_map(function ($perm) {
        return $perm['name'];
    },
        $role?->permissions()->select(['name'])->get()->toArray() ?? []
    );
} else {
    $selected_perms = $choosen_perms;
}
if ($action === 'update') {


} elseif ($action === 'view') {

} else {

}


?>

<form method="post" action="{{$form_route}}">
    @csrf
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <label for="name">
                    <h5 class="card-title mb-0" aria-label="">{{trans('messages.roles')}}</h5>
                </label>
            </div>
            <div class="card-body row justify-content-between">
                <div class="col-lg-4">
                    <input type="text" class="form-control" placeholder="{{trans('messages.form.role_name_hint')}}"
                           name="name" id="name" autocomplete="off" value="{{old('name') ?? $role?->name }}" required>
                    <small class="text-danger">
                        @error('name'){{ $message }}@enderror
                    </small>
                </div>
                <div class="col-lg-6">
                    <input type="text" class="form-control"
                           placeholder="{{trans('messages.form.role_description_hint')}}"
                           name="description" id="description" autocomplete="off"
                           value="{{old('description') ?? $role?->description }}"
                           required>
                    <small class="text-danger">
                        @error('description'){{ $message }}@enderror
                    </small>
                </div>
                <div class="col-lg-2 d-flex justify-content-end">
                    @if($action != 'view')
                        <button type="submit" class="btn btn-primary">
                            <i class="far fa-smile"></i> {{$action === 'update' ? trans('messages.update') : trans('messages.create')}}
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        @error('permissions')
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-icon">
                <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
                <strong>{{$message}}</strong>
            </div>
        </div>
        @enderror


        @foreach(\App\Enums\Models::cases() as $model)
                <?php
                $model_perms = array_filter($permissions, function ($permission) use ($model) {
                    return str_contains($permission['name'], $model->value);
                });

                ?>
            <div class="col-lg-6">
                <div class="card p-1">
                    <div class="card-header d-flex">
                        <h5 class="card-title mb-0 col">{{trans("messages.$model->value")}}</h5>
                        <div class="col-6 d-flex justify-content-between">
                            <a href="javascript:void(0)"  data-model="{{$model->value}}" class="btn btn-github card-title mb-0 all_checker">{{trans("messages.select_all")}}</a>
                            <a href="javascript:void(0)"  data-model="{{$model->value}}" class="btn btn-github card-title mb-0 all_unchecker">{{trans("messages.unselect_all")}}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($model_perms as $model_perm)
                                <div class="col-lg-6">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                               value="{{$model_perm['name']}}"
                                               name="permissions[]" {{in_array($model_perm['name'],$selected_perms) ? 'checked="checked"' : ''}}>
                                        <span class="form-check-label">
												{{$model_perm['description']}}
											</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</form>

