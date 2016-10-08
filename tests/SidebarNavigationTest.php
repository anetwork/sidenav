<?php

/**
 * Sidebar Navigation UnitTest
 * @author Alireza Josheghani <a.josheghani@anetwork.ir>
 * @since 24 Sep 2016
 */

use Anetwork\SideNav\Menu;
use Anetwork\SideNav\SideNav;

class SidebarNavigationTest extends PHPUnit_Framework_TestCase {

    // instance of sidenav class
    protected $sidenav;

    // route name
    protected $route;

    // submenu name
    protected $subMenu;

    // route menu options callback
    protected $callback;

    // results of menu array
    protected $results;


    /**
     * SidebarNavigationTest constructor.
     */
    public function __construct()
    {
        // call parent construct
        parent::__construct();

        // make instance of SideNav Object
        $this->sidenav = new SideNav;
    }


    /**
     * Register a menu item
     */
    public function registerMenu()
    {
        // route name
        $this->route = "home_page";

        $this->subMenu = "user_profile";

        $this->callback = function (Menu $menu) {

            $menu->link('/home');

            $menu->icon('fa fa-dashboard');

            $menu->newTab(true);

            $menu->title('Dashboard');

            $menu->sub($this->subMenu, function (Menu $menu) {
                $menu->link('/user/profile');
                $menu->icon('fa fa-user');
            });

        };

        $this->sidenav->register($this->route, $this->callback);
    }

    /**
     * Register a new menu item with group
     */
    public function registerMenuGroup()
    {
        // set group
        $this->sidenav->group('user',function (){

            $this->registerMenu();

        });
    }

    /**
     * Check menu has been registered
     */
    public function testRegistered()
    {
        // register a random menu item
        $this->registerMenu();

        // Check menu has been registered
        $this->assertArrayHasKey($this->route,$this->sidenav->routes());

    }

    /**
     * check registered sub menu to item
     */
    public function testRegisteredSubMenu()
    {

        // register a random menu item
        $this->registerMenu();

        // Check menu has been registered
        $this->assertEquals($this->subMenu,$this->sidenav->routes()[$this->route][0]);

    }

    /**
     * Check item has not class name option
     */
    public function testItemHasNotClassNameOption()
    {
        // register a random menu item
        $this->registerMenu();

        // Check menu has not class name option
        $this->assertEmpty($this->sidenav->render()[0]['class']);
    }

    /**
     * check menu has json type
     */
    public function testJsonRender()
    {
        // register a random menu item
        $this->registerMenu();

        // Check menu has json type
        $this->assertJson($this->sidenav->type('json')->render());
    }


    /**
     * Check group item has been registered
     */
    public function testRegisterGroup()
    {
        // register a random menu item
        $this->registerMenuGroup();

        // check group item has been registered
        $this->assertArrayHasKey('user',$this->sidenav->type('array')->render());
    }

    /**
     * check render group menu has registered item
     */
    public function testGroupHasRegisteredItem()
    {
        // register a random menu item
        $this->registerMenuGroup();

        // check render group menu has registered item
        $this->assertEquals($this->route,$this->sidenav->type('array')->render('user')[0]['name']);

    }

}