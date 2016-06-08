<?php

use Illuminate\Database\Seeder;
use App\SiteOption;

class SiteOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_options')->truncate();

        $options = [
            [
                "name"  => "favicon",
                "value" => "assets/images/favicon.png"
            ],
            [
                "name"  => "site_name",
                "value" => env('APP_NAME', 'Awesome')
            ],
            [
                "name"  => "site_logo",
                "value" => "assets/images/bank_sampah.png"
            ],
            [
                "name"  => "site_url",
                "value" => env('APP_URL', 'http://localhost:8000')
            ],
        ];

        foreach ($options as $option)
        {
            SiteOption::create($option);
        }

        $this->command->info('SiteOptions Has been Seeded');
    }
}
