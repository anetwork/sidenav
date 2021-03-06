<?php

/**
 * SideNav Menu class
 *
 * @author Alireza Josheghani <a.josheghani@anetwork.ir>
 * @version 1.0
 * @package SideNav
 * @since 20 Sep 2016
 */

namespace Anetwork\SideNav;

class Menu
{
    /**
     * the route name
     *
     * @var string
     */
    private $route;

    /**
     * the title option
     *
     * @var string
     */
    private $title;

    /**
     * the url option
     *
     * @var array
     */
    private $link = [
        'new_tab' => false,
        'value' => null,
        'regex' => []
    ];

    /**
     * the class-name option
     *
     * @var string
     */
    private $className;

    /**
     * the icon option
     *
     * @var array
     */
    private $icon = [ 'tag' => 'i', 'value' => null ];

    /**
     * is_new icon option
     *
     * @var boolean
     */
    protected $isNew = false;

    /**
     * selected option
     *
     * @var boolean
     */
    protected $selected = false;

    /**
     * open child when item is active
     *
     * @var boolean
     */
    protected $openChildOnClick = true;

    /**
     * Set parent class attribute when child open
     *
     * @var boolean
     */
    protected $parentClassWhenChildOpen;

    /**
     * the sub menu
     *
     * @var array
     */
    protected $submenu = [];

    /**
     * Attach sub menu array
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  20 Sep 2016
     * @param  $route
     * @param  $callback
     */
    public function sub($route, $callback)
    {
        $sub = SideNav::addSub($route, $callback);
        array_push($this->submenu, $sub);
    }

    /**
     * Attach sub menu array with checking status of item
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  20 Sep 2016
     * @param  $route
     * @param  $callback
     * @param  $checkCallback
     */
    public function subWithCheck($route, $callback , $checkCallback)
    {
        if($checkCallback()) {
            $this->sub($route,$callback);
        }
    }

    /**
     * Set the icon option
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  20 Sep 2016
     * @param  $icon
     */
    public function icon($icon)
    {
        $this->icon['value'] = $icon;

        return $this;
    }

    /**
     * Set the icon tag option
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  20 Sep 2016
     * @param  $icon
     */
    public function tag($tag)
    {
        $this->icon['tag'] = $tag;

        return $this;
    }

    /**
     * Set the title option
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  20 Sep 2016
     * @param  $title
     */
    public function title($title)
    {
        $this->title = $title;
    }

    /**
     * Set parent class name when child open
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  29 Oct 2016
     * @param $class
     */
    public function parentClassWhenChildOpen($class)
    {
        $this->parentClassWhenChildOpen = $class;
    }

    /**
     * Set the class-name option
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  20 Sep 2016
     * @param  $class_name
     */
    public function className($className)
    {
        $this->className = $className;
    }

    /**
     * Set the newTab option
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  20 Sep 2016
     * @param  $newtab : boolean
     */
    public function newTab($newtab)
    {
        $this->link['new_tab'] = $newtab;
    }

    /**
     * Set route name
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  20 Sep 2016
     * @param  $route
     */
    public function routeName($route)
    {
        $this->route = $route;
    }

    /**
     * Set the link of menu
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  20 Sep 2016
     * @param  $link
     */
    public function link($link)
    {
        $this->link['value'] = $link;
    }

    /**
     * Set the regex link of menu
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  16 Oxt 2016
     * @param  array $regex
     */
    public function regex(array $regex)
    {
        $this->link['regex'] = $regex;
    }

    /**
     * Set target link of item
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  20 Sep 2016
     * @param  $isNew
     */
    public function isNew($isNew)
    {
        $this->isNew = $isNew;
    }

    /**
     * Set item is selected
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  20 Sep 2016
     * @param  $type
     */
    public function selected($type)
    {
        $this->selected = $type;
    }

    /**
     * Set open child when item is active
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  20 Sep 2016
     * @param  $type
     */
    public function openChildOnClick($type)
    {
        $this->openChildOnClick = $type;
    }

    /**
     * make the return item array
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  20 Sep 2016
     * @return array
     */
    public function make($route)
    {
        // set route name of menu
        $this->routeName($route);

        $submenu = [];

        if(! empty($this->submenu)) {
            $submenu = $this->submenu;
        }

        $result = [
            'name' => $this->route,
            'title' => $this->title,
            'link' => $this->link,
            'icon' => $this->icon,
            'is_new' => $this->isNew,
            'class' => $this->className,
            'selected' => $this->selected,
            'open_child_on_click' => $this->openChildOnClick,
            'parent_class_when_open_child' => $this->parentClassWhenChildOpen,
            'sub' => $submenu
        ];

        if(empty($this->submenu)) {
            unset($result['sub']);
        }

        return $result;
    }

}
