<?php
include "checkInformation.php";
date_default_timezone_set("Asia/Shanghai");
session_start();
@$name1=$_SESSION['name'];
@$picture=$_SESSION['picture'];
@$value=$_POST['value'];
@$location=$_POST['location'];
@$name2=$_POST['name2'];
@$CommentLocation=$_POST['CommentLocation'];
$onlyid=uniqid(true,true);

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
    addComments($name1,$picture,$value,$location,$name2,$CommentLocation,$onlyid);
}

function addComments($name1,$picture,$value,$location,$name2,$CommentLocation,$onlyid){
    $times=date("Y-m-d H:i:s");
    if ($name1==null || $picture==null){
        echo "  $.alert({
                theme: 'modern',
                animation: 'news',
                closeAnimation: 'news',
                type:\"red\",
                title: '提示!',
                content: '请先登录 !',
            });";
    }else{
        if ($value==null||$location==null||$name2==null||$CommentLocation==null){
            echo "  $.alert({
                theme: 'modern',
                animation: 'news',
                closeAnimation: 'news',
                type:\"red\",
                title: '提示!',
                content: '发送失败,缺少数据,请重试 !',
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
            $add->setSqlQuery("insert  into reply value ('$picture','$name1','$name2','$times','$value','$location','$CommentLocation','$onlyid')");
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
}
