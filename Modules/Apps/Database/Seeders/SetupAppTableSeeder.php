<?php

namespace Modules\Apps\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Areas\Database\Seeders\SeedCountriesTableSeeder;
use Modules\Authorization\Database\Seeders\PermissionsSeederTableSeeder;
use Modules\Authorization\Database\Seeders\RoleSeederTableSeeder;
use Modules\Authorization\Entities\Permission;
use Modules\Authorization\Entities\Role;
use Modules\Donations\Entities\DonationStatus;
use Modules\User\Entities\User;

class SetupAppTableSeeder extends Seeder
{


    private $permissions = [
        'access' => [
            'category' => ['ar' => 'لوحة التحكم', 'en' => 'access'],
            'single' => true,
            'name' => 'dashboard_access',
            'routes' => 'dashboard.home',
            'display_name' => [
                'en' => 'Dashboard access',
                'ar' => 'عرض لوحة التحكم'
            ],
        ],
        'statistics' => [
            'category' => ['ar' => 'لوحة التحكم', 'en' => 'access'],
            'single' => true,
            'name' => 'show_statistics',
            'routes' => '',
            'display_name' => [
                'en' => 'Show Statistics',
                'ar' => 'عرض الإحصائيات',
            ],
        ],


        'roles' => [
            'category' => ['ar' => 'الصلاحيات', 'en' => 'roles'],
            'single' => false
        ],
        'users' => [
            'category' => ['ar' => 'المستخدمين', 'en' => 'users'],
            'single' => false
        ],
        'admins' => [
            'category' => ['ar' => 'المدراء', 'en' => 'admins'],
            'single' => false
        ],

//        'notifications' => [
//            'category' => ['ar' => 'الإشعارات', 'en' => 'notifications'],
//            'single' => false
//        ],
        'categories' => [
            'category' => ['ar' => 'الأقسام', 'en' => 'categories'],
            'single' => false
        ],
        'countries' => [
            'category' => ['ar' => 'الدول', 'en' => 'countries'],
            'single' => false
        ],
        'governorates' => [
            'category' => ['ar' => 'المحافظات', 'en' => 'governorates'],
            'single' => false
        ],
        'cities' => [
            'category' => ['ar' => 'المدن', 'en' => 'cities'],
            'single' => false
        ],
        'regions' => [
            'category' => ['ar' => 'المناطق', 'en' => 'regions'],
            'single' => false
        ],
        /////////////////////


        'charities' => [
            'category' => ['ar' => 'الجمعيات الخيرية', 'en' => 'charities'],
            'single' => false
        ],
        'families' => [
            'category' => ['ar' => 'العائلات', 'en' => 'families'],
            'single' => false
        ],
        'donors' => [
            'category' => ['ar' => 'المتبرعين', 'en' => 'donors'],
            'single' => false
        ],
        'volunteers' => [
            'category' => ['ar' => 'المتطوعين', 'en' => 'volunteers'],
            'single' => false
        ],
        ////////////////////////


        'item_types' => [
            'category' => ['ar' => 'حلات المنتج', 'en' => 'item types'],
            'single' => false
        ],
        'projects' => [
            'category' => ['ar' => 'المشاريع', 'en' => 'projects'],
            'single' => false
        ],
        'baskets' => [
            'category' => ['ar' => 'السلال الغذائية', 'en' => 'baskets'],
            'single' => false
        ],


        'show_donations' => [
            'category' => ['ar' => 'التبرعات', 'en' => 'donations'],
            'single' => true,
            'name' => 'show_donations',
            'routes' => 'dashboard.donations.index,dashboard.donations.export,dashboard.donations.datatable,dashboard.donations.show',
            'display_name' => [
                'en' => 'Show',
                'ar' => 'عرض ',
            ],
        ],
        'delete_donations' => [
            'category' => ['ar' => 'التبرعات', 'en' => 'donations'],
            'single' => true,
            'name' => 'delete_donations',
            'routes' => 'dashboard.donations.destroy,dashboard.donations.deletes',
            'display_name' => [
                'en' => 'Delete',
                'ar' => 'حذف ',
            ],
        ],


        'show_donate_resources' => [
            'category' => ['ar' => 'التبرعات العينية', 'en' => 'donate_resources'],
            'single' => true,
            'name' => 'show_donate_resources',
            'routes' => 'dashboard.donate_resources.index,dashboard.donate_resources.datatable,dashboard.donate_resources.show',
            'display_name' => [
                'en' => 'Show',
                'ar' => 'عرض ',
            ],
        ],
        'delete_donate_resources' => [
            'category' => ['ar' => 'التبرعات العينية', 'en' => 'Donate resources'],
            'single' => true,
            'name' => 'delete_donate_resources',
            'routes' => 'dashboard.donate_resources.destroy,dashboard.donate_resources.deletes',
            'display_name' => [
                'en' => 'Delete',
                'ar' => 'حذف ',
            ],
        ],

        'orders' => [
            'category' => ['ar' => 'توزيع السلال', 'en' => 'orders'],
            'single' => false
        ],
        ////////////////////////


        'religions' => [
            'category' => ['ar' => 'الديانات', 'en' => 'religions'],
            'single' => false
        ],
        'nationalities' => [
            'category' => ['ar' => 'الجنسيات', 'en' => 'nationalities'],
            'single' => false
        ],
        'sliders' => [
            'category' => ['ar' => 'سلايدر الصور', 'en' => 'sliders'],
            'single' => false
        ],
        'partners' => [
            'category' => ['ar' => 'شركاء النجاح', 'en' => 'partners'],
            'single' => false
        ],
        'pages' => [
            'category' => ['ar' => 'الصفحات', 'en' => 'pages'],
            'single' => false
        ],

        'show_settings' => [
            'category' => ['ar' => 'الإعدادات', 'en' => 'settings'],
            'single' => true,
            'name' => 'show_settings',
            'routes' => 'dashboard.setting.index',
            'display_name' => [
                'en' => 'Show',
                'ar' => 'عرض ',
            ],
        ],
        'edit_settings' => [
            'category' => ['ar' => 'الإعدادات', 'en' => 'settings'],
            'single' => true,
            'name' => 'edit_settings',
            'routes' => 'dashboard.setting.update',
            'display_name' => [
                'en' => 'Edit',
                'ar' => 'تعديل ',
            ],
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        Model::unguard();
        $this->createPermissions();
        (new RoleSeederTableSeeder())->run();
        $this->insertUserRole($this->insertUser());
        Artisan::call('permission:cache-reset');
        $this->insertNationalities();
        $this->insertDonationStatuses();
        (new SeedCountriesTableSeeder())->run();
        DB::commit();
    }


    private function insertUser()
    {
        return User::create([
            'name' => 'admin',
            'mobile' => '01234567891',
            'email' => 'admin@tocaan.com',
            'password' => Hash::make(123456),
        ]);
    }

    private function insertUserRole($user)
    {
        $user->assignRole(['super-admin']);
    }

    private function insertNationalities()
    {


        DB::insert('INSERT INTO `nationalities` (`id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, \'2021-02-17 08:57:31\', \'2021-02-17 08:57:31\'),
(2, 1, NULL, \'2021-02-17 08:57:43\', \'2021-02-17 08:57:43\'),
(3, 1, NULL, \'2021-06-04 11:13:10\', \'2021-06-04 11:13:10\'),
(4, 1, NULL, \'2021-06-04 11:13:55\', \'2021-06-04 11:13:55\'),
(5, 1, NULL, \'2021-06-04 11:17:10\', \'2021-06-04 11:17:10\'),
(6, 1, NULL, \'2021-06-04 11:18:05\', \'2021-06-04 11:18:05\'),
(7, 1, NULL, \'2021-06-04 11:18:58\', \'2021-06-04 11:18:58\'),
(8, 1, NULL, \'2021-06-04 11:19:42\', \'2021-06-04 11:19:42\'),
(9, 1, NULL, \'2021-06-04 11:20:09\', \'2021-06-04 11:20:09\'),
(10, 1, NULL, \'2021-06-04 11:20:41\', \'2021-06-04 11:20:41\'),
(11, 1, NULL, \'2021-06-04 11:21:24\', \'2021-06-04 11:21:24\'),
(12, 1, NULL, \'2021-06-04 11:24:51\', \'2021-06-04 11:24:51\')');

        //translations
        DB::insert('INSERT INTO `nationality_translations` (`id`, `title`, `locale`, `nationality_id`, `created_at`, `updated_at`) VALUES
(1, \'Indian\', \'en\', 1, \'2021-02-17 08:57:31\', \'2021-02-17 08:57:31\'),
(2, \'الهندية\', \'ar\', 1, \'2021-02-17 08:57:31\', \'2021-02-17 08:57:31\'),
(3, \'Pakistani\', \'en\', 2, \'2021-02-17 08:57:43\', \'2021-02-17 08:57:43\'),
(4, \'الباكستانية\', \'ar\', 2, \'2021-02-17 08:57:43\', \'2021-02-17 08:57:43\'),
(5, \'philippines\', \'en\', 3, \'2021-06-04 11:13:10\', \'2021-06-04 11:13:10\'),
(6, \'الفلبينية\', \'ar\', 3, \'2021-06-04 11:13:10\', \'2021-06-04 11:13:10\'),
(7, \'nepali\', \'en\', 4, \'2021-06-04 11:13:55\', \'2021-06-04 11:13:55\'),
(8, \'النيبالية\', \'ar\', 4, \'2021-06-04 11:13:55\', \'2021-06-04 11:13:55\'),
(9, \'sri lanka\', \'en\', 5, \'2021-06-04 11:17:10\', \'2021-06-04 11:17:10\'),
(10, \'السيلانية\', \'ar\', 5, \'2021-06-04 11:17:10\', \'2021-06-04 11:17:10\'),
(11, \'ethiopia\', \'en\', 6, \'2021-06-04 11:18:05\', \'2021-06-04 11:18:05\'),
(12, \'الاثيوبية\', \'ar\', 6, \'2021-06-04 11:18:05\', \'2021-06-04 11:18:05\'),
(13, \'egyptian\', \'en\', 7, \'2021-06-04 11:18:58\', \'2021-06-04 11:18:58\'),
(14, \'المصرية\', \'ar\', 7, \'2021-06-04 11:18:58\', \'2021-06-04 11:18:58\'),
(15, \'syria\', \'en\', 8, \'2021-06-04 11:19:42\', \'2021-06-04 11:19:42\'),
(16, \'سوريا\', \'ar\', 8, \'2021-06-04 11:19:42\', \'2021-06-04 11:19:42\'),
(17, \'jordan\', \'en\', 9, \'2021-06-04 11:20:09\', \'2021-06-04 11:20:09\'),
(18, \'الاردن\', \'ar\', 9, \'2021-06-04 11:20:09\', \'2021-06-04 11:20:09\'),
(19, \'lebanon\', \'en\', 10, \'2021-06-04 11:20:41\', \'2021-06-04 11:20:41\'),
(20, \'لبنان\', \'ar\', 10, \'2021-06-04 11:20:41\', \'2021-06-04 11:20:41\'),
(21, \'bangladesh\', \'en\', 11, \'2021-06-04 11:21:24\', \'2021-06-04 11:21:24\'),
(22, \'بنغلاديش\', \'ar\', 11, \'2021-06-04 11:21:24\', \'2021-06-04 11:21:24\'),
(23, \'africa\', \'en\', 12, \'2021-06-04 11:24:51\', \'2021-06-04 11:24:51\'),
(24, \'افريقيا\', \'ar\', 12, \'2021-06-04 11:24:51\', \'2021-06-04 11:24:51\')');
    }

    private function insertDonationStatuses()
    {

        $codes = [
            'success' => 'تم الدفع بنجاح',
            'failed' => 'فشلة عملية الدفع',
            'refund' => 'تم استرجاع المبلغ',
        ];

        foreach ($codes as $code => $title) {
            $record = DonationStatus::create(['code' => $code]);
            $record->translateOrNew('ar')->title = $title;
            $record->save();
        }
    }

    private function createPermissions()
    {
        $permissionSeeder = new PermissionsSeederTableSeeder();

        foreach ($this->permissions as $route => $options) {
            if (isset($options['single']) && $options['single']) {
                $permissionSeeder->createPermission($options['name'], $options['category'], $options['display_name'], $options['routes']);
            } else {

                $permissionSeeder->run($route, $options['category']);
            }
        }
    }
}
