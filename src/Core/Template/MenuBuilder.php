<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 30.01.19
 * Time: 18:15
 */

namespace Core\Template;

use Enum\RolesEnum;
use Service\SecurityService;

class MenuBuilder
{
    /**
     * @var array
     */
    private $menu;

    /**
     * @var SecurityService
     */
    private $securityService;

    /**
     * MenuBuilder constructor.
     *
     * @param array           $menu
     * @param SecurityService $securityService
     */
    public function __construct(array $menu, SecurityService $securityService)
    {
        $this->menu = $menu;
        $this->securityService = $securityService;
    }

    /**
     * @return Menu
     */
    public function createMenu(): Menu
    {
        return new Menu($this->getItems());
    }

    /**
     * @return array
     */
    private function getItems() : array
    {
        $userMenu = [];
        $role = $this->securityService->getRole();

        if (RolesEnum::ADMIN === $role) {
            return $this->menu;
        }

        foreach ($this->menu as $menuItem){
            if(in_array($role, $menuItem['roles'])){
                $userMenu[]=['url' => $menuItem['url'], 'title' => $menuItem['title']];
            }
        }

        return $userMenu;
    }
}