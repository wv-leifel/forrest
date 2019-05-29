<?php

namespace Leifel\ForrestAdmin\Exceptions;

use GuzzleHttp\Exception\RequestException;

class SalesforceException extends RequestException
{
    public function __construct($message, RequestException $e)
    {
        parent::__construct($message, $e->getRequest(), $e->getResponse(), $e);
    }
}