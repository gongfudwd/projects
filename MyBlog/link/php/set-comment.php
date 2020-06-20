<?php
include "checkInformation.php";
date_default_timezone_set("Asia/Shanghai");
session_start();
@$name=$_SESSION['name'];
@$picture=$_SESSION['picture'];
$value=$_POST['value'];
$location=$_POST['location'];
$type=$_POST['type'];

$select=new checkInformation();
$select->setSqlHost("localhost");
$select->setSqlUser("root");
$select->setSqlPassword("12345678");
$select->setSqLDatabase("myblog");
$select->setSqlQuery("SELECT * FROM  comment WHERE 1  order by CommentLocation  desc limit 0,1");
if ($select->select_sql()==true){
    $query=$select->get_sql_information();
    while($rows=mysqli_fetch_array($query)) {
        $CommentLocation=$rows["CommentLocation"];
    }
    $newLocation=$CommentLocation+1;
    if (strlen($value)>=1024*150){
        echo "  $.alert({
                theme: 'modern',
                animation: 'news',
                closeAnimation: 'news',
                type:\"red\",
                title: '提示!',
                content: '文本内容大于150kb !',
            });";
    }else{
        addComments($name,$picture,$value,$location,$type,$newLocation);
    }
}else{
    if (strlen($value)>=1024*150){
        echo "  $.alert({
                theme: 'modern',
                animation: 'news',
                closeAnimation: 'news',
                type:\"red\",
                title: '提示!',
                content: '文本内容大于150kb !',
            });";
    }else {
        addComments($name, $picture, $value, $location, $type, 1);
    }
}

function addComments($name,$picture,$value,$location,$type,$CommentLocation){
    $times=date("Y-m-d H:i:s");
    if ($name==null || $picture==null){
        echo "  $.alert({
                theme: 'modern',
                animation: 'news',
                closeAnimation: 'news',
                type:\"red\",
                title: '提示!',
                content: '请先登录 !',
            });";
    }else{
        $order=array("\r\n","\n","\r");
        $value=str_replace($order,"<br/>",$value);
        $value=addslashes($value);
        $add=new checkInformation();
        $add->setSqlHost("localhost");
        $add->setSqlUser("root");
        $add->setSqlPassword("12345678");
        $add->setSqLDatabase("myblog");
        $add->setSqlQuery("insert  into comment value ('$picture','$name','$times','$value','$location','$type','$CommentLocation')");
        if ($add->insert_sql()==false){
            echo "    $.alert({
                theme: 'modern',
                animation: 'news',
                closeAnimation: 'news',
                type:\"red\",
                title: '提示!',
                content: '发送失败 !',
            });";
        }else{
            echo " window.location.reload();";
        }
    }
}
