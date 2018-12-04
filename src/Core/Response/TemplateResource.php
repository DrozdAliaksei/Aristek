<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 28.11.18
 * Time: 17:28
 */

namespace Core\Response;


class TemplateResource implements ResourceInterface
{
    /**
     * @var string
     */
    private $template;
    /**
     * @var array
     */
    private $data;


    /**
     * TemplateResource constructor.
     */
    public function __construct(string $template, array $data =[])
    {

        $this->template = $template;
        $this->data = $data;
    }

    public function getContent()
    {
        ob_start();
        require $this->template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

}