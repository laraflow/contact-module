<?php

namespace Modules\Contact\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Core\Models\Setting;
use Modules\Core\Supports\Constant;

class ContactSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $settings = [
            'country' => [
                'module' => 'Contact',
                'name' => 'Country',
                'icon' => 'fas fa-globe',
                'route' => 'contact.settings.countries.index',
                'color' => '#007bff',
                'description' => 'Countries list on this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'state' => [
                'module' => 'Contact',
                'name' => 'State',
                'icon' => 'fas fa-mountain',
                'route' => 'contact.settings.states.index',
                'color' => '#007bff',
                'description' => 'states available on countries',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'city' => [
                'module' => 'Contact',
                'name' => 'City',
                'icon' => 'fas fa-building',
                'route' => 'contact.settings.cities.index',
                'color' => '#007bff',
                'description' => 'user who can access this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'blood-group' => [
                'module' => 'Contact',
                'name' => 'Blood Group',
                'icon' => 'fas fa-object-group',
                'route' => 'contact.settings.blood-groups.index',
                'color' => '#007bff',
                'description' => 'user who can access this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'gender' => [
                'module' => 'Contact',
                'name' => 'Gender',
                'icon' => 'fas fa-venus-mars',
                'route' => 'contact.settings.genders.index',
                'color' => '#007bff',
                'description' => 'user who can access this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'occupation' => [
                'module' => 'Contact',
                'name' => 'Occupation',
                'icon' => 'fas fa-user-md',
                'route' => 'contact.settings.occupations.index',
                'color' => '#007bff',
                'description' => 'user who can access this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'relation' => [
                'module' => 'Contact',
                'name' => 'Relation',
                'icon' => 'fas fa-people-arrows',
                'route' => 'contact.settings.relations.index',
                'color' => '#007bff',
                'description' => 'user who can access this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'religion' => [
                'module' => 'Contact',
                'name' => 'Religion',
                'icon' => 'fas fa-place-of-worship',
                'route' => 'contact.settings.religions.index',
                'color' => '#007bff',
                'description' => 'user who can access this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
        ];

        foreach ($settings as $setting) {
            try {
                Setting::create($setting);
            } catch (\PDOException $exception) {
                throw new \PDOException($exception->getMessage());
            }
        }
    }
}
