<?php namespace Confess;

use Illuminate\Support\ServiceProvider;

class ConfessServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindRepositories();

        require_once app_path('helpers.php');
    }

    /**
     * Bind repositories.
     *
     * @return void
     */
    protected function bindRepositories()
    {
        $this->app->singleton( 'Confess\Repositories\ConfessionRepositoryInterface', 'Confess\Repositories\DbConfessionRepository' );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    public function register(){}

}