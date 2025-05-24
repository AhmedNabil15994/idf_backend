<?php

namespace Modules\Order\Providers;

use File;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $apiModule       = '\Modules\Order\Http\Controllers\Api';
    protected $frontendModule  = '\Modules\Order\Http\Controllers\Frontend';
    protected $dashboardModule = '\Modules\Order\Http\Controllers\Dashboard';
    protected $charityModule = '\Modules\Order\Http\Controllers\Charity';


    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapDashboardRoutes();
        $this->mapCharitiesRoutes();
    }


    protected function mapDashboardRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize','check.permission')
        ->prefix(LaravelLocalization::setLocale().'/dashboard')
        ->namespace($this->dashboardModule)->group(function() {

            foreach (File::allFiles(module_path('Order', 'Routes/dashboard')) as $file) {
                 require_once($file->getPathname());
            }

        });
    }

    protected function mapCharitiesRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize','charities-auth')
            ->prefix(LaravelLocalization::setLocale().'/charities')
            ->namespace($this->charityModule)->group(function() {

                if (File::allFiles(module_path('Order', 'Routes/charities'))) {
                    foreach (File::allFiles(module_path('Order', 'Routes/charities')) as $file) {
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

            foreach (File::allFiles(module_path('Order', 'Routes/frontend')) as $file) {
                require_once($file->getPathname());
            }

        });
    }

    protected function mapApiRoutes()
    {
        Route::group(['prefix'=>'api' ,'middleware' => ['api'] , 'namespace' => $this->apiModule],function() {

            foreach (File::allFiles(module_path('Order', 'Routes/api')) as $file) {
                require_once($file->getPathname());
            }

        });
    }

}
