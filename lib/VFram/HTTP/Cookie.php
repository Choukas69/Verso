<?php

namespace VFram\HTTP;

class Cookie
{
    public function get(String $key): ?String
    {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }

    public function set(String $name, String $value = null, $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true): void
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
}