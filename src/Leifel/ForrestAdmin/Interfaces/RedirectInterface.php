<?php

namespace Leifel\ForrestAdmin\Interfaces;

interface RedirectInterface
{
    /**
     * Redirect to new url.
     *
     * @param string $parameter
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function to($parameter);
}
