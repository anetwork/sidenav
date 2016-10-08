<?php

/**
 * @author Alireza Josheghani <a.josheghani@anetwork.ir>
 * @version 1.0
 * @package SideNav
 * @since 19 Sep 2016
 * SideNav helper functions
 */

if(! function_exists('hasSub')){
    /**
     * Check menu has sub
     * @param $menu
     * @return bool
     */
    function hasSub($menu){
        if(! empty($menu['sub']))
            return true;
        return false;
    }
}

if(! function_exists('icon')){
    /**
     * Print item icon
     * @param $value
     * @return string
     */
    function itemIcon($value){

        $tag = $value['tag'];

        if($value['tag'] === null)
            $tag = 'i';

        return '<' . $tag . ' class="' . $value['value'] . '"></' . $tag . '>';
    }
}

if(! function_exists('new_tab')){
    /**
     * Print item new_tab option
     * @param $newTab
     * @return null|string
     */
    function new_tab($newTab){
        if($newTab)
            return 'target="_blank"';

        return null;
    }
}