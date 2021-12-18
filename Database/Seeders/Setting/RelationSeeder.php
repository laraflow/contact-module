<?php

namespace Modules\Contact\Database\Seeders\Setting;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * @class RelationTableSeeder
 * @package Modules\Contact\Database\Seeders\Setting
 */
class RelationSeeder extends Seeder
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
