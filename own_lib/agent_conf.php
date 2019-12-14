<?php
header("Content-Type: text/html; charset=utf-8");
header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('PRC');
session_name('PHOENIX_SESSION_ID');
session_start();
switch ($_POST['type']){
    case 'write_defined_file':echo json_encode(write_defined_file());break;
    case 'check_is_writable':echo json_encode(check_is_writable());break;
    case 'upload':echo json_encode(upload());break;
    default:echo 'need type';
}
function upload(){
    if(!isset($_SESSION['AGENTUUID'])){
        $result['code']=0;
        $result['message']='请先登录';
        return $result;
    }
    $path='/own_static/upload/';
    $real_path=$_SERVER['DOCUMENT_ROOT'].$path;
    if(!isset($_FILES['file'])){
        $result['code']=1000;
        $result['message']='上传失败';
        return $result;
    }
    
    
    $file=$_FILES['file'];
    
    
    $extension=pathinfo($file["name"],PATHINFO_EXTENSION);
    $savefilename=time()."_".rand(100000, 1000000).".".$extension;
    $image_upload_path=$real_path.$savefilename;
    move_uploaded_file($file["tmp_name"],$image_upload_path);
    
    $result['code']=1;
    $result['message']='上传成功';
    $result['data']['real_path']=$image_upload_path;
    $result['data']['path']=$path.$savefilename;
    return  $result;
}
function write_defined_file(){
    
    $lock_file=$_SERVER['DOCUMENT_ROOT'].'/agent_lib/lock.txt';
    $defined_file=$_SERVER['DOCUMENT_ROOT'].'/agent_lib/defined.php';
    if(@file_get_contents($lock_file)=='locked'){
        $result['code']=1000;
        $result['message']='请将"网站目录/agent_lib/lock.txt" 的内容修改成unlocked';
        return $result;
    }
    $result['code']=1100;
    $result['message']='没有权限去修改"网站目录/agent_lib/defined.php"文件，请将defined.php权限改成可写';
    $content=$_POST['content'];
    $length=@file_put_contents($defined_file, $content);
    if($length>0){
        $result['code']=1;
        $result['message']='配置文件defined.php写入成功';
        @file_put_contents($lock_file, 'locked');
    }
    return $result;
    
}
function check_is_writable(){
    $files=trim($_POST['files']);
    $array=@json_decode($files);
    if(empty($array)){
        $result['code']=1000;
        $result['message']='files不能为空，并且必须是数组';
    }
    $list=[];
    foreach ($array as $file_){
 
        $file=$_SERVER['DOCUMENT_ROOT'].'/'.$file_;
        $item['file'] =$file_;
        if(file_exists($file)){
           $item['is_exists'] =1;
        }else{
            $item['is_exists'] =0;
        }
        
        if(is_writable($file)){
            $item['is_writable'] =1;
        }else{
            $item['is_writable'] =0;
        }
        $list[]=$item;
    }
  
    $result['code']=1;
    $result['message']='检测权限成功';
    $result['data']=$list;

    return $result;
}


