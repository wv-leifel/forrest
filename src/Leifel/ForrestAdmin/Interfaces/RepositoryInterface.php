<?php

namespace Leifel\ForrestAdmin\Interfaces;

interface RepositoryInterface
{
    public function get();
    public function has();
    public function put($item);
}
