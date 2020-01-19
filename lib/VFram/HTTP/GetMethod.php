<?php

namespace VFram\HTTP;

class GetMethod
{
    public function get(String $key): ?String
    {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }
}