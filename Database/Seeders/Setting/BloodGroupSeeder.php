<?php

namespace Modules\Contact\Database\Seeders\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Contact\Models\Setting\BloodGroup;

/**
 * @class BloodGroupTableSeeder
 * @package Modules\Contact\Database\Seeders\Setting
 */
class BloodGroupSeeder extends Seeder
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
        $blood_groups = [
            ['name' => 'A (+ve)', 'remarks' => 'A RhD positive (A+)', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => $timestamp, 'updated_at' => $timestamp, 'deleted_at' => null],
            ['name' => 'A (-ve)', 'remarks' => 'A RhD negative (A-)', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => $timestamp, 'updated_at' => $timestamp, 'deleted_at' => null],
            ['name' => 'B (+ve)', 'remarks' => 'B RhD positive (B+)', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => $timestamp, 'updated_at' => $timestamp, 'deleted_at' => null],
            ['name' => 'B (-ve)', 'remarks' => 'B RhD negative (B-)', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => $timestamp, 'updated_at' => $timestamp, 'deleted_at' => null],
            ['name' => 'O (+ve)', 'remarks' => 'O RhD positive (O+)', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => $timestamp, 'updated_at' => $timestamp, 'deleted_at' => null],
            ['name' => 'O (-ve)', 'remarks' => 'O RhD negative (O-)', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => $timestamp, 'updated_at' => $timestamp, 'deleted_at' => null],
            ['name' => 'AB (+ve)', 'remarks' => 'AB RhD positive (AB+)', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => $timestamp, 'updated_at' => $timestamp, 'deleted_at' => null],
            ['name' => 'AB (-ve)', 'remarks' => 'AB RhD negative (AB-)', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => $timestamp, 'updated_at' => $timestamp, 'deleted_at' => null],
        ];

        foreach ($blood_groups as $blood_group) {
            try {
                BloodGroup::create($blood_group);
            } catch (\PDOException $exception) {
                throw new \PDOException($exception->getMessage());
            }
        }

    }
}
