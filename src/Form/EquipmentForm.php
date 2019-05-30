<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 15:49
 */

namespace Form;

use Core\Request\Request;
use Model\EquipmentModel;

class EquipmentForm
{
    private $data;

    private $violations = [];

    private $equipmentModel;

    /**
     * RoomForm constructor.
     *
     * @param EquipmentModel $equipmentModel
     * @param array          $data
     */
    public function __construct(EquipmentModel $equipmentModel, array $data = [])
    {
        $this->data = $data;
        $this->equipmentModel = $equipmentModel;
    }

    /**
     * @param Request $request
     */
    public function handleRequest(Request $request)
    {

        $this->data['name'] = $request->get('name');
        $this->data['description'] = $request->get('description');
        $this->data['BCM_GPIO'] = $request->get('gpio');

        $id = $this->data['id'] ?? null;
        if ($this->equipmentModel->checkName($this->data['name'], $id)) {
            $this->violations['name'] = 'Such name exists';
        }
        if (strlen($this->data['description']) < 3) {
            $this->violations['description'] = 'Description is too short';
        }
        if($this->data['BCM_GPIO'] < 0 || $this->data['BCM_GPIO'] > 40){
            $this->violations['BCM_GPIO'] = 'Wrong GPIO number';
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

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return count($this->violations) === 0;
    }
}