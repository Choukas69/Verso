<?php

namespace VFram\Routing;

class Route
{
    private String $path;
    private String $controller;
    private String $action;
    private array $varsNames;

    private array $vars;

    public function __construct(String $path, String $controller, String $action, array $varsNames)
    {
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
        $this->varsNames = $varsNames;

        $this->vars = [];
    }

    public function match(String $url)
    {
        if (preg_match('#^' . $this->path . '$#', $url, $matches)) {
            return $matches;
        } else {
            return null;
        }
    }

    /**
     * @return String
     */
    public function getController(): String
    {
        return $this->controller;
    }

    /**
     * @return String
     */
    public function getAction(): String
    {
        return $this->action;
    }

    public function getVarsNames(): array
    {
        return $this->varsNames;
    }

    public function getVars(): array
    {
        return $this->vars;
    }

    public function setVars(array $vars): void
    {
        $this->vars = $vars;
    }

    public function hasVars(): bool
    {
        return !empty($this->varsNames);
    }
}