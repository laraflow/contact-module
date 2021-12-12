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
                'name' => 'Countries',
                'icon' => 'fas fa-globe',
                'route' => 'contact.setting.countries.index',
                'color' => '#007bff',
                'description' => 'Countries list on this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'role' => [
                'name' => 'States',
                'icon' => 'fas fa-address-card',
                'route' => 'contact.settings.states.index',
                'color' => '#007bff',
                'description' => 'states available on countries',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'permission' => [
                'name' => 'Cities',
                'icon' => 'fas fa-list-alt',
                'route' => 'contact.settings.cities.index',
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
