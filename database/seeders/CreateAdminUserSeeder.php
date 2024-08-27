<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class CreateAdminUserSeeder extends Seeder
{
    public function run()
    {


        // Create the user and assign the role
        $user = User::create([
            'name' => 'gamal',
            'email' => 'gamalfayez524@gmail.com',
            'password' => Hash::make('12345678'),
            'roles_name'=> ['owner'],
            'Status' => 'مفعل'
        ]);


        $role = Role::create(['name' => 'owner']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
