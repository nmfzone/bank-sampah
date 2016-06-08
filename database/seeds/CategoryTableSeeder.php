<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        DB::table('categories')->truncate();

        Category::create([
            'name'  => 'Kecil',
            'price' => 10,
        ]);

        Category::create([
            'name'  => 'Sedang',
            'price' => 50,
        ]);

        Category::create([
            'name'  => 'Besar',
            'price' => 70,
        ]);

        $this->command->info('Categories Has been Seeded');
    }
}
