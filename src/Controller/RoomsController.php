<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:43
 */

namespace Controller;

use Core\Response\EmptyResource;
use Core\Response\RedirectResponse;
use Core\Response\Response;
use Core\Request\Request;
use Core\Response\TemplateResource;
use Form\RoomForm;
use Model\RoomModel;


class RoomsController
{
    /**
     * @var RoomModel
     */
    private $roomModel;

    public function __construct(RoomModel $room)
    {
        $this->roomModel = $room;
    }

    public function list(/* Request $request */)
    {
        $rooms = $this->roomModel->getList();
        $path = __DIR__.'/../../app/view/Rooms/list.php';
        return new Response(new TemplateResource($path, ['rooms' => $rooms]));
    }

    /**
     * @return RoomModel
     */
    public function create(Request $request)
    {
        $form = new RoomForm($this->roomModel);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                print_r($form->getViolations());
                $this->roomModel->create($form->getData());
                return new RedirectResponse('/app.php/rooms');
            }
        }
        $path = __DIR__.'/../../app/view/Rooms/create.php';

        return new Response(new TemplateResource($path, ['form' => $form]));
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $room = $this->roomModel->getRoom($id);
        if($room === null){
            throw new \Exception('Room not found');
        }
        $form = new RoomForm($this->roomModel, $room );
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->roomModel->edit($form->getData(), $id);

                return new RedirectResponse('/app.php/rooms');
            }
        }
        $path = __DIR__.'/../../app/view/Rooms/create.php';

        return new Response(new TemplateResource($path, ['form' => $form, 'room' => $room]));
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
 //TODO throw exception if useer not exist
        $this->roomModel->delete($id);
        return new RedirectResponse('/app.php/rooms');
    }
}