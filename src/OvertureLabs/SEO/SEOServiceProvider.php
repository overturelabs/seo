<?php namespace OvertureLabs\SEO;

use Illuminate\Support\ServiceProvider;

class SEOServiceProvider extends ServiceProvider {

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
        $this->package('overturelabs/seo');

        /**
         * Register Laravel Facade
         */
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('SEO', 'OvertureLabs\SEO\Facades\SEO');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['seo'] = $this->app->share(function($app)
        {
            return new SEO($app['config'],$app['router']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('seo');
    }

}
