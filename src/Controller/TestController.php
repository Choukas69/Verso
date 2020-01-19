<?php

namespace App\Controller;

use VFram\HTTP\Request;
use VFram\Routing\Annotations\Route;
use VFram\AbstractController;

class TestController extends AbstractController
{
    /**
     * @Route(path="/test/{id}-{slug}", requirements={"id": "\d+", "slug": "\w+"})
     * @param Request $request
     */
    public function test(Request $request) {
        echo $request->get->get('id');
        $this->render("Errors/404.html");
    }
}