<?php

namespace App;

use VFram\Application;

class App extends Application
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run(): void
    {
        $controller = $this->getController();
        $controller->execute();

        $this->response->setPage($controller->getPage());
        $this->response->send();
    }
}