<?php

namespace VFram\HTTP\Session;

interface SessionInterface
{
    public function getAttribute(String $key): String;

    public function setAttribute(String $key, String $value): void;

    public function getFlash(): String;

    public function setFlash(String $flash): void;
}