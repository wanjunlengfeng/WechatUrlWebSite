<?php
include_once 'agent_lib/lib.php';
//print_r($_SERVER);
//echo '本网页的SESSION:'.session_id();
//echo ("\n=================下面是远程页面==========================\n");
//print_r(visit_api_curl());

/**
echo ("\n=================代理商网页显示的内容==========================\n\n\n");
echo '$_SESSION:';
print_r($_SESSION);
echo ("\n\n\n=================下面是远程页面==========================\n");
**/
special_page();
$api_result=visit_api_curl();
//ob_clean();
set_special_page_header();
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
    }else if(endWith($path, '.jpg')){
        header('Content-type: image/jpg');
    }else if(endWith($path, '.png')){
        header('Content-type: image/png');
    }
}

