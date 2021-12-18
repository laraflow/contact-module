<?php

namespace Modules\Contact\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Contact\Database\Seeders\Setting\BloodGroupSeeder;
use Modules\Contact\Database\Seeders\Setting\CountrySeeder;
use Modules\Contact\Database\Seeders\Setting\GenderSeeder;
use Modules\Contact\Database\Seeders\Setting\OccupationSeeder;
use Modules\Contact\Database\Seeders\Setting\RelationSeeder;
use Modules\Contact\Database\Seeders\Setting\ReligionSeeder;
use Modules\Contact\Database\Seeders\Setting\StateSeeder;

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
        $this->call(ContactSettingSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(BloodGroupSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(OccupationSeeder::class);
        $this->call(RelationSeeder::class);
        $this->call(ReligionSeeder::class);
    }
}
