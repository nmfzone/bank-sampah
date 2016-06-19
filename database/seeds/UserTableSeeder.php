<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        DB::table('users')->truncate();

        $adminRole = Role::where('name', 'Admin')->first()->id;
        $userRole = Role::where('name', 'User')->first()->id;

        User::create([
            'username'          => 'ini_admin',
            'name'              => 'Administrator',
            'email'             => 'admin@banksampah.com',
            'password'          => '123456',
            'address'           => 'Yogyakarta',
            'phone'             => '000000000',
            'id_card_number'    => '000000000',
            'role_id'           => $adminRole,
            'status'            => 4,
        ]);

        User::create([
            'username'          => 'nmfzone',
            'name'              => 'nmfzone',
            'email'             => 'hi@nmfzone.com',
            'password'          => '123456',
            'address'           => 'Yogyakarta',
            'phone'             => '100000000',
            'id_card_number'    => '100000000',
            'role_id'           => $userRole,
            'status'            => 1,
        ]);

        $this->command->info('Users Has been Seeded');
    }
}
