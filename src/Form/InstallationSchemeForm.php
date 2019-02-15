<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 17:16
 */

namespace Form;

use Core\Request\Request;
use Enum\RolesEnum;
use Model\InstallationSchemeModel;

class InstallationSchemeForm
{
    private $data;

    private $violations = [];

    private $schemeModel;

    /**
     * UserForm constructor.
     *
     * @param InstallationSchemeModel $schemeModel
     * @param array                   $data
     */
    public function __construct(InstallationSchemeModel $schemeModel, array $data = [])
    {
        $this->schemeModel = $schemeModel;
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getViolations(): array
    {
        return $this->violations;
    }

    /**
     * @return InstallationSchemeModel
     */
    public function getModel(): InstallationSchemeModel
    {
        return $this->schemeModel;
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

    /**
     * @param Request $request
     */
    public function handleRequest(Request $request)
    {

        $this->data['room_id'] = $request->get('room_id');
        $this->data['equipment_id'] = $request->get('equipment_id');
        $this->data['displayable_name'] = $request->get('displayable_name');
        $this->data['status'] = $request->get('status');
        $this->data['role'] = (array) $request->get('role', []);

        $id = $this->data['id'] ?? null;
        if ($this->schemeModel->checkScheme($this->data['room_id'], $this->data['equipment_id'], $id)) {
            $this->violations['login'] = 'Such scheme exists';
        }
        if (strlen($this->data['displayable_name']) < 5) {
            $this->violations['displayable_name'] = 'Displayable name is too short';
        } elseif (strlen($this->data['displayable_name']) > 30) {
            $this->violations['displayable_name'] = 'Displayable name is too long';
        }
        if ($this->data['status'] != 0 && $this->data['status'] != 1) {
            $this->violations['status'] = 'Impossible status';
        }
        if (!$this->data['role']) {
            $this->violations['role'] = 'At least, one role is required';
        } elseif (array_diff($this->data['role'], RolesEnum::getAll())) {
            $this->violations['role'] = 'Invalid roles';
        }
    }
}