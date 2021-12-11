<?php

namespace Modules\Contact\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Core\Models\Setting;
use Modules\Core\Supports\Constant;

class SettingSeeder extends Seeder
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
                'route' => 'contact.geoinfo.countries.index',
                'color' => '#007bff',
                'description' => 'Countries list on this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'role' => [
                'name' => 'Roles',
                'icon' => 'fas fa-address-card',
                'route' => 'core.settings.roles.index',
                'color' => '#007bff',
                'description' => 'user who can access this system',
                'enabled' => Constant::ENABLED_OPTION
            ],
            'permission' => [
                'name' => 'Permissions',
                'icon' => 'fas fa-list-alt',
                'route' => 'core.settings.permissions.index',
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
