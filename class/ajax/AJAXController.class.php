<?php
/*
** Plugin Name: My Ajax Handler
** Description: A simple plugin to handle all my ajax.
** Version: 1
** Author: Me
*/

class MyAjaxHandler
{
    public static $file, $dir, $url;
    public function __construct()
    {
        self::$file = __FILE__;
        self::$dir = dirname(self::$file);
        self::$url = plugins_url('', self::$file);
        add_action('init', array($this, 'register'));
        add_action('wp_enqueue_scripts', array($this, 'js'));
        add_action('wp_ajax_my_ajax_handler', array($this, 'ajax'));
        add_action('wp_ajax_nopriv_my_ajax_handler', array($this, 'ajax'));
    }
    public function register()
    {
        wp_register_script('my-ajax-handler', self::$url.'/my-ajax-handler.js', array('jquery'));   
    }
    public function js()
    {
        $vars = array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('my-ajax-handler-nonce'));
        wp_enqueue_script('my-ajax-handler');
        wp_localize_script('my-ajax-handler', 'my_ajax_handler', $vars);    
    }
    public function ajax()
    {
        if(!wp_verify_nonce($_POST['nonce'], 'my-ajax-handler-nonce')) die('Nonce failed.');    
        $response = 'An '.$_POST['fruit'].' a day keeps the doctor away';
        header("Content-Type: application/json");
        echo json_encode($response);
        exit;
    }
}