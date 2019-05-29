<?php

namespace Leifel\ForrestAdmin\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Leifel\ForrestAdmin\Authentications\WebServer;
use Leifel\ForrestAdmin\Authentications\UserPassword;
use Leifel\ForrestAdmin\Providers\Laravel\LaravelCache;
use Leifel\ForrestAdmin\Providers\Laravel\LaravelEvent;
use Leifel\ForrestAdmin\Providers\Laravel\LaravelEncryptor;
use Leifel\ForrestAdmin\Providers\Laravel\LaravelInput;
use Leifel\ForrestAdmin\Providers\Laravel\LaravelRedirect;
use Leifel\ForrestAdmin\Providers\Laravel\LaravelSession;

use Leifel\ForrestAdmin\Formatters\JSONFormatter;
use Leifel\ForrestAdmin\Formatters\URLEncodedFormatter;
use Leifel\ForrestAdmin\Formatters\XMLFormatter;

use Leifel\ForrestAdmin\Repositories\InstanceURLRepository;
use Leifel\ForrestAdmin\Repositories\RefreshTokenRepository;
use Leifel\ForrestAdmin\Repositories\ResourceRepository;
use Leifel\ForrestAdmin\Repositories\StateRepository;
use Leifel\ForrestAdmin\Repositories\TokenRepository;
use Leifel\ForrestAdmin\Repositories\VersionRepository;


abstract class BaseServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Returns the location of the package config file.
     *
     * @return string file location
     */
    abstract protected function getConfigPath();

    /**
     * Returns client implementation
     *
     * @return GuzzleHttp\Client
     */
    protected abstract function getClient();

    /**
     * Returns client implementation
     *
     * @return GuzzleHttp\Client
     */
    protected abstract function getRedirect();

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if (!method_exists($this, 'getConfigPath')) return;

        $this->publishes([
            __DIR__.'/../../../config/config.php' => $this->getConfigPath(),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('forrestadmin', function ($app) {

            // Config options
            $settings           = config('forrestadmin');
            $storageType        = config('forrestadmin.storage.type');
            $authenticationType = config('forrestadmin.authentication');

            // Dependencies
            $httpClient    = $this->getClient();
            $input     = new LaravelInput(app('request'));
            $event     = new LaravelEvent(app('events'));
            $encryptor = new LaravelEncryptor(app('encrypter'));
            $redirect  = $this->getRedirect();
            $storage   = $this->getStorage($storageType);

            $refreshTokenRepo = new RefreshTokenRepository($encryptor, $storage);
            $tokenRepo        = new TokenRepository($encryptor, $storage);
            $resourceRepo     = new ResourceRepository($storage);
            $versionRepo      = new VersionRepository($storage);
            $instanceURLRepo  = new InstanceURLRepository($tokenRepo, $settings);
            $stateRepo        = new StateRepository($storage);

            $formatter = new JSONFormatter($tokenRepo, $settings);

            switch ($authenticationType) {
                case 'WebServer':
                    $forrestadmin = new WebServer(
                        $httpClient,
                        $encryptor,
                        $event,
                        $input,
                        $redirect,
                        $instanceURLRepo,
                        $refreshTokenRepo,
                        $resourceRepo,
                        $stateRepo,
                        $tokenRepo,
                        $versionRepo,
                        $formatter,
                        $settings);
                    break;
                case 'UserPassword':
                    $forrestadmin = new UserPassword(
                        $httpClient,
                        $encryptor,
                        $event,
                        $input,
                        $redirect,
                        $instanceURLRepo,
                        $refreshTokenRepo,
                        $resourceRepo,
                        $stateRepo,
                        $tokenRepo,
                        $versionRepo,
                        $formatter,
                        $settings);
                    break;
                default:
                    $forrestadmin = new WebServer(
                        $httpClient,
                        $encryptor,
                        $event,
                        $input,
                        $redirect,
                        $instanceURLRepo,
                        $refreshTokenRepo,
                        $resourceRepo,
                        $stateRepo,
                        $tokenRepo,
                        $versionRepo,
                        $formatter,
                        $settings);
                    break;
            }

            return $forrestadmin;
        });
    }
}
