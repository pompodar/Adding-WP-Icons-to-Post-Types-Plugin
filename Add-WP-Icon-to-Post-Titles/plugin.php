<?php
/*
Plugin Name: Add WP Icon to Post Titles
Plugin Name: http://example.com
Description: The plugin to add WP icons to posts titles - first the settings must be saved
Version: 1.0.0
Author: Svjatoslav Kachmar
Author Uri: http://example.com
*/

if (!defined('ABSPATH'))
{
    die("Hey, you don't access this file");
}

class Add_WP_Icon_to_Post_Titles_Plugin
{
    function __construct()
    {
        add_action('init', array(
            $this,
            'register'
        ));
    }

    function register()
    {
        add_action('wp_enqueue_scripts', array(
            $this,
            'enqueue'
        ));
    }

    function enqueue()
    {
        wp_enqueue_style('plugin_style', plugins_url('/assets/style.css', __FILE__));
    }
}

if (class_exists('Add_WP_Icon_to_Post_Titles_Plugin'))
{

    require_once plugin_dir_path(__FILE__) . 'inc/add-icon.php';
    require_once plugin_dir_path(__FILE__) . 'inc/settings.php';

    $AWITPTP_obj = new Add_WP_Icon_to_Post_Titles_Plugin('Add_WP_Icon_to_Post_Titles_Plugin initialized!');

    $AWITPTP_settings_obj = new AWITPTP_settings();
    $AWITPTP_settings_obj->plugin_settings();

    $AWITPTP_Add_Icon_obj = new AWITPTP_Add_Icon();
    $AWITPTP_Add_Icon_obj->icon_adding();
}

