<?php

namespace VFram;

use DirectoryIterator;
use Doctrine\Common\Annotations\AnnotationReader;
use VFram\HTTP\Request;
use VFram\HTTP\Response;
use ReflectionClass;
use ReflectionException;
use VFram\Routing\Route as Route;
use VFram\Routing\Router;
use VFram\Utils\AnnotationsLoader;
use VFram\Utils\Exceptions\NoRouteFoundException;

abstract class Application
{
    public Request $request;
    public Response $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();

        AnnotationsLoader::loadAnnotations(); // Required because Doctrine doesn't use php autoloader
    }

    public function getController(): AbstractController
    {
        $router = new Router;

        // Annotations Parser
        foreach (new DirectoryIterator(__DIR__ . "/../../src/Controller/") as $file) {
            // Suppressing hidden files
            if (strpos($file->getFilename(), ".") !== 0) {
                try {
                    $class = new ReflectionClass('App\\Controller\\' . basename($file->getPathname(), ".php"));
                    $parentClass = new ReflectionClass('VFram\\AbstractController');

                    foreach ($class->getMethods() as $method) {
                        // Suppressing inherited methods
                        if (!in_array($method, $parentClass->getMethods())) {
                            $reader = new AnnotationReader();

                            $annotation = $reader->getMethodAnnotation($method, 'VFram\\Routing\\Annotations\\Route');

                            $path = $annotation->path;
                            $requirements = $annotation->requirements;

                            preg_match_all("#{([a-z]+)}#", $path, $args);
                            $argsNames = $args[1];
                            $args = $args[0];

                            $values = [];
                            foreach ($argsNames as $argName) {
                                $requirement = isset($requirements[$argName]) ? '(' . $requirements[$argName] . ')' : "(.+)";

                                $values[] = $requirement;
                            }

                            for ($i = 0; $i < count($args); $i++) {
                                $args[$i] = '#' . $args[$i] . '#';
                            }

                            $path = preg_replace($args, $values, $path);

                            $route = new Route($path, $class->getName(), $method->getName(), $argsNames);

                            $router->addRoute($route);
                        }
                    }
                } catch (ReflectionException $ignored) {
                }
            }
        }

        // TODO : XML Parser

        try {
            $matchedRoute = $router->getRoute($this->request->getURI());

            $_GET = array_merge($_GET, $matchedRoute->getVars());

            $controllerClass = $matchedRoute->getController();

            return new $controllerClass($this, $matchedRoute->getAction());
        } catch (NoRouteFoundException $e) {
            echo $e;
            $this->response->redirect404();
        }

        return null;
    }

    public abstract function run(): void;
}