<?php

namespace Leifel\ForrestAdmin\Providers\Lumen;

use GuzzleHttp\Client;
use Leifel\ForrestAdmin\Providers\BaseServiceProvider;
use Leifel\ForrestAdmin\Providers\Lumen\LumenRedirect;
use Leifel\ForrestAdmin\Providers\Laravel\LaravelCache;

class ForrestAdminServiceProvider extends BaseServiceProvider
{
    /**
     * Returns the location of the package config file.
     *
     * @return string file location
     */
    protected function getConfigPath()
    {
        return __DIR__.'/../config/forrestadmin.php';
    }

    protected function getClient()
    {
        return new Client(['http_errors' => true]);
    }

    protected function getRedirect()
    {
        return new LumenRedirect(redirect());
    }

    protected function getStorage()
    {
        return new LumenCache(app('cache'), app('config'));
    }
}
