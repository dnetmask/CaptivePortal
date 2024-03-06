<?php

namespace Netmask\CautivePortal\Database\Seeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class WifiUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**************MENU ITEM**************/
        $menu = Menu::where('name', 'admin')->firstOrFail();

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'url'     => '',
            'route'   => 'voyager.wifi-users.index',
        ]);

        if (!$menuItem->exists) {
            $menuItem->fill([
                'title'   => 'Usuarios Wifi',
                'target'     => '_self',
                'icon_class' => 'voyager-wifi',
                'order'      => 16,
            ])->save();
        }

        /**************DATA TYPE**************/
        $dataType = DataType::firstOrNew(['slug' => 'wifi-users']);
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'wifi_users',
                'display_name_singular' => 'Usuario WIFI',
                'display_name_plural'   => 'Usuarios WIFI',
                'icon'                  => 'voyager-wifi',
                'model_name'            => 'App\\WifiUser',
                'generate_permissions'  => 1,
                'server_side'           => 0,
                'description'           => '',
            ])->save();
        }

        /**************DATA ROWS**************/
        $dataRow = DataRow::firstOrNew([
            'data_type_id' => $dataType->id,
            'field'        => 'id',
        ]);
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = DataRow::firstOrNew([
            'data_type_id' => $dataType->id,
            'field'        => 'name',
        ]);
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
            ])->save();
        }

        $dataRow = DataRow::firstOrNew([
            'data_type_id' => $dataType->id,
            'field'        => 'email',
        ]);
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.email'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 3,
            ])->save();
        }

        /***************PERMISSIONS*******************/
        Permission::generateFor('wifi_users');
        // PERMISSION TO EXPORT TO EXCEL
        Permission::firstOrCreate(['key' => 'export_wifi_users', 'table_name' => 'wifi_users']);

        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::all();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );

        // USER ROLE
        $role = Role::where('name', 'user')->first();

        if ($role->exists) {
            $permissions = Permission::where('table_name', 'wifi_users')->get();
            foreach ($permissions as $permission) {
                if (!$role->permissions->contains($permission->id)) {
                    $role->permissions()->sync($permission->id);
                }
            }
        }
    }
}
