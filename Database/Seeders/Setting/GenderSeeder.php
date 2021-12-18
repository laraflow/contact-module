<?php

namespace Modules\Contact\Database\Seeders\Setting;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * @class GenderTableSeeder
 * @package Modules\Contact\Database\Seeders\Setting
 */
class GenderSeeder extends Seeder
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
