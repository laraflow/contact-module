<?php

namespace Modules\Contact\Database\Seeders\Setting;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        $timestamp = date('Y-m-d h:i:s');
        try {
            DB::table('genders')->insert([
                ['name' => 'Female', 'remarks' => 'famine gender', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => $timestamp, 'updated_at' => $timestamp, 'deleted_at' => null],
                ['name' => 'Male', 'remarks' => 'muscular gender', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => $timestamp, 'updated_at' => $timestamp, 'deleted_at' => null],
                ['name' => 'Others', 'remarks' => 'other', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => $timestamp, 'updated_at' => $timestamp, 'deleted_at' => null],
            ]);
        }catch (\PDOException $exception) {
            throw new \PDOException($exception->getMessage());
        }
    }
}
