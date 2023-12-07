<?php

namespace Database\Seeders;

use App\Enums\Models;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Enums\Permissions as PermissionConstants;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $prefixes = [
            PermissionConstants::ViewAny->value,
            PermissionConstants::View->value,
            PermissionConstants::Create->value,
            PermissionConstants::Update->value,
            PermissionConstants::Delete->value,
            PermissionConstants::Restore->value,
            PermissionConstants::Replicate->value,
            PermissionConstants::Reorder->value
        ];


        foreach (Models::cases() as $model) {
            foreach ($prefixes as $prefix) {
                $name = $prefix . ' ' . $model->value;
                $check_permission = Permission::query()->where('name', '=', $name)->get()->count();
                if ($check_permission === 0) {
                    Permission::create([
                        'name' => $name,
                        'description' =>  trans("messages.$prefix") . ' ' . strtolower( trans("messages.$model->value")),
                        'guard_name' => 'web',
                        'created_at' => Carbon::now()
                    ]);
                }
            }
        }
    }
}
