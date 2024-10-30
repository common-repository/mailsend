<?php
/*
Plugin Name: MailSend
Plugin URI: https://mailsend.com/
Author: 500apps
Author URI: https://500apps.com
Version: 0.1
Description: Build customer journeys with a visual drag-and-drop builder that simplifies complex processes and sends emails using auto-responders.

 */

define('MAILSEND_ROOT', __FILE__);
define('MAILSEND_DIR', plugin_dir_path(__FILE__));

require __DIR__ . '/mail_functions.php';
spl_autoload_register('mail_class_loader');

/**
 * Parse configuration
 */
$settings_mail = parse_ini_file(__DIR__ . '/mail_settings.ini', true);
add_action('plugins_loaded', array(\mailplugin\Mail::$class, 'init'));

add_action('wp_enqueue_scripts', 'wpMailSendStylesheet');
add_action('admin_enqueue_scripts', 'wpMailSendStylesheet');
function wpMailSendStylesheet() 
{
    wp_enqueue_style( 'mail_CSS', plugins_url( '/mail.css', __FILE__ ) );
}

function wpMailSendScripts(){
    wp_register_script('mail_script', plugins_url('/js/mail_admin.js', MAILSEND_ROOT), array('jquery'),time(),true);
    wp_enqueue_script('mail_script');
}    

add_action('wp_enqueue_scripts', 'wpMailSendScripts');
add_action('admin_enqueue_scripts', 'wpMailSendScripts');
add_action( 'wp_head', 'mail_script' );

add_action('wp_ajax_mail_addtoken', 'mail_addtoken');
add_action('wp_ajax_mail_save_website', 'mail_save_website');