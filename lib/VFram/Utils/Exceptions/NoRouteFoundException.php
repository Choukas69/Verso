<?php

namespace VFram\Utils\Exceptions;

use RuntimeException;

class NoRouteFoundException extends RuntimeException
{
    private String $url;

    public function __construct($url = "", $code = 0)
    {
        $this->url = $url;
        parent::__construct("No route was found", $code);
    }

    public function __toString()
    {
        return __CLASS__ . " : No route matched url " . $this->url;
    }
}