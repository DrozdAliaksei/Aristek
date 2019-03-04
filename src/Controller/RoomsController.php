<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:43
 */

namespace Controller;

use Core\HTTP\Exception\NotFoundException;
use Core\MessageBag;
use Core\Response\RedirectResponse;
use Core\Response\Response;
use Core\Request\Request;
use Core\Template\Renderer;
use Form\RoomForm;
use Model\RoomModel;

class RoomsController
{
    /**
     * @var RoomModel
     */
    private $roomModel;

    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * @var MessageBag
     */
    private $messageBag;

    /**
     * RoomsController constructor.
     *
     * @param RoomModel  $room
     * @param Renderer   $renderer
     * @param MessageBag $messageBag
     */
    public function __construct(RoomModel $room, Renderer $renderer, MessageBag $messageBag)
    {
        $this->roomModel = $room;
        $this->renderer = $renderer;
        $this->messageBag = $messageBag;
    }

    /**
     * @return Response
     */
    public function list(/* Request $request */): Response
    {
        $rooms = $this->roomModel->getList();
        $path = 'Rooms/list.php';

        return new Response($this->renderer->render($path, ['rooms' => $rooms]));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function create(Request $request)
    {
        $form = new RoomForm($this->roomModel);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->roomModel->create($form->getData());
                $this->messageBag->addMessage('Room created');

                return new RedirectResponse('/rooms');
            }
        }
        $path = 'Rooms/create.php';

        return new Response($this->renderer->render($path, ['form' => $form]));
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $room = $this->roomModel->getRoom($id);
        if ($room === null) {
            throw new NotFoundException('Room not found');
        }
        $form = new RoomForm($this->roomModel, $room);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->roomModel->edit($form->getData(), $id);
                $this->messageBag->addMessage('Room updated');

                return new RedirectResponse('/rooms');
            }
        }
        $path = 'Rooms/create.php';

        return new Response($this->renderer->render($path, ['form' => $form, 'room' => $room]));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        $room = $this->roomModel->getRoom($id);
        if ($room === null) {
            throw new NotFoundException('Room not found');
        }
        $this->roomModel->delete($id);
        $this->messageBag->addMessage('Room deleted');

        return new RedirectResponse('/rooms');
    }
}