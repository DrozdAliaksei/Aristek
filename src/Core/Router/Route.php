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
     *
     * @param string $path
     * @param string $controllerClass
     * @param string $method
     * @param array  $rules
     *
     * @throws \Exception
     */
    public function __construct(string $path, string $controllerClass, string $method, array $rules = [])
    {

        $this->path = $path;
        $this->controllerClass = $controllerClass;
        $this->method = $method;
        $this->rules = $this->prepareRules($rules, $path);
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

    /**
     * @param string $path
     *
     * @return bool
     */
    public function match(string $path): bool
    {
        return preg_match($this->pattern, $path);
    }

    public function getPathValues(string $path): array
    {
        $values = [];
        preg_match($this->pattern, $path, $matches);
        if(count($matches) > 1){
            array_shift($matches);
            $values = array_combine(array_keys($this->rules),$matches) ;
        }
        //echo json_encode(['values'=>$values, 'rules' => $this->rules, 'matches'=> $matches]);
        return $values;
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

    private function prepareRules(array $rules, string $path)
    {
        $gaps = [];
        if (preg_match_all('#\{(\w+)\}#', $path, $matches)) {
            $gaps = $matches[1];
        }
        if (array_diff(array_keys($rules), $gaps)) {
            throw new \Exception('Invalid route rules configuration');
        }
        return array_merge( array_fill_keys($gaps,'\w+'),$rules);

    }
}