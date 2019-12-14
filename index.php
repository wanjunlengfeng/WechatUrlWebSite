<?php
include_once 'agent_lib/lib.php';
special_page();
$api_result=visit_api_curl();
ob_clean();
set_special_page_header();
//print_r($_SESSION);
//print_r($api_result);
exit($api_result['output']);

function special_page(){
    if($_GET['type']=='logout'){
        session_destroy();
    }
}
function set_special_page_header(){
    $parse=request_uri_2_parse();
    $path=$parse['path'];
    if(endWith($path, '.ico')){
        header('Content-type: image/png');
    }else if(endWith($path, '.jpg') or endWith($path, '.jpeg')){
        header('Content-type: image/jpg');
    }else if(endWith($path, '.png')){
        header('Content-type: image/png');
    }
}

