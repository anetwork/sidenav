<?php

/**
 * Sidebar Navigation UnitTest
 *
 * @author Alireza Josheghani <a.josheghani@anetwork.ir>
 * @since  24 Sep 2016
 */

use Anetwork\SideNav\SideNav;

class SidebarNavigationTest extends PHPUnit_Framework_TestCase
{
    // route name
    protected $route;

    // submenu name
    protected $subMenu;

    // route menu options callback
    protected $callback;

    public function __construct()
    {
        // route name
        $this->route = "home_page";

        $this->subMenu = "user_profile";

        $this->callback = function ($menu) {

            $menu->link('/home');

            $menu->icon('fa fa-dashboard');

            $menu->newTab(true);

            $menu->title('Dashboard');

            $menu->sub(
                $this->subMenu, function ($menu) {
                    $menu->link('/user/profile');
                    $menu->icon('fa fa-user');
                }
            );

        };
    }

    /**
     * Register a menu item
     */
    public function registerMenu()
    {
        SideNav::register($this->route, $this->callback);
    }

    /**
     * Register a new menu item with group
     */
    public function registerMenuGroup()
    {
        // set group
        SideNav::group(
            'user', function () {
                $this->registerMenu();
            }
        );
    }

    /**
     * Check menu has been registered
     */
    public function testRegistered()
    {
        $this->registerMenu();

        // Check menu has been registered
        $this->assertArrayHasKey($this->route, SideNav::routes());

    }

    /**
     * check registered sub menu to item
     */
    public function testRegisteredSubMenu()
    {
        // Check menu has been registered
        $this->assertEquals($this->subMenu, SideNav::routes($this->route)[0]);
    }

    /**
     * Check item has not class name option
     */
    public function testItemHasNotClassNameOption()
    {
        $result = SideNav::render();

        // Check menu has not class name option
        $this->assertEmpty($result[0]['class']);
    }


    /**
     * Check group item has been registered
     */
    public function testRegisterGroup()
    {
        $this->registerMenuGroup();

        // check group item has been registered
        $this->assertArrayHasKey('user', SideNav::render());
    }

    /**
     * check render group menu has registered item
     */
    public function testGroupHasRegisteredItem()
    {
        // check render group menu has registered item
        $this->assertEquals($this->route, SideNav::render('user')[0]['name']);

    }

}
