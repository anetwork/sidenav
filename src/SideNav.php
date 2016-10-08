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

    // group route
    protected static $type;

    // current position of route
    protected static $currentRoute;

    // the item url
    protected static $url;

    // all routes-name registered
    protected static $routes = [];

    // instance of check status object
    protected static $checkStatusObject;

    // status of navigation
    protected static $status = false;

    // render array
    protected static $menu = [];

    // set result render type
    public static $resultType = 'array';

    /**
     * Define checkstatus object
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 19 Sep 2016
     * @param $class
     */
    public static function checkStatusObject($class)
    {
        self::$checkStatusObject = $class;
    }

    /**
     * Make the SideNav group
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 19 Sep 2016
     * @param $type
     * @param $callback
     */
    public static function group($type, $callback)
    {
        // set group menu name
        self::$type = $type;

        // set group menu
        self::$menu[$type] = [];

        // run callback function
        $callback();
    }

    /**
     * Register a new menu item
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 19 Sep 2016
     * @param $route
     * @param $callback
     */
    public static function register($route, $callback)
    {
        // set current route
        self::$currentRoute = $route;

        // register route
        self::$routes[self::$currentRoute] = [];

        // make menu array
        $array = self::add($route,$callback);

        if (self::checkGroupId(self::$type))
            // add to the group render array
            array_push(self::$menu[self::$type], $array);

        // add to the single render array
        array_push(self::$menu, $array);
    }

    /**
     * Register a new menu item
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 19 Sep 2016
     * @param $route
     * @param $callback
     */
    public static function registerWithCheckStatus($route, $callback)
    {
        // check status of route
        if (self::checkStatus($route))
        {
            // register menu
            self::register($route, $callback);
        }
    }

    /**
     * Add the submenu to item
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 19 Sep 2016
     * @param $route
     * @param $callback
     * @return array
     */
    public static function addSub($route, $callback)
    {
        // register route name
        array_push(self::$routes[self::$currentRoute],$route);

        // return submenu array
        return self::add($route,$callback);
    }

    /**
     * Add the menu item
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 19 Sep 2016
     * @param $route
     * @param $callback
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
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 19 Sep 2016
     * @return array
     */
    public static function routes()
    {
        // return json array of all routes-name
        if(self::$resultType === 'json')
            return json_encode(self::$routes);

        // return array of all routes-name
        return self::$routes;
    }

    /**
     * set render type
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @param $type
     * @return SideNav
     */
    public static function type($type)
    {
        self::$resultType = $type;
        return new self;
    }

    /**
     * Render the menu items
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 19 Sep 2016
     * @return mixed
     */
    public static function render($type = null)
    {
        if(self::checkGroupId($type))
        {

            // render the menu json array
            if(self::$resultType === 'json')
                return json_encode(self::$menu[$type]);

            // render the menu array
            return self::$menu[$type];
        }

        // return single menu json array
        if(self::$resultType === 'json')
            return json_encode(self::$menu);

        // return single menu array
        return self::$menu;
    }

    /**
     * Check group id
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 19 Sep 2016
     * @return bool
     */
    public static function checkGroupId($type)
    {
        if($type !== null && isset(self::$type))
            return true;

        return false;
    }

    /**
     * Check user status
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 19 Sep 2016
     * @param $route
     * @return bool
     */
    public static function checkStatus($route)
    {
        $obj = self::$checkStatusObject;

        if(class_exists($obj))
        {
            $class = new $obj;
            if ($class->handle($route))
                return true;
            return false;
        } else {
            throw new \Exception("The CheckStatus class not found ! You must have a CheckStatus class.");
        }
    }

}
