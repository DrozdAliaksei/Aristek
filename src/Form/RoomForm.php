<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 13:52
 */

namespace Form;

use Core\Request\Request;
use Model\RoomModel;

class RoomForm
{

    private $data;
    private $violations = [];
    private $roomModel;

    /**
     * RoomForm constructor.
     * @param RoomModel $userModel
     * @param array $room
     */
    public function __construct(RoomModel $roomModel,array $data =[])
    {
        $this->data = $data;
        $this->roomModel = $roomModel;
    }

    public function handleRequest(Request $request)
    {

        $this->data['name'] = $request->get('name');
        $this->data['description'] = $request->get('description');

        $id = $this->data['id'] ?? null;
        if ($this->roomModel->checkName($this->data['name'], $id)) {
            $this->violations['name'] = 'Such name exists';
        }
        if (strlen($this->data['description']) < 5) {
            $this->violations['description'] = 'Description is too short';
        }
    }

    /**
     * @return array
     */
    public function getViolations(): array
    {
        return $this->violations;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function isValid()
    {
        //TODO проверить был ли обработан handlerequest
        return count($this->violations) === 0;
    }

}