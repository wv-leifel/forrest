<?php

namespace Leifel\ForrestAdmin\Interfaces;

interface FormatterInterface
{
    public function setHeaders();
    public function setBody($data);
    public function formatResponse($response);
}