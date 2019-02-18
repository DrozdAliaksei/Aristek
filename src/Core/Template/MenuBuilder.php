<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 30.01.19
 * Time: 18:15
 */

namespace Core\Template;

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
        $role = $this->securityService->getRoles();

        if (in_array('admin', $role, true)) {
            return $this->menu;
        }

        foreach ($this->menu as $menuItem){
            $access = array_intersect($role,$menuItem['roles']);
            if(count($access)>0){
                $userMenu[]=['url' => $menuItem['url'], 'title' => $menuItem['title']];
            }
        }

        return $userMenu;
    }
}