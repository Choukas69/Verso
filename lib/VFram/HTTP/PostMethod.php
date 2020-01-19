<?php

namespace VFram\HTTP;

class PostMethod
{
    public function get(String $key): ?String
    {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }
}