<?php

namespace VFram\HTTP\Session;

session_start();

class Session implements SessionInterface
{
    public function getAttribute(String $key): String
    {
        // TODO: Implement getAttribute() method.
        return null;
    }

    public function setAttribute(String $key, String $value): void
    {
        // TODO: Implement setAttribute() method.
    }

    public function getFlash(): String
    {
        // TODO: Implement getFlash() method.
        return null;
    }

    public function setFlash(String $flash): void
    {
        // TODO: Implement setFlash() method.
    }
}