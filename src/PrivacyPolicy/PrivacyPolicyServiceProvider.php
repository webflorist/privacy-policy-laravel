<?php

namespace Webflorist\PrivacyPolicy;

use Illuminate\Foundation\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class PrivacyPolicyServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();
        $this->registerService();
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();
        $this->loadTranslations();
        $this->loadViews();

    }

    protected function mergeConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/privacy-policy.php', 'privacy-policy');
    }

    protected function registerService()
    {
        $this->app->singleton(PrivacyPolicy::class, function () {
            return new PrivacyPolicy();
        });
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/privacy-policy.php' => config_path('privacy-policy.php'),
        ]);
    }

    private function loadTranslations()
    {
        $vendorDir = $this->app->basePath('vendor');
        if ($this->app->environment('testing')) {
            $vendorDir = __DIR__ . "/../../vendor";
        }
        $viewpoint = config('privacy-policy.singular') ? 'singular' : 'plural';
        $this->loadTranslationsFrom($vendorDir . "/webflorist/privacy-policy-text/dist/php/colon-prefix/$viewpoint", "Webflorist-PrivacyPolicy");
    }

    private function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'webflorist-privacy-policy');
    }

    private function addMiddleware()
    {
        /** @var Kernel $kernel */
        $kernel = $this->app['Illuminate\Contracts\Http\Kernel'];
        $kernel->pushMiddleware(RouteTreeMiddleware::class);


        /** @var Router $router */
        $router = $this->app['router'];
        if($router->hasMiddlewareGroup('web')) {
            $router->pushMiddlewareToGroup('web', SessionLocaleMiddleware::class);
        }
    }

    private function addRoutes()
    {
        /** @var Router $router */
        $router = $this->app['router'];

        if (config('routetree.api.enabled')) {
            $router->group(['prefix' => config('routetree.api.base_path'), 'middleware' => 'api'], function (Router $router) {
                $router->resource('routes', RoutesController::class)->only(['index', 'show']);
            });
        }

        if (config('routetree.sitemap.route.enabled')) {
            $router->get(config('routetree.sitemap.route.path'), [XmlSitemapController::class, 'get']);
        }
    }
}