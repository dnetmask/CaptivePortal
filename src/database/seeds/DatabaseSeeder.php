<?php

namespace Netmask\CautivePortal\Database\Seeds;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(WifiUsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
