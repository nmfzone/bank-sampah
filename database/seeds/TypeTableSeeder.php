<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        DB::table('types')->truncate();

        Type::create([
            'name'  => 'Plastik',
        ]);

        Type::create([
            'name'  => 'Aluminium',
        ]);

        $this->command->info('Types Has been Seeded');
    }
}
