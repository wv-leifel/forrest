<?php

namespace Leifel\ForrestAdmin\Interfaces;

interface ResourceRepositoryInterface
{
    public function get($resource);
    public function put($resource);
    public function has();
}
