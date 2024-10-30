<?php
namespace mailplugin;
class Mail
{
    public static $class = __CLASS__;
    /**
     * @param $action_id
     */
    public static function appContent($action_id){
        global $settings_mail;
        if ($action_id == 'mail') {
            $mail_url = "https://infinity.500apps.com/mailsend?menu=false";
            include 'mail_content.php';
        }
           }
    public static function action_1(){
        self::appContent('mail');
    }
    public static function action_2(){
        self::appContent('Other');
    }
    public static function init()
    {
        add_action('admin_menu', array(__CLASS__, 'register_menu_mail'),10,0);
    }
    public static function register_menu_mail()
    {
        global $settings_mail;
        add_menu_page($settings_mail['menus']['menu'], $settings_mail['menus']['menu'], 'manage_options', __FILE__, array(__CLASS__, 'action_1'),plugin_dir_url( __FILE__ ) . 'images/mailsend_logo.png');
        add_submenu_page(__FILE__, $settings_mail['menus']['sub_menu_title_1'], $settings_mail['menus']['sub_menu_title_1'], 'manage_options', $settings_mail['menus']['sub_menu_url_1'], array(__CLASS__, 'action_2'));
    }
}