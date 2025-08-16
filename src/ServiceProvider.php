<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Playground\Admin\Resource;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Log;

/**
 * \Playground\Admin\Resource\ServiceProvider
 */
class ServiceProvider extends AuthServiceProvider
{
    public const VERSION = '73.0.0';

    protected string $package = 'playground-admin-resource';

    /**
     * Bootstrap any package services.
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        /**
         * @var array<string, mixed> $config
         */
        $config = config($this->package);

        if (! empty($config['load']) && is_array($config['load'])) {

            if (! empty($config['load']['translations'])) {
                $this->loadTranslationsFrom(
                    dirname(__DIR__).'/lang',
                    $this->package
                );
            }

            if (! empty($config['load']['policies'])
                && ! empty($config['policies'])
                && is_array($config['policies'])
            ) {
                $this->setPolicies($config['policies']);
                $this->registerPolicies();
            }

            if (! empty($config['load']['routes'])
                && ! empty($config['routes'])
                && is_array($config['routes'])
            ) {
                $this->routes($config['routes']);
            }

            if (! empty($config['load']['views'])) {
                $this->loadViewsFrom(
                    dirname(__DIR__).'/resources/views',
                    $this->package
                );
            }

            if ($this->app->runningInConsole()) {
                // Publish configuration
                $this->publishes([
                    sprintf('%1$s/config/%2$s.php', dirname(__DIR__), $this->package) => config_path(sprintf('%1$s.php', $this->package)),
                ], 'playground-config');

                // Publish routes
                $this->publishes([
                    dirname(__DIR__).'/routes' => base_path('routes/playground-admin-resource'),
                ], 'playground-routes');
            }
        }

        $this->about();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/config/playground-admin-resource.php',
            $this->package
        );
    }

    /**
     * Set the application's policies from the configuration.
     *
     * @param  array<class-string, class-string>  $policies
     */
    public function setPolicies(array $policies): void
    {
        foreach ($policies as $model => $policy) {
            if (! is_string($model) || ! class_exists($model)) {
                Log::error('Expecting the model to exist for the policy.', [
                    '__METHOD__' => __METHOD__,
                    'model' => is_string($model) ? $model : gettype($model),
                    'policy' => is_string($policy) ? $policy : gettype($policy),
                    'policies' => $policies,
                ]);

                continue;
            }
            if (! is_string($policy) || ! class_exists($policy)) {
                Log::error('Expecting the policy to exist for the model.', [
                    '__METHOD__' => __METHOD__,
                    'model' => is_string($model) ? $model : gettype($model),
                    'policy' => is_string($policy) ? $policy : gettype($policy),
                    'policies' => $policies,
                ]);

                continue;
            }
            $this->policies[$model] = $policy;
        }
    }

    /**
     * @param  array<string, mixed>  $config
     */
    public function routes(array $config): void
    {
        if (! empty($config['admin'])) {
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/admin.php');
        }
        if (! empty($config['settings'])) {
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/settings.php');
        }
        if (! empty($config['users'])) {
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/users.php');
        }
    }

    public function about(): void
    {
        $config = config($this->package);
        $config = is_array($config) ? $config : [];

        $load = ! empty($config['load']) && is_array($config['load']) ? $config['load'] : [];

        $middleware = ! empty($config['middleware']) && is_array($config['middleware']) ? $config['middleware'] : [];

        $routes = ! empty($config['routes']) && is_array($config['routes']) ? $config['routes'] : [];

        $sitemap = ! empty($config['sitemap']) && is_array($config['sitemap']) ? $config['sitemap'] : [];

        AboutCommand::add('Playground:Admin Resource', fn () => [
            '<fg=yellow;options=bold>Load</> Policies' => ! empty($load['policies']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=yellow;options=bold>Load</> Routes' => ! empty($load['routes']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=yellow;options=bold>Load</> Views' => ! empty($load['views']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',

            '<fg=yellow;options=bold>Middleware</> auth' => ! empty($middleware['auth']) ? sprintf('%s', json_encode($middleware['auth'])) : '',
            '<fg=yellow;options=bold>Middleware</> default' => ! empty($middleware['default']) ? sprintf('%s', json_encode($middleware['default'])) : '',
            '<fg=yellow;options=bold>Middleware</> guest' => ! empty($middleware['guest']) ? sprintf('%s', json_encode($middleware['guest'])) : '',

            '<fg=blue;options=bold>View</> [Blade]' => ! empty($config['blade']) ? sprintf('[%s]', $config['blade']) : '',

            '<fg=magenta;options=bold>Sitemap</> Views' => ! empty($sitemap['enable']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=magenta;options=bold>Sitemap</> Guest' => ! empty($sitemap['guest']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=magenta;options=bold>Sitemap</> User' => ! empty($sitemap['user']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=magenta;options=bold>Sitemap</> [view]' => sprintf('[%s]', $sitemap['view']),

            '<fg=red;options=bold>Route</> admin' => ! empty($routes['admin']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=red;options=bold>Route</> settings' => ! empty($routes['settings']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=red;options=bold>Route</> users' => ! empty($routes['users']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',

            'Package' => $this->package,
            'Version' => ServiceProvider::VERSION,
        ]);
    }
}
