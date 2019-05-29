<?php

namespace Leifel\ForrestAdmin\Providers\Laravel;

use GuzzleHttp\Client;
use Leifel\ForrestAdmin\Providers\BaseServiceProvider;
use Leifel\ForrestAdmin\Providers\Laravel\LaravelCache;
use Leifel\ForrestAdmin\Providers\Laravel\LaravelSession;

class ForrestAdminServiceProvider extends BaseServiceProvider
{
    /**
     * Returns the location of the package config file.
     *
     * @return string file location
     */
    protected function getConfigPath()
    {
        return config_path('forrestadmin.php');
    }

    protected function getClient()
    {
        return new Client(['http_errors' => true]);
    }

    protected function getRedirect()
    {
        return new LaravelRedirect(app('redirect'));
    }

    protected function getStorage($storageType)
    {
        switch ($storageType) {
            case 'session':
                $storage = new LaravelSession(app('config'), app('request')->session());
                break;
            case 'cache':
                $storage = new LaravelCache(app('config'), app('cache')->store());
                break;
            default:
                $storage = new LaravelSession(app('config'), app('request')->session());
        }

        return $storage;
    }
}
