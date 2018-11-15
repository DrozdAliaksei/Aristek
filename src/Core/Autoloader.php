<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 14.11.18
 * Time: 17:08
 */

namespace Core;

class Autoloader
{
    /**
     * @var array
     */
    private $dirs;

    /**
     * Autoloader constructor.
     */
    public function __construct(array $dirs)
    {

        $this->dirs = $dirs;
    }

    public function load(string $class){
        $subPath = str_replace('\\' , DIRECTORY_SEPARATOR, $class);
        foreach ($this->dirs as $dir){
            $path = sprintf('%s/%s.php',$dir,$subPath);
            if(file_exists($path)){
                require_once $path;
                break;
            }
        }
    }
}