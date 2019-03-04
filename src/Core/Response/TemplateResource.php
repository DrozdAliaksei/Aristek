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
     *
     * @param string $template
     * @param array  $data
     */
    public function __construct(string $template, array $data = [])
    {

        $this->template = $template;
        $this->data = $data;
    }

    /**
     * @return false|string
     */
    public function getContent()
    {
        ob_start();
        require $this->template;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    protected function getOrderLink(
        string $url,
        string $currentField = null,
        string $lastDir = null,
        int $limit = null,
        int $offset = null
    ) {//TODO reread rewrite soon
        $query = [];
        $lastField = null;
        $urlParts = parse_url($url);
        if (array_key_exists('query', $urlParts)) {
            parse_str($urlParts['query'], $query);
            $orderDir = $query['order_dir'] ?? null;
        }
        if ($field) {
            $query['order_by'] = $field;
            $query['order_dir'] = (strtolower($order) === 'asc' && $orderBy = $field) ? 'desc' : 'asc';
        }
        if($limit){
            if($limit>200){
                $limit = 200;
            }
            $query['limit'] = $limit;
        }

        $query['offset'] = $offset;
    }
}