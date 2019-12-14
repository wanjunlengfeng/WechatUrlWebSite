<?php
$agent_api_urls=[
    AGENT_API_URL_1,AGENT_API_URL_2,AGENT_API_URL_3
];
/**
 * http_build_query($_COOKIE)
 * parse_str()
 * */
function to_redirect_url($redirect_url){
    $parse=parse_url($redirect_url);
   
    $httpdomain=$parse['scheme'].'://'.$parse['host'];
    if(isset($parse['port'])){
        $httpdomain.=':'.$parse['port'];
    }
    $path=str_replace($httpdomain, '', $redirect_url);

    if(startWith($path, '/')){
        header("Location:".$path);
        exit();
    }
}
function visit_api_curl(){
    global $agent_api_urls;
    $is_post_submit=true;
    $count=count($agent_api_urls);
    for ($i=0;$i<$count;$i++){
        $result=api_curl($i,$is_post_submit);

        if(isset($result['redirect_url'])){
            to_redirect_url($result['redirect_url']);
        }
        if($result['http_code']==405){
            $is_post_submit=false;
            $result=api_curl($i,$is_post_submit);
        }
        if($result['http_code']!=0){
            set_session($result['output']);
            return $result;
        }
    }
}
function api_curl($times=0,$is_post_submit=true){
    global $agent_api_urls;
    $request_uri=$_SERVER['REQUEST_URI'];
    while (startWith($request_uri, '//')){
        $request_uri=substr($request_uri, 1);
    }
    $url=$agent_api_urls[$times].$request_uri;
    $headers = [
        'AGENTCLIENTVERSION:2.1',
        'AGENTAPPID:'.AGENT_APPID,
        'AGENTAPPKEY:'.AGENT_APPKEY,
        'CLIENTIP:'.get_real_client_ip(),
        'AGENTMAINHOST:'.$_SERVER['HTTP_HOST'],
        'ACCEPT:'.$_SERVER['HTTP_ACCEPT_LANGUAGE']
    ];
    if(isset($_SESSION['USERUUID'])){
        $headers[]='USERUUID:'.$_SESSION['USERUUID'];
    }
    if(isset($_SESSION['AGENTUUID'])){
        $headers[]='AGENTUUID:'.$_SESSION['AGENTUUID'];
    }
    if(isset($_SESSION['OPTIONCODE'])){
        $headers[]='OPTIONCODE:'.$_SESSION['OPTIONCODE'];
    }
    $headers[]='AGENTWEBSITE:1';
    $post=$_POST;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION ,1); //300-400
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    if($is_post_submit){
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }

    if(startWith($url, 'https')){
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    $output = curl_exec($ch);
    $getinfo = curl_getinfo($ch);
    $http_code=$getinfo['http_code'];
    curl_close($ch);
    $result=['http_code'=>$http_code,'output'=>$output];
    if($http_code>300 and $http_code<400 and isset($getinfo['redirect_url'])){
        $result['redirect_url']=$getinfo['redirect_url'];
    }
    return $result;
}
/*
 * 字符串是否以$needle开头
 * 如果是，则true,
 */
function startWith($str, $needle) {
    
    return strpos($str, $needle) === 0;
    
}
/*
 * 字符串是否以$needle结尾
 * 如果是，则true,
 */
function endWith($haystack, $needle) {
    $length = strlen($needle);
    if($length == 0)
    {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}
function get_real_client_ip(){
    $real_client_ip=$_SERVER['REMOTE_ADDR'];
    $ng_client_ip=( isset($_SERVER['HTTP_X_FORWARDED_FOR'])  ?   $_SERVER['HTTP_X_FORWARDED_FOR']    :   "");//反向代理
    if($ng_client_ip!="" and strlen($ng_client_ip)>5){
        if(strstr($ng_client_ip, ',')!=""){
            $a=explode(',', $ng_client_ip);
            $real_client_ip=$a[0];
        }else{
            $real_client_ip=$ng_client_ip;
        }
    }
    return $real_client_ip;
}
function request_uri_2_parse(){
    //  "//sdfdfdff/sdfosdf.shtml?sdonfosdf=1?234=1"
    $REQUEST_URI='http://localhost'.$_SERVER['REQUEST_URI'];
    $arr=parse_url($REQUEST_URI);
    $result['path']=$arr['path']; //  //sdfdfdff/sdfosdf.shtml
    $result['query']=$arr['query']; //  sdonfosdf=1?234=1
    return $result;
}