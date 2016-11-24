<?php

/**
 * SideNav helper methods
 *
 * @author Alireza Josheghani <a.josheghani@anetwork.ir>
 * @version 1.0
 * @package SideNav
 * @since 8 Oct 2016
 */

namespace Anetwork\SideNav;

trait SideNavHelpers
{

    /**
     * Check menu has sub
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  8 Oct 2016
     * @param  $menu
     * @return bool
     */
    public static function hasSub($menu)
    {
        // check menu has sub
        if(! empty($menu['sub'])) {
            return true;
        }

        return false;
    }

    /**
     * Print item icon
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  8 Oct 2016
     * @param  $value
     * @return string
     */
    public static function itemIcon($value)
    {

        $tag = $value['tag'];

        if($value['tag'] === null) {
            $tag = 'i';
        }

        return '<' . $tag . ' class="' . $value['value'] . '"></' . $tag . '>';
    }

    /**
     * Print item new_tab option
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  8 Oct 2016
     * @param  $newTab
     * @return null|string
     */
    public static function new_tab($newTab)
    {
        if($newTab) {
            return 'target="_blank"';
        }

        return null;
    }

}