<?php
namespace PhpRush\SimplaeEncrypt;

use Illuminate\Support\ServiceProvider;

class SimplaeEncryptServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $config_file = dirname(__DIR__) . '/config/config.php';
        $this->mergeConfigFrom($config_file, 'simple_encrypt');
        $this->publishes([
            $config_file => config_path('simple_encrypt.php')
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('SimplaeEncrypt', function () {
            $config = config('simple_encrypt');
            return new SimplaeEncrypt($config);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'SimplaeEncrypt',
            SimplaeEncrypt::class
        ];
    }
}