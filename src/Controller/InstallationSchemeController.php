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
use Model\EquipmentModel;
use Model\InstallationSchemeModel;
use Model\RoomModel;

class InstallationSchemeController
{
    /**
     * @var InstallationSchemeModel
     */
    private $schemeModel;
    /**
     * @var RoomModel
     */
    private $roomModel;
    /**
     * @var EquipmentModel
     */
    private $equipmentModel;


    public function __construct(InstallationSchemeModel $schemeModel, RoomModel $roomModel, EquipmentModel $equipmentModel)
    {
        $this->schemeModel = $schemeModel;
        $this->roomModel = $roomModel;
        $this->equipmentModel = $equipmentModel;
    }

    public function list(/* Request $request */)
    {
        $schems = $this->schemeModel->getList();
        $path = __DIR__.'/../../app/view/InstallationScheme/list.php';
        return new Response(new TemplateResource($path, ['schems' => $schems]));
    }

    /**
     * @return InstallationSchemeModel
     */
    public function create(Request $request)
    {
        $form = new InstallationSchemeForm($this->schemeModel);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                print_r($form->getViolations());
                $this->schemeModel->create($form->getData());
                return new RedirectResponse('/app.php/installation_scheme');
            }
        }
        $path = __DIR__.'/../../app/view/InstallationScheme/create.php';

        $rooms = $this->roomModel->getRooms();
        $equipments = $this->equipmentModel->getEquipments();
        return new Response(new TemplateResource($path, ['form' => $form, 'rooms' => $rooms , 'equipments' => $equipments]));
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $scheme = $this->schemeModel->getScheme($id);
        if($scheme === null){
            throw new \Exception('Scheme not found');
        }
        $form = new InstallationSchemeForm($this->schemeModel, $scheme );
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->schemeModel->edit($form->getData(), $id);

                return new RedirectResponse('/app.php/installation_scheme');
            }
        }
        $path = __DIR__.'/../../app/view/InstallationScheme/create.php';

        $rooms = $this->roomModel->getRooms();
        $equipments = $this->equipmentModel->getEquipments();
        return new Response(new TemplateResource($path, ['form' => $form,'scheme' => $scheme, 'rooms' => $rooms , 'equipments' => $equipments]));
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $this->schemeModel->delete($id);
        return new RedirectResponse('/app.php/installation_scheme');
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');
        $this->schemeModel->changeStatus($id,$status);
        return new RedirectResponse('/app.php/installation_scheme');
    }
}