<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 16:29
 */

namespace Controller;

use Core\Response\EmptyResource;
use Core\Response\RedirectResponse;
use Core\Response\Response;
use Core\Request\Request;
use Core\Response\TemplateResource;
use Form\InstallationSchemeForm;
use Model\InstallationSchemeModel;

class InstallationSchemeController
{
    /**
     * @var InstallationSchemeModel
     */
    private $schemeModel;

    public function __construct(InstallationSchemeModel $schemeModel)
    {
        $this->schemeModel = $schemeModel;
    }

    public function list(/* Request $request */)
    {
        $schems = $this->schemeModel->getList();
        $path = __DIR__.'/../../app/view/InstallationScheme/list.php';
        return new Response(new TemplateResource($path, ['schems' => $schems]));
    }

}