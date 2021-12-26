<?php

namespace Modules\Contact\Database\Seeders\Individual;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * @class Individual/ContactTableSeeder
 * @package Modules\Contact\Database\Seeders\Individual
 */
class Individual/ContactTableSeeder extends Seeder
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
