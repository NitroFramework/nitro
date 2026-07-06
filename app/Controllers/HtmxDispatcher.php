<?php

namespace App\Controllers;

use Nitro\Http\Controller\BaseController;
use Nitro\Http\Request;
use Nitro\Http\Response;
use ReflectionMethod;

class HtmxDispatcher extends BaseController
{
    private const CONTROLLER_NAMESPACE = 'App\\Controllers\\';

    public function dispatch(string $controller, string $method): Response
    {
        $instance = $this->resolveController($controller);
        $this->assertMethodCallable($instance, $method);

        $args   = $this->resolveArgs($instance, $method);
        $result = $instance->$method(...$args);

        return $result instanceof Response ? $result : Response::html($result);
    }

    private function resolveController(string $controller): object
    {
        $class = self::CONTROLLER_NAMESPACE . ucfirst($controller) . 'Controller';

        if (!class_exists($class)) {
            abort(404, "Controller [{$controller}] not found.");
        }

        return new $class();
    }

    private function assertMethodCallable(object $instance, string $method): void
    {
        if (!method_exists($instance, $method)) {
            abort(404, "Method [{$method}] not found on " . $instance::class);
        }

        if (!(new ReflectionMethod($instance, $method))->isPublic()) {
            abort(403, "Method [{$method}] is not public.");
        }
    }

    private function resolveArgs(object $instance, string $method): array
    {
        $args = [];

        foreach ((new ReflectionMethod($instance, $method))->getParameters() as $param) {
            $type = $param->getType()?->getName();

            $args[] = match (true) {
                $type === Request::class => $this->request(),
                $param->isOptional()            => $param->getDefaultValue(),
                default                         => null,
            };
        }

        return $args;
    }
}