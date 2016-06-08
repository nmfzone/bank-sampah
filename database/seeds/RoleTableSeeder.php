<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        DB::table('roles')->truncate();

        Role::create([
            'name'   => 'Admin'
        ]);

        Role::create([
            'name'   => 'User'
        ]);

        $this->command->info('Roles Has been Seeded');
    }
}
