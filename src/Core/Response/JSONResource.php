<?php


namespace Core\Response;


class JSONResource implements ResourceInterface
{
    /**
     * @var array|string
     */
    private $data;

    /**
     * JSONResource constructor.
     * @param array|string $data
     */
    public function __construct(string $key, $data)
    {
        $this->data = json_encode(["$key" => $data]);
    }


    public function getContent()
    {
        ob_start();
        echo $this->data;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}