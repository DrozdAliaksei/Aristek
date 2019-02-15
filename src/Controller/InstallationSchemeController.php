<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 16:29
 */

namespace Controller;

use Core\Response\RedirectResponse;
use Core\Response\Response;
use Core\Request\Request;
use Core\Template\Renderer;
use Form\InstallationSchemeForm;
use Model\EquipmentModel;
use Model\InstallationSchemeModel;
use Model\RoomModel;
use Service\SecurityService;

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
    /**
     * @var SecurityService
     */
    private $securityService;

    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * InstallationSchemeController constructor.
     *
     * @param InstallationSchemeModel $schemeModel
     * @param RoomModel               $roomModel
     * @param EquipmentModel          $equipmentModel
     * @param SecurityService         $securityService
     * @param Renderer                $renderer
     */
    public function __construct(
        InstallationSchemeModel $schemeModel,
        RoomModel $roomModel,
        EquipmentModel $equipmentModel,
        SecurityService $securityService,
        Renderer $renderer
    ) {
        $this->schemeModel = $schemeModel;
        $this->roomModel = $roomModel;
        $this->equipmentModel = $equipmentModel;
        $this->securityService = $securityService;
        $this->renderer = $renderer;
    }

    /**
     * @return Response
     */
    public function list(/* Request $request */): Response
    {
        $roles = $this->securityService->getRoles();
        $schems = $this->schemeModel->getSchemesAvailableToRoles($roles);
        $path = 'InstallationScheme/list.php';

        return new Response($this->renderer->render($path, ['schems' => $schems]));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function create(Request $request)
    {
        $form = new InstallationSchemeForm($this->schemeModel);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->schemeModel->create($form->getData());

                return new RedirectResponse('/installation_scheme');
            }
        }
        $path = 'InstallationScheme/create.php';

        $rooms = $this->roomModel->getRooms();
        $equipments = $this->equipmentModel->getEquipments();

        return new Response(
            $this->renderer->render($path, ['form' => $form, 'rooms' => $rooms, 'equipments' => $equipments])
        );
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
        $scheme = $this->schemeModel->getScheme($id);
        if ($scheme === null) {
            throw new \RuntimeException('Scheme not found');
        }
        $form = new InstallationSchemeForm($this->schemeModel, $scheme);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->schemeModel->edit($form->getData(), $id);

                return new RedirectResponse('/installation_scheme');
            }
        }
        $path = 'InstallationScheme/create.php';

        $rooms = $this->roomModel->getRooms();
        $equipments = $this->equipmentModel->getEquipments();

        return new Response(
            $this->renderer->render(
                $path,
                ['form' => $form, 'scheme' => $scheme, 'rooms' => $rooms, 'equipments' => $equipments]
            )
        );
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        $this->schemeModel->delete($id);

        return new RedirectResponse('/installation_scheme');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function changeStatus(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        $status = $request->get('status');

        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $this->schemeModel->changeStatus($id, $status);

        return new RedirectResponse('/installation_scheme');
    }
}