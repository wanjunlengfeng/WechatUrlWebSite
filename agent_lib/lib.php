<?php
header("Content-Type: text/html; charset=utf-8");
header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('PRC');
session_name('PHOENIX_SESSION_ID');
session_start();

require_once 'defined.php';
require_once 'common.php';

function set_session($html){
    $html=trim($html);
    if(!startWith($html, '{') or !endWith($html, '}')){
        return ;
    }
    $array=json_decode($html,true);
    if(!array_key_exists('save_sessions', $array)){
        return;
    }
    foreach ($array['save_sessions'] as $key=>$value){
        $_SESSION[$key]=$value;
    }

}
