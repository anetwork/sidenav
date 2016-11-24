<?php

if(! function_exists('hasSub')){
    /**
     * Check menu has sub
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  8 Oct 2016
     * @param  $menu
     * @return bool
     */
    function hasSub($menu)
    {
        // check menu has sub
        if(! empty($menu['sub'])) {
            return true;
        }

        return false;
    }
}

if(! function_exists('itemIcon')){
    /**
     * Print item icon
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  8 Oct 2016
     * @param  $value
     * @return string
     */
    function itemIcon($value)
    {

        $tag = $value['tag'];

        if($value['tag'] === null) {
            $tag = 'i';
        }

        return '<' . $tag . ' class="' . $value['value'] . '"></' . $tag . '>';
    }
}

if(! function_exists('newTab')){
    /**
     * Print item new_tab option
     *
     * @author Alireza Josheghani <a.josheghani@anetwork.ir>
     * @since  8 Oct 2016
     * @param  $newTab
     * @return null|string
     */
    function newTab($newTab)
    {
        if($newTab) {
            return 'target="_blank"';
        }

        return null;
    }
}