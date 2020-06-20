<?php
date_default_timezone_set("Asia/Shanghai");
$onlyId=uniqid(true,true);
include "checkInformation.php";
$value=$_POST['value'];
$blogTitle=$_POST['blogTitle'];
$blogName=$_POST['blogName'];
$blogDate=$_POST['blogDate'];
$blogTime1=$_POST['blogTime1'];
$blogTime2=$_POST['blogTime2'];
$blogBrief=$_POST['blogBrief'];
$blogType=$_POST['blogType'];
$blogCopyright=$_POST['blogCopyright'];
$file=$_FILES['file']['tmp_name'];
$path="../blogHeard/";
$str=move_uploaded_file($file,$path.$onlyId);

if ($value==""||$blogTitle==""||$blogName==""||$blogDate==""||$blogTime1==""||$blogTime2==""||$blogBrief==""||$blogType==""||$blogCopyright==""||filesize($file)==0||filesize($file)>=600*1024){
    echo "  $.alert({
                theme: 'modern',
                animation: 'news',
                closeAnimation: 'news',
                type:\"red\",
                title: '提示!',
                content: '发送失败,缺少数据,请重试 !',
            });";
}else{

}