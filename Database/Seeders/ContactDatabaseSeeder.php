<?php

namespace Modules\Contact\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Contact\Database\Seeders\GeoInfo\CountrySeeder;
use Modules\Contact\Database\Seeders\GeoInfo\StateSeeder;

class ContactDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
    }
}
