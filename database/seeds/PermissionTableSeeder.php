<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder {
    /**
    * Run the database seeds.
    *
    * @return void
    */

    public function run() {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            // 'band-list',
            // 'band-create',
            // 'band-edit',
            // 'band-delete',
            // 'infrastructure-list',
            // 'infrastructure-create',
            // 'infrastructure-edit',
            // 'infrastructure-delete',
            'operator-list',
            // 'operator-create',
            // 'operator-edit',
            // 'operator-delete',
            'system-list',
            // 'system-create',
            // 'system-edit',
            // 'system-delete',
            'systemsite-list',
            // 'systemsite-create',
            // 'systemsite-edit',
            // 'systemsite-delete',
            'microwavenode-list',
            // 'microwavenode-create',
            // 'microwavenode-edit',
            // 'microwavenode-delete',
            'microwavelink-list',
            // 'microwavelink-create',
            // 'microwavelink-edit',
            // 'microwavelink-delete',
            'vsat-list',
            // 'vsat-create',
            // 'vsat-edit',
            // 'vsat-delete',
            // 'pstn-list',
            // 'pstn-create',
            // 'pstn-edit',
            // 'pstn-delete',
            // 'wireless-list',
            // 'wireless-create',
            // 'wireless-edit',
            // 'wireless-delete',
            'opticalfibernode-list',
            // 'opticalfibernode-create',
            // 'opticalfibernode-edit',
            // 'opticalfibernode-delete',
            'opticalfiberlink-list',
            // 'opticalfiberlink-create',
            // 'opticalfiberlink-edit',
            // 'opticalfiberlink-delete',
            'highwayopticalfibernode-list',
            // 'highwayopticalfibernode-create',
            // 'highwayopticalfibernode-edit',
            // 'highwayopticalfibernode-delete',
            'highwayopticalfiberlink-list',
            // 'highwayopticalfiberlink-create',
            // 'highwayopticalfiberlink-edit',
            // 'highwayopticalfiberlink-delete',
            // 'import-data',
            'export-data',
            // 'coverage-data',
            'map-view',
            'map-tools'

        ];

        foreach ( $permissions as $permission ) {
            Permission::create( ['name' => $permission] );
        }
    }
}
