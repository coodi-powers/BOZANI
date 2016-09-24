<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 6/07/16
 * Time: 19:35
 */


if(($page->template != 'menu_left') || ($page->template != 'page'))
{
    $arr_plugins = explode('[[DEFAULT_CONTENT]]', $plugins);

    echo $arr_plugins[0];   
}