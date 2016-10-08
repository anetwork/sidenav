<?php

/**
 * @author Alireza Josheghani <a.josheghani@anetwork.ir>
 * @version 1.0
 * @package SideNav
 * @since 20 Sep 2016
 * SideNav Menu class
 */

namespace Anetwork\SideNav;

class Menu
{

    // the route name
    protected $route;

    // the title option
    protected $title;

    // the url option
    protected $link = [
        'new_tab' => false,
        'value' => null
    ];

    // the class-name option
    protected $class;

    // the icon option
    protected $icon = [
        'tag' => 'i',
        'value' => null
    ];

    // is_new icon option : boolean
    protected $isNew = false;

    // selected option
    protected $selected = false;

    // open child when item is active : boolean
    protected $openChildOnClick = true;

    // the sub menu array
    protected $submenu = [];

    /**
     * Attach sub menu array
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @param $route
     * @param $callback
     */
    public function sub($route, $callback)
    {
        $sub = SideNav::addSub($route, $callback);
        array_push($this->submenu,$sub);
    }

    /**
     * Attach sub menu array with checking status of item
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @param $route
     * @param $callback
     */
    public function subWithCheckStatus($route, $callback)
    {
        if(SideNav::checkStatus($route) === true)
        {
            $sub = SideNav::addSub($route, $callback);
            array_push($this->submenu,$sub);
        }
    }

    /**
     * Set the icon option
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @param $icon
     */
    public function icon($icon)
    {
        $this->icon['value'] = $icon;
        return $this;
    }

    /**
     * Set the icon tag option
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @param $icon
     */
    public function tag($tag)
    {
        $this->icon['tag'] = $tag;
        return $this;
    }

    /**
     * Set the title option
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @param $title
     */
    public function title($title)
    {
        $this->title = $title;
    }

    /**
     * Set the class-name option
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @param $class_name
     */
    public function className($className)
    {
        $this->class = $className;
    }

    /**
     * Set the newTab option
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @param $newtab : boolean
     */
    public function newTab($newtab)
    {
        $this->link['new_tab'] = $newtab;
    }

    /**
     * Set route name
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @param $route
     */
    public function routeName($route)
    {
        $this->route = $route;
    }

    /**
     * Set the link of menu
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @param $link
     * @return $this
     */
    public function link($link)
    {
        $this->link['value'] = $link;
        return $this;
    }

    /**
     * Set target link of item
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @param $isNew
     */
    public function is_new($isNew)
    {
        $this->isNew = $isNew;
    }

    /**
     * Set item is selected
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @param $type
     */
    public function selected($type)
    {
        $this->selected = $type;
    }

    /**
     * Set open child when item is active
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @param $type
     */
    public function openChildOnClick($type)
    {
        $this->openChildOnClick = $type;
    }

    /**
     * make the return item array
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since 20 Sep 2016
     * @return array
     */
    public function make($route)
    {
        // set route name of menu
        $this->routeName($route);

        $submenu = null;

        if(!empty($this->submenu))
            $submenu = $this->submenu;

        $result = [
            'name' => $this->route,
            'title' => $this->title,
            'class' => $this->class,
            'icon' => $this->icon,
            'link' => $this->link,
            'selected' => $this->selected,
            'is_new' => $this->isNew,
            'open_child_on_click' => $this->openChildOnClick,
            'sub' => $submenu
        ];

        if(empty($this->submenu))
            unset($result['sub']);

        return $result;

    }

}