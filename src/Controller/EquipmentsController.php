<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 15:45
 */

namespace Controller;

use Core\Response\EmptyResource;
use Core\Response\RedirectResponse;
use Core\Response\Response;
use Core\Request\Request;
use Core\Response\TemplateResource;
use Form\EquipmentForm;
use Model\EquipmentModel;

class EquipmentsController
{
    /**
     * @var EquipmentModel
     */
    private $equipmentModel;

    public function __construct(EquipmentModel $equipment)
    {
        $this->equipmentModel = $equipment;
    }

    public function list(/* Request $request */)
    {
        $equipments = $this->equipmentModel->getList();
        $path = __DIR__.'/../../app/view/Equipments/list.php';
        return new Response(new TemplateResource($path, ['equipments' => $equipments]));
    }

    /**
     * @return EquipmentModel
     */
    public function create(Request $request)
    {
        $form = new EquipmentForm($this->equipmentModel);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                print_r($form->getViolations());
                $this->equipmentModel->create($form->getData());
                return new RedirectResponse('/equipments');
            }
        }
        $path = __DIR__.'/../../app/view/Equipments/create.php';

        return new Response(new TemplateResource($path, ['form' => $form]));
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $equipment = $this->equipmentModel->getEquipment($id);
        if($equipment === null){
            throw new \Exception('Equipment not found');
        }
        $form = new EquipmentForm($this->equipmentModel, $equipment );
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->equipmentModel->edit($form->getData(), $id);

                return new RedirectResponse('/equipments');
            }
        }
        $path = __DIR__.'/../../app/view/Equipments/create.php';

        return new Response(new TemplateResource($path, ['form' => $form, 'equipment' => $equipment]));
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $this->equipmentModel->delete($id);
        return new RedirectResponse('/equipments');
    }
}
