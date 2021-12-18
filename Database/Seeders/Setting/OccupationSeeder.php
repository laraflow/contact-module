<?php

namespace Modules\Contact\Database\Seeders\Setting;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * @class OccupationTableSeeder
 * @package Modules\Contact\Database\Seeders\Setting
 */
class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
