<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    // use HasRoles;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //predefined Roles
        $role1 = Role::create( ['name' => 'admin'] );
        $role2 = Role::create( ['name' => 'read_only'] );
        $role3 = Role::create( ['name' => 'map_only'] );
        $role4 = Role::create( ['name' => 'export_only'] );

        //permission list for each roles
        $permissionlist2 = ['operator-list', 'system-list', 'systemsite-list', 'microwavenode-list', 'microwavelink-list', 'vsat-list', 'opticalfibernode-list', 'opticalfiberlink-list', 'highwayopticalfibernode-list', 'highwayopticalfiberlink-list'];
        $permissionlist4 = ['operator-list', 'system-list', 'systemsite-list', 'microwavenode-list', 'microwavelink-list', 'vsat-list', 'opticalfibernode-list', 'opticalfiberlink-list', 'highwayopticalfibernode-list', 'highwayopticalfiberlink-list', 'export-data'];

        //pluck permission id with the required permissions
        $permissions1 = Permission::pluck( 'id', 'id' )->all();
        $permissions2 = Permission::whereIN('name', $permissionlist2)->pluck( 'id' )->all();
        $permissions3 = Permission::where('name', '=', 'map-view')->pluck( 'id' )->all();
        $permissions4 = Permission::whereIN('name', $permissionlist4)->pluck( 'id' )->all();

        //define roles for each permission
        $role1->syncPermissions( $permissions1 );
        $role2->syncPermissions( $permissions2 );
        $role3->syncPermissions( $permissions3 );
        $role4->syncPermissions( $permissions4 );

    }
}
