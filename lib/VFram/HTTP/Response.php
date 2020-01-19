<?php

namespace VFram\HTTP;

use InvalidArgumentException;
use VFram\Page;

class Response
{
    public Cookie $cookies;
    public Header $headers;

    private Page $page;

    public function __construct()
    {
        $this->cookies = new Cookie();
        $this->headers = new Header();

        $this->page = new Page();
    }

    public function redirect(String $location): void
    {
        if (!empty($location)) {
            $this->headers->add('Location: ' . $location);
        } else {
            throw new InvalidArgumentException("Arg must be a valid location");
        }
    }

    public function redirect404(): void
    {
        $this->page->setContentFile('Errors/404.html');

        $this->headers->add('HTTP/1.1 404 Not found');

        $this->send();
    }

    public function setPage(Page $page): void
    {
        $this->page = $page;
    }

    public function send(): void
    {
        exit($this->page->getGeneratedPage());
    }
}