<?php

namespace Modules\Contact\Database\Seeders\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Contact\Models\Setting\Religion;

/**
 * @class ReligionTableSeeder
 * @package Modules\Contact\Database\Seeders\Setting
 */
class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $religions = [
            ['name' => 'Islam', 'remarks' => 'Islam', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:50', 'updated_at' => '2020-11-23 12:10:17', 'deleted_at' => NULL],
            ['name' => 'Hindu', 'remarks' => 'Hindu', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:50', 'updated_at' => '2020-11-23 12:10:38', 'deleted_at' => NULL],
            ['name' => 'Chistran', 'remarks' => 'Chistran', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:50', 'updated_at' => '2020-11-23 12:10:52', 'deleted_at' => NULL],
            ['name' => 'Buddha', 'remarks' => 'Buddha', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:50', 'updated_at' => '2020-11-23 12:11:00', 'deleted_at' => NULL],
            ['name' => 'Others', 'remarks' => 'Others', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:50', 'updated_at' => '2021-12-16 23:35:28', 'deleted_at' => NULL],
        ];
        foreach ($religions as $religion) {
            try {
                Religion::create($religion);
            } catch (\PDOException $exception) {
                throw new \PDOException($exception->getMessage());
            }
        }
    }
}
