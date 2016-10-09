<?php

/**
 * @author Alireza Josheghani <a.josheghani@anetwork.ir>
 * @version 1.0
 * @package SideNav
 * @since 19 Sep 2016
 * SideNav main class
 */

namespace Anetwork\SideNav;

class SideNav
{

    // use Sidenav helper methods in class
    use SideNavHelpers;

    // group route
    protected static $group;

    // current position of route
    protected static $currentRoute;

    // the item url
    protected static $url;

    // all routes-name registered
    protected static $routes = [];

    // instance of check status object
    protected static $checkStatusObject = [];

    // status of navigation
    protected static $status = false;

    // render array
    protected static $menu = [];

    /**
     * Define checkstatus object
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  19 Sep 2016
     * @param  $class
     */
    public static function checkStatusObject($class,$method)
    {
        self::$checkStatusObject = [
            'object' => $class,
            'method' => $method
        ];
    }

    /**
     * Make the SideNav group
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  19 Sep 2016
     * @param  $group
     * @param  $callback
     */
    public static function group($group, $callback)
    {
        // set group menu name
        self::$group = $group;

        // set group menu
        self::$menu[$group] = [];

        // run callback function
        $callback();
    }

    /**
     * Register a new menu item
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  19 Sep 2016
     * @param  $route
     * @param  $callback
     */
    public static function register($route, $callback)
    {
        // set current route
        self::$currentRoute = $route;

        // register route
        self::$routes[self::$currentRoute] = [];

        // make menu array
        $array = self::add($route, $callback);

        if (self::checkGroupId(self::$group)) {
            // add to the group render array
            array_push(self::$menu[self::$group], $array);
        }

        // add to the single render array
        array_push(self::$menu, $array);
    }

    /**
     * Register a new menu item
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  19 Sep 2016
     * @param  $route
     * @param  $callback
     * @param  $checkCallback
     */
    public static function registerWithCheck($route , $callback , $checkCallback = null)
    {
        // check status of route
        if (self::checkStatus($route, $checkCallback)) {
            self::register($route, $callback);
        }
    }

    /**
     * Add the submenu to item
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  19 Sep 2016
     * @param  $route
     * @param  $callback
     * @return array
     */
    public static function addSub($route, $callback)
    {
        // register route name
        array_push(self::$routes[self::$currentRoute], $route);

        // return submenu array
        return self::add($route, $callback);
    }

    /**
     * Add the menu item
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  19 Sep 2016
     * @param  $route
     * @param  $callback
     * @return array
     */
    private static function add($route,$callback)
    {
        // instance of menu class
        $menu = new Menu;

        // run callback function
        $callback($menu);

        // Make the menu object array
        return $menu->make($route);
    }

    /**
     * Get all routes
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  19 Sep 2016
     * @return array
     */
    public static function routes($index = null)
    {
        if($index !== null) {
            return self::$routes[$index];
        }

        // return array of all routes-name
        return self::$routes;
    }


    /**
     * Render the menu items
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  19 Sep 2016
     * @return mixed
     */
    public static function render($type = null)
    {
        // return single menu array
        return self::$menu;
    }

    /**
     * Check group id
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  19 Sep 2016
     * @return bool
     */
    public static function checkGroupId($type)
    {
        if($type !== null && isset(self::$group)) {
            return true;
        }

        return false;
    }

    /**
     * Check user status
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  19 Sep 2016
     * @param  $route
     * @param  $callback
     * @return bool
     */
    public static function checkStatus($route,$callback = false)
    {
        if ($callback instanceof \Closure) {
            if ($callback()) {
                return true;
            }
        }

        // check status class name
        $obj = self::$checkStatusObject['object'];

        // check status method name
        $method = self::$checkStatusObject['method'];

        if(class_exists($obj)) {
            // instance of class
            $class = new $obj;

            // call method of class
            if ($class->$method($route)) {
                return true;
            }
            return false;
        } else {
            throw new \Exception("The CheckStatus class not found !");
        }
    }

}
