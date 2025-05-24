<?php

namespace Modules\Authentication\Providers;

use File;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
     protected $apiModule       = '\Modules\Authentication\Http\Controllers\Api';
     protected $frontendModule  = '\Modules\Authentication\Http\Controllers\Frontend';
     protected $dashboardModule = '\Modules\Authentication\Http\Controllers\Dashboard';
     protected $charitiesModule = '\Modules\Authentication\Http\Controllers\Charity';



    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapDashboardRoutes();
        $this->mapCharitiesRoutes();
    }

    protected function mapDashboardRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale().'/dashboard')
        ->namespace($this->dashboardModule)->group(function() {

            if (File::allFiles(module_path('Authentication', 'Routes/dashboard'))) {
                foreach (File::allFiles(module_path('Authentication', 'Routes/dashboard')) as $file) {
                    require_once($file->getPathname());
                }
            }

        });
    }

    protected function mapCharitiesRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale().'/charities')
        ->namespace($this->charitiesModule)->group(function() {

            if (File::allFiles(module_path('Authentication', 'Routes/charities'))) {
                foreach (File::allFiles(module_path('Authentication', 'Routes/charities')) as $file) {
                    require_once($file->getPathname());
                }
            }
        });
    }


    protected function mapWebRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale())
        ->namespace($this->frontendModule)->group(function() {

            if (File::allFiles(module_path('Authentication', 'Routes/frontend'))) {
                foreach (File::allFiles(module_path('Authentication', 'Routes/frontend')) as $file) {
                    require_once($file->getPathname());
                }
            }

        });
    }

    protected function mapApiRoutes()
    {
        Route::group(['prefix'=>'api' ,'middleware' => ['api'] , 'namespace' => $this->apiModule],function() {

            if (File::allFiles(module_path('Authentication', 'Routes/api'))) {
                foreach (File::allFiles(module_path('Authentication', 'Routes/api')) as $file) {
                    require_once($file->getPathname());
                }
            }

        });
    }
}
