<?php

namespace VFram\HTTP;

class Request
{
    public GetMethod $get;
    public PostMethod $post;

    public Cookie $cookies;

    public function __construct()
    {
        $this->get = new GetMethod();
        $this->post = new PostMethod();

        $this->cookies = new Cookie();
    }

    public function getURI(): String
    {
        return $_SERVER['REQUEST_URI'];
    }
}