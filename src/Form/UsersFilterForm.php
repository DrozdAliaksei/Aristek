<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 6.3.19
 * Time: 14.13
 */

namespace Form;

use Core\Request\Request;
use Model\UserModel;

class UsersFilterForm
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $violations = [];

    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * FilterForm constructor.
     *
     * @param UserModel $userModel
     */
    public function __construct(UserModel $userModel)
    {

        $this->data = [
            'page'      => ['limit' => 5, 'offset' => 0, 'current_page' => 1],
            'filter'    => ['login' => null, 'role' => null],
            'order_dir' => 'asc',
            'order_by'  => 'login',

        ];

        $this->userModel = $userModel;
    }

    public function handleRequest(Request $request)
    {
        $this->data['page'] = array_merge($this->data['page'], (array) $request->get('page', []));
        $this->data['filter'] = array_merge($this->data['filter'], $request->get('filter', []));
        $this->data['order_dir'] = $request->get('order_dir', 'asc');
        $this->data['order_by'] = $request->get('order_by', 'login');
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getViolations(): array
    {
        return $this->violations;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return count($this->violations) === 0;
    }
}