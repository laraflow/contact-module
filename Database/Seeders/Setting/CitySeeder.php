<?php

namespace Modules\Contact\Database\Seeders\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::beginTransaction();

        try {
            DB::table('cities')->insert([]);
            DB::commit();
        } catch (\PDOException $exception) {
            DB::rollBack();
            throw new \PDOException($exception->getMessage());
        }
    }
}