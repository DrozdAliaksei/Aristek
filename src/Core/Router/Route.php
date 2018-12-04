<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:36
 */

namespace Core\Router;


class Route
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $controllerClass;
    /**
     * @var string
     */
    private $method;
    /**
     * @var array
     */
    private $rules;
    /**
     * @var string
     */
    private $pattern;

    /**
     * Route constructor.
     */
    public function __construct(string $path, string $controllerClass, string $method, array $rules = [])
    {

        $this->path = $path;
        $this->controllerClass = $controllerClass;
        $this->method = $method;
        $this->rules = $this->prepareRules($rules,$path);
        $this->pattern = $this->createPattern($path, $this->rules);
    }

    /**
     * @return string
     */
    public function getControllerClass(): string
    {
        return $this->controllerClass;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }


    public function match(string $path): bool
    {
        return preg_match($this->pattern, $path);
    }

    public function getPathValues(string $path): array
    {
        $matches = [];
        preg_match($this->pattern, $path, $matches);
        array_shift($matches);
        return array_values($matches);
    }

    private function createPattern(string $path, $rules): string
    {
        if ($rules) {
            $search = array_map(
                function ($key) {
                    return sprintf('{%s}', $key);
                },
                array_keys($rules)
            );
            $replace = array_map(
                function ($rule) {
                    return sprintf('(%s)', $rule);
                },
                array_values($rules)
            );
            $path = str_replace($search, $replace, $path);
        }
        return sprintf('~^%s$~', $path);
    }

    private function prepareRules(array $rules)
    {
        //TODo sort rules like in the path найти вхождения вхождения пробежаться и найти как они входят - если есть левые то выдать ошибкуу
        return $rules;
    }
}