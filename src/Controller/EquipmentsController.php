<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 15:45
 */

namespace Controller;

use Core\Response\RedirectResponse;
use Core\Response\Response;
use Core\Request\Request;
use Core\Template\Renderer;
use Form\EquipmentForm;
use Model\EquipmentModel;

class EquipmentsController
{
    /**
     * @var EquipmentModel
     */
    private $equipmentModel;

    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * EquipmentsController constructor.
     *
     * @param EquipmentModel $equipment
     * @param Renderer       $renderer
     */
    public function __construct(EquipmentModel $equipment, Renderer $renderer)
    {
        $this->equipmentModel = $equipment;
        $this->renderer = $renderer;
    }

    /**
     * @return Response
     */
    public function list(/* Request $request */): Response
    {
        $equipments = $this->equipmentModel->getList();
        $path = 'Equipments/list.php';

        return new Response($this->renderer->render($path, ['equipments' => $equipments]));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $form = new EquipmentForm($this->equipmentModel);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->equipmentModel->create($form->getData());

                return new RedirectResponse('/equipments');
            }
        }
        $path = 'Equipments/create.php';

        return new Response($this->renderer->render($path, ['form' => $form]));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function edit(Request $request)
    {
        $id = $request->get('id');
        $equipment = $this->equipmentModel->getEquipment($id);
        if ($equipment === null) {
            throw new \RuntimeException('Equipment not found');
        }
        $form = new EquipmentForm($this->equipmentModel, $equipment);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->equipmentModel->edit($form->getData(), $id);

                return new RedirectResponse('/equipments');
            }
        }
        $path = 'Equipments/create.php';

        return new Response($this->renderer->render($path, ['form' => $form, 'equipment' => $equipment]));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        $this->equipmentModel->delete($id);

        return new RedirectResponse('/equipments');
    }
}
