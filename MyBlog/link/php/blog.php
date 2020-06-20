<?php
include "checkInformation.php";
date_default_timezone_set("Asia/Shanghai");
session_start();
@$name=$_SESSION['name'];
@$picture=$_SESSION['picture'];
$value=1;
$location=2;
$type=3;
$id=4;

$selects=new checkInformation();
$selects->setSqlHost("localhost");
$selects->setSqlUser("root");
$selects->setSqlPassword("12345678");
$selects->setSqLDatabase("myblog");
$selects->setSqlQuery("SELECT * FROM  blogs_comment WHERE id='15ec7e228383f32.86789712' order by CommentLocation  desc limit 0,1");
$con=mysqli_connect("localhost","root","12345678","myblog");
$sqlSelect=mysqli_query($con,"SELECT * FROM blogs_comment WHERE id='15ec7e228383f32.86789712' order by CommentLocation desc limit 0,1");
echo mysqli_num_rows($sqlSelect);
if (!$sqlSelect) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
if ($selects->select_sql()==true){
    $query=$selects->get_sql_information();
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
        addComments($name,$picture,$value,$location,$type,$newLocation,$id);
    }
}else{
    if (strlen($value)>=1024*150){
        echo "  $.alert({
                theme: 'modern',
                animation: 'news',
                closeAnimation: 'news',
                type:'red',
                title: '提示!',
                content: '文本内容大于150kb !',
            });";
    }else {
        addComments($name, $picture, $value, $location, $type, 1,$id);
    }
}

function addComments($name,$picture,$value,$location,$type,$CommentLocation,$id){

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
        $times=date("Y-m-d H:i:s");
        $order=array("\r\n","\n","\r");
        $value=str_replace($order,"<br/>",$value);
        $value=addslashes($value);
        $onlyid=uniqid(true,true);
        $add=new checkInformation();
        $add->setSqlHost("localhost");
        $add->setSqlUser("root");
        $add->setSqlPassword("12345678");
        $add->setSqLDatabase("myblog");
        $add->setSqlQuery("insert  into blogs-comment value ('$id','$picture','$name','$times','$value','$location','$type','$CommentLocation','$onlyid')");
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

