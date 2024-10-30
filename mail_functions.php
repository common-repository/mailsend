<?php

/**
 * initializing the plugin
 * @param $class_name
 */
function mail_class_loader($class_name)
{
    $class_file = MAILSEND_DIR . 'classes/class.'
        . trim(strtolower(str_replace('\\', '_', $class_name)), '\\') . '.php';
    if (is_file($class_file)) {
        require_once $class_file;
    }
}

/**
 * To add the token to DB
 */
function mail_addtoken()
{
    $token_value = sanitize_text_field($_POST['token_value']);
    if (get_option('user_token')) {
        update_option('user_token', $token_value);
        echo "updated";
    } else if (get_option('user_token') == "") {
        update_option('user_token', $token_value);
        echo "updated";
    } else {
        add_option('user_token', $token_value);
        echo "added";
    }
}


/** To extract the Token **/
function mail_extract_token()
{
    $token         = get_option('user_token');
    $tokenParts    = explode(".", $token);
    $tokenHeader   = base64_decode($tokenParts[0]);
    $tokenPayload  = base64_decode($tokenParts[1]);
    $jwtHeader     = json_decode($tokenHeader);
    $jwtPayload    = json_decode($tokenPayload);
    return $jwtPayload;
}
