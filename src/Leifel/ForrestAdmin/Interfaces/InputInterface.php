<?php

namespace Leifel\ForrestAdmin\Interfaces;

interface InputInterface
{
    /**
     * Get input from response.
     *
     * @param string $parameter
     *
     * @return mixed
     */
    public function get($parameter);
}
