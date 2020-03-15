<?php

namespace Courses\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class CourseRouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Courses\Http\Controllers';

    private $modulePath = 'Modules/Courses/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapAdminRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix(buildRoutePrefix('api'))
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path($this->modulePath . 'routes/api.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::prefix(buildRoutePrefix('admin'))
             ->middleware(['web', 'auth:api'])
             ->namespace($this->namespace)
             ->group(base_path($this->modulePath . 'routes/admin.php'));
    }
}