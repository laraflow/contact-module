<?php

namespace Modules\Contact\Database\Seeders\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Contact\Models\Setting\Relation;

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
        $relations = [
            ['name' => 'Aunt', 'remarks' => 'aunt', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-11-23 12:16:29', 'deleted_at' => NULL],
            ['name' => 'Brother', 'remarks' => 'brother', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-11-23 12:16:54', 'deleted_at' => NULL],
            ['name' => 'Brother in law', 'remarks' => 'brother in law', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-09-16 06:55:56', 'deleted_at' => NULL],
            ['name' => 'Business associate', 'remarks' => 'business associate', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-09-16 06:56:00', 'deleted_at' => NULL],
            ['name' => 'Cousin', 'remarks' => 'cousin', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-11-23 12:17:19', 'deleted_at' => NULL],
            ['name' => 'Daughter', 'remarks' => 'daughter', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-08-28 21:48:52', 'deleted_at' => NULL],
            ['name' => 'Employee', 'remarks' => 'employee', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2021-12-16 23:35:39', 'deleted_at' => NULL],
            ['name' => 'Father', 'remarks' => 'father', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-08-28 21:48:52', 'deleted_at' => NULL],
            ['name' => 'Father in law', 'remarks' => 'father in law', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-08-28 21:48:52', 'deleted_at' => NULL],
            ['name' => 'Friend', 'remarks' => 'friend', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-08-28 21:48:52', 'deleted_at' => NULL],
            ['name' => 'Grand father', 'remarks' => 'grand father', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-09-16 06:56:05', 'deleted_at' => NULL],
            ['name' => 'Grand mother', 'remarks' => 'grand mother', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-09-16 06:56:10', 'deleted_at' => NULL],
            ['name' => 'Husband', 'remarks' => 'husband', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-08-28 21:48:52', 'deleted_at' => NULL],
            ['name' => 'Mother', 'remarks' => 'mother', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-08-28 21:48:52', 'deleted_at' => NULL],
            ['name' => 'Mother in law', 'remarks' => 'mother in law', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-08-28 21:48:52', 'deleted_at' => NULL],
            ['name' => 'Nephew', 'remarks' => 'nephew', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-09-16 06:56:14', 'deleted_at' => NULL],
            ['name' => 'Niece', 'remarks' => 'niece', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-09-16 06:56:18', 'deleted_at' => NULL],
            ['name' => 'Non related', 'remarks' => 'non related', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-09-16 06:56:22', 'deleted_at' => NULL],
            ['name' => 'Relative', 'remarks' => 'relative', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-09-16 06:56:26', 'deleted_at' => NULL],
            ['name' => 'Self', 'remarks' => 'self', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2021-12-16 23:35:41', 'deleted_at' => NULL],
            ['name' => 'Sister', 'remarks' => 'sister', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-08-28 21:48:52', 'deleted_at' => NULL],
            ['name' => 'Sister in law', 'remarks' => 'sister in law', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-09-16 06:56:31', 'deleted_at' => NULL],
            ['name' => 'Son', 'remarks' => 'son', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-08-28 21:48:52', 'deleted_at' => NULL],
            ['name' => 'Uncle', 'remarks' => 'uncle', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-09-16 06:56:36', 'deleted_at' => NULL],
            ['name' => 'Wife', 'remarks' => 'wife', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-11-23 12:17:52', 'deleted_at' => NULL],
            ['name' => 'Educational expenses', 'remarks' => 'educational expenses', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-08-28 21:48:52', 'deleted_at' => NULL],
            ['name' => 'Family maintenance/savings', 'remarks' => 'family maintenance/savings', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-08-28 21:48:52', 'deleted_at' => NULL],
            ['name' => 'Medical expenses', 'remarks' => 'medical expenses', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-08-28 21:48:52', 'deleted_at' => NULL],
            ['name' => 'Repayment of loans', 'remarks' => 'repayment of loans', 'additional_info' => '{}', 'enabled' => 'yes', 'created_at' => '2020-08-28 21:48:52', 'updated_at' => '2020-08-28 21:48:52', 'deleted_at' => NULL],
        ];
        foreach ($relations as $relation) {
            try {
                Relation::create($relation);
            } catch (\PDOException $exception) {
                throw new \PDOException($exception->getMessage());
            }
        }
    }
}
