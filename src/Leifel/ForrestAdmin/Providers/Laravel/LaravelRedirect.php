<?php

namespace Leifel\ForrestAdmin\Providers\Laravel;

use Illuminate\Routing\Redirector;
use Leifel\ForrestAdmin\Interfaces\RedirectInterface;

class LaravelRedirect implements RedirectInterface
{
    protected $redirector;

    public function __construct(Redirector $redirector)
    {
        $this->redirector = $redirector;
    }

    /**
     * Redirect to new url.
     *
     * @param string $parameter
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function to($parameter)
    {
        return $this->redirector->to($parameter);
    }
}
