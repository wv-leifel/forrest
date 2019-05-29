<?php

namespace Leifel\ForrestAdmin\Formatters;

use Leifel\ForrestAdmin\Interfaces\FormatterInterface;

class URLEncodedFormatter implements FormatterInterface
{
    public function setHeaders()
    {
        $headers['Accept'] = 'application/x-www-form-urlencoded';
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';

        return $headers;
    }

    public function setBody($data)
    {
        return $data;
    }

    public function formatResponse($response)
    {
        return $response->getBody();
    }
}