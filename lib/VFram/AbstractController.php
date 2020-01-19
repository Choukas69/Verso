<?php

namespace VFram;

use VFram\Persistence\Permaneat;
use VFram\Utils\PDOFactory;

abstract class AbstractController
{
    private Application $app;
    private String $action;

    private Page $page;

    protected Permaneat $permaneat;

    public function __construct(Application $app, String $action)
    {
        $this->app = $app;
        $this->action = $action;

        $this->page = new Page();

        $this->permaneat = new Permaneat(PDOFactory::getConnection());
    }

    public function execute()
    {
        $action = $this->action;
        $this->$action($this->app->request);
    }

    protected function render(String $file = null, array $vars = [])
    {
        if (!empty($file)) {
            $this->page->setContentFile($file);
        }

        if (!empty($vars)) {
            foreach ($vars as $var => $value) {
                $this->page->addVar($var, $value);
            }
        }
    }

    public function getPage(): Page
    {
        return $this->page;
    }
}