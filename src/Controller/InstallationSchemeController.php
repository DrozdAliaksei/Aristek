<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 16:29
 */

namespace Controller;

use Core\HTTP\Exception\NotFoundException;
use Core\MessageBag;
use Core\Response\JSONResource;
use Core\Response\JsonResponse;
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
     * @var MessageBag
     */
    private $messageBag;

    /**
     * InstallationSchemeController constructor.
     *
     * @param InstallationSchemeModel $schemeModel
     * @param RoomModel               $roomModel
     * @param EquipmentModel          $equipmentModel
     * @param SecurityService         $securityService
     * @param Renderer                $renderer
     * @param MessageBag              $messageBag
     */
    public function __construct(
        InstallationSchemeModel $schemeModel,
        RoomModel $roomModel,
        EquipmentModel $equipmentModel,
        SecurityService $securityService,
        Renderer $renderer,
        MessageBag $messageBag
    ) {
        $this->schemeModel = $schemeModel;
        $this->roomModel = $roomModel;
        $this->equipmentModel = $equipmentModel;
        $this->securityService = $securityService;
        $this->renderer = $renderer;
        $this->messageBag = $messageBag;
    }

    /**
     * @return Response
     */
    public function list(/* Request $request */): Response
    {
        $role = $this->securityService->getRole();
        $schems = $this->schemeModel->getSchemesAvailableToRoles($role); //TODO rewrite for one role
        $path = 'InstallationScheme/list.php';

        return new Response($this->renderer->render($path, ['schems' => $schems, 'role' => $role]));
    }

    /**
     * @return Response
     */
    public function listM(/* Request $request */): Response
    {
        $role = $this->securityService->getRole();
        $schems = $this->schemeModel->getSchemesAvailableToRoles($role);

        return new Response(new JSONResource('schemes',$schems));
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
                $this->messageBag->addMessage('Scheme created');

                return new RedirectResponse('/installation-scheme');
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
            throw new NotFoundException('Scheme not found');
        }
        $form = new InstallationSchemeForm($this->schemeModel, $scheme);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->schemeModel->edit($form->getData(), $id);
                $this->messageBag->addMessage('Scheme updated');

                return new RedirectResponse('/installation-scheme');
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
        $scheme = $this->schemeModel->getScheme($id);
        if ($scheme === null) {
            throw new NotFoundException('Scheme not found');
        }
        $this->schemeModel->delete($id);
        $this->messageBag->addMessage('Scheme deleted');

        return new RedirectResponse('/installation-scheme');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function changeStatus(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        $scheme = $this->schemeModel->getScheme($id);
        if ($scheme === null) {
            throw new NotFoundException('Scheme not found');
        }
        $status = $request->get('status');

        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $this->schemeModel->changeStatus($id, $status);

        return new RedirectResponse('/installation-scheme');
    }

    public function changeStatusMob(Request $request)
    {
        $id = $request->get('id');
        $scheme = $this->schemeModel->getScheme($id);
        if ($scheme === null) {
            throw new NotFoundException('Scheme not found');
        }
        $status = $request->get('status');

        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $this->schemeModel->changeStatus($id, $status);
        $status = $this->schemeModel->getSchemeStatus($id);
        return new Response(new JSONResource('controller',$status));
    }
}