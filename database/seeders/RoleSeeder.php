<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public $permissionType = [
        'view',
        'create',
        'update',
        'delete',
    ];
    public $routeExcept = [
        'sanctum.csrf-cookie',
        'livewire.update',
        'livewire.upload-file',
        'livewire.preview-file',
        'ignition.healthCheck',
        'ignition.executeSolution',
        'ignition.updateConfig',
        'profile.edit',
        'profile.update',
        'profile.destroy',
        'login',
        'password.confirm',
        'password.update',
        'logout',
        'cms.merchant.profile',
        'cms.merchant.menu',
    ];
    public $routeMerchant = [
        'cms.dashboard',
        'profile.edit',
        'profile.update',
        'profile.destroy',
        'cms.merchant.profile',
        'cms.merchant.menu',
    ];

    public function run(): void
    {
        $admin = Role::findOrCreate('admin', 'web');
        $merchant = Role::findOrCreate('merchant', 'web');

        // Generate Permission
        // Get all route names
        $routes = Route::getRoutes();

        foreach ($routes as $value) {
            $route = $value->getName();
            // Except route
            if(!in_array($route, $this->routeExcept) && !is_null($route)) {
                foreach($this->permissionType as $type) {
                    $permission = $type . '.' . $route;
                    $permission = Permission::findOrCreate($permission, 'web');

                    // Give admin permission
                    $admin->givePermissionTo($permission);

                    // Give pegawai permission
                    if(in_array($route, $this->routeMerchant)) {
                        $merchant->givePermissionTo($permission);
                    }
                }
            }
        }
    }
}
