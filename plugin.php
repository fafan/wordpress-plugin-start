<?php
/*
Plugin Name: Wordpress Plugin Start
Plugin URI: 
Description: 
Version: 1.0
Author: Fafan
Author URI: 
License: GNU GPL
*/

namespace org\yourname\yourproject;

new Plugin;

class Plugin
{
    function __construct()
    {
        add_action('plugins_loaded', array($this, 'loaded'));
        add_action('admin_init',  array($this, 'start_buffer'));
        add_action('admin_head',  array($this, 'set_head_buffer'));
        add_action('admin_footer',  array($this, 'set_footer_buffer'));
        add_action('admin_menu',  function(){
            add_menu_page('Plugin Settings', 'Plugin', 'manage_options', __FILE__, array($this, 'admin_menu_page'), null);
        });
    }

    function loaded()
    {
        // this works!
    }

    function start_buffer()
    {
        ob_start( function($buffer) {            
            $buffer = preg_replace('/<link\ rel\=\'stylesheet\' id\=\'open\-sans\-css\'[^>]*>/', '', $buffer);
            $buffer .= "<link rel='stylesheet' id='open-sans-css'  href='".plugins_url('googlefonts/css/opensans.css')."' type='text/css' media='all' />";
            return $buffer;
        });
    }

    function set_head_buffer()
    {
        ob_end_flush();
        ob_start( function($buffer) { return $buffer; });
    }

    function set_footer_buffer()
    {
        ob_end_flush();
    }

    function admin_menu_page()
    {
        echo 'admin menu page';
    }
}


