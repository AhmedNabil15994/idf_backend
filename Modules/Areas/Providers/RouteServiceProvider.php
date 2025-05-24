<?php

namespace Modules\Areas\Providers;

use File;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $apiModule       = '\Modules\Areas\Http\Controllers\Api';
    protected $frontendModule  = '\Modules\Areas\Http\Controllers\Frontend';
    protected $dashboardModule = '\Modules\Areas\Http\Controllers\Dashboard';


    protected function mapDashboardRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize','check.permission')
        ->prefix(LaravelLocalization::setLocale().'/dashboard')
        ->namespace($this->dashboardModule)->group(function() {

            foreach (File::allFiles(module_path('Areas', 'Routes/dashboard')) as $file) {
                 require_once($file->getPathname());
            }

        });
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale())
        ->namespace($this->frontendModule)->group(function() {

            foreach (File::allFiles(module_path('Areas', 'Routes/frontend')) as $file) {
                require_once($file->getPathname());
            }

        });
    }

    protected function mapApiRoutes()
    {
        Route::group(['prefix'=>'api' ,'middleware' => ['api'] , 'namespace' => $this->apiModule],function() {

            foreach (File::allFiles(module_path('Areas', 'Routes/api')) as $file) {
                require_once($file->getPathname());
            }

        });
    }

}
