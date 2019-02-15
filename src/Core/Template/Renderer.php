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

    /**
     * @param string $path
     * @param array  $properties
     *
     * @return TemplateResource
     * @throws \Exception
     */
    public function render(string $path, array $properties)
    {
        $properties['menu'] = $this->menuBuilder->createMenu();
        return new TemplateResource($this->getRealPath($path),$properties);
    }

    /**
     * @param $path
     *
     * @return string
     * @throws \Exception
     */
    private function getRealPath($path) : string
    {
        $realPath = $this->viewDir.'/'.$path;
        if(!file_exists($realPath)){
            throw new \RuntimeException(sprintf('Template %s is not found', $path));
        }
        return $realPath;
    }
}