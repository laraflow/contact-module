<?php

namespace Modules\Contact\Database\Seeders\Common;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * @class Common/GroupTableSeeder
 * @package Modules\Contact\Database\Seeders\Common
 */
class Common/GroupTableSeeder extends Seeder
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
