<?php

namespace Modules\Authorization\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Authorization\Entities\Permission;

class PermissionsSeederTableSeeder extends Seeder
{
    protected $mapKey = [
        "show" => [
            'routes' => 'dashboard.::name.index,dashboard.::name.datatable,dashboard.::name.show',
            "lang" => [
                "ar" => "عرض",
                "en" =>  "show",
            ]
        ],
        "add" => [
            'routes' => 'dashboard.::name.create,dashboard.::name.store',
            "lang" => [
                "ar" => "أضافه",
                "en" =>  "add"
            ]
        ],
        "edit" => [
            'routes' => 'dashboard.::name.edit,dashboard.::name.update',
            "lang" => [
                "ar" => "تعديل",
                "en" =>"edit"
            ]
        ],
        "delete" => [
            'routes' => 'dashboard.::name.deletes,dashboard.::name.destroy',
            "lang" => [
                "ar" => "حذف",
                "en" =>  "delete"
            ]
        ],
    ];

    /**
     * @param $route
     * @param $category
     * @param string $guard_name
     */
    public function run($route, $category, $guard_name = 'web')
    {
        foreach ($this->mapKey as $key => $value) {
            # code...
            $routes = str_replace('::name', $route, $value['routes']);
            $this->createPermission($key . "_" . $route ,$category,$value['lang'],$routes,$guard_name);
        }
    }

    public function createPermission($name, $category, $display_name, $routes, $guard_name = 'web')
    {
        Permission::updateOrCreate([
            "display_name" => $display_name,
            "name" => $name,
        ], [
            "name" => $name,
            "category" => $category,
            'guard_name' => $guard_name,
            'routes' => $routes,
            'display_name' => $display_name,
        ]);
    }
}
