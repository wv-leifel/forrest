<?php

namespace Leifel\ForrestAdmin\Repositories;

use Leifel\ForrestAdmin\Interfaces\RepositoryInterface;
use Leifel\ForrestAdmin\Interfaces\StorageInterface;
use Leifel\ForrestAdmin\Exceptions\MissingStateException;

class StateRepository implements RepositoryInterface {

    protected $storage;

    public function __construct(StorageInterface $storage) {
        $this->storage = $storage;
    }

    public function put($state) {
        $this->storage->put('stateOptions', $state);
    }

    public function get()
    {
        $this->verify();

        return $this->storage->get('stateOptions');
    }

    public function has() {
        return $this->storage->has('stateOptions');
    }

    private function verify() {
        if ($this->storage->has('stateOptions')) return;

        throw new MissingStateException('No state available');
    }
}