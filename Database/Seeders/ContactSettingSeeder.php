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
                'name' => 'Country',
                'icon' => 'fas fa-globe',
                'route' => 'contact.settings.countries.index',
                'color' => '#007bff',
                'description' => 'Countries list on this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'state' => [
                'name' => 'State',
                'icon' => 'fas fa-address-card',
                'route' => 'contact.settings.states.index',
                'color' => '#007bff',
                'description' => 'states available on countries',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'city' => [
                'name' => 'City',
                'icon' => 'fas fa-list-alt',
                'route' => 'contact.settings.cities.index',
                'color' => '#007bff',
                'description' => 'user who can access this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'blood-group' => [
                'name' => 'Blood Group',
                'icon' => 'fas fa-list-alt',
                'route' => 'contact.settings.blood-groups.index',
                'color' => '#007bff',
                'description' => 'user who can access this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'gender' => [
                'name' => 'Gender',
                'icon' => 'fas fa-list-alt',
                'route' => 'contact.settings.genders.index',
                'color' => '#007bff',
                'description' => 'user who can access this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'occupation' => [
                'name' => 'Occupation',
                'icon' => 'fas fa-list-alt',
                'route' => 'contact.settings.occupations.index',
                'color' => '#007bff',
                'description' => 'user who can access this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'relation' => [
                'name' => 'Relation',
                'icon' => 'fas fa-list-alt',
                'route' => 'contact.settings.relations.index',
                'color' => '#007bff',
                'description' => 'user who can access this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'religion' => [
                'name' => 'Religion',
                'icon' => 'fas fa-list-alt',
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
