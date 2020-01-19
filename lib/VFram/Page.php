<?php

namespace VFram;

use RuntimeException;

class Page
{
    private String $contentFile;
    private array $vars;

    public function __construct()
    {
        $this->vars = [];
    }

    public function addVar($var, $value): void
    {
        $this->vars[$var] = $value;
    }

    public function getGeneratedPage($contentFile = "", array $vars = [])
    {
        $contentFile = !empty($contentFile) ? $contentFile : $this->contentFile;

        if (!empty($contentFile) && file_exists($contentFile)) {
            $vars = !empty($vars) ? $vars : $this->vars;

            extract($vars);

            ob_start();
            /** @noinspection PhpIncludeInspection */
            require $contentFile;
            /** @noinspection PhpUnusedLocalVariableInspection */
            $content = ob_get_clean();

            ob_start();
            require __DIR__ . '/../../src/View/Templates/layout.php';

            return ob_get_clean();
        } else {
            throw new RuntimeException("View doesn't exist");
        }
    }

    public function setContentFile(String $contentFile): void
    {
        $this->contentFile = __DIR__ . '/../../src/View/' . $contentFile;
    }
}