<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 30.01.19
 * Time: 18:03
 */

namespace Core\Template;

use Core\Response\TemplateResource;

class Renderer
{
    /**
     * @var string
     */
    private $viewDir;

    /**
     * @var MenuBuilder
     */
    private $menuBuilder;

    /**
     * Rederer constructor.
     *
     * @param string      $viewDir
     * @param MenuBuilder $menuBuilder
     */
    public function __construct(string $viewDir , MenuBuilder $menuBuilder)
    {
        $this->viewDir = $viewDir;
        $this->menuBuilder = $menuBuilder;
    }

    public function render(string $path, array $properties)
    {
        return new TemplateResource($this->getRealPath($path),$properties);
    }

    private function getRealPath($path) : string
    {
        $realPath = $this->viewDir.'/'.$path;
        if(!file_exists($realPath)){
            throw new \Exception(sprintf('Template %s is not found', $path));
        }
        return $realPath;
    }
}