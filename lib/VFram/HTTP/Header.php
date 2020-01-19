<?php

namespace VFram\HTTP;

use InvalidArgumentException;

class Header
{
    public function add(String $header): void
    {
        if (!empty($header))
            header($header);
        else
            throw new InvalidArgumentException('Arg must be a valid header');
    }
}