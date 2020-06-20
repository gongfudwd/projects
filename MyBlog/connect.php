<?php
date_default_timezone_set("Asia/Shanghai");
header("Content-Type: text/html;charset=utf-8");
require_once("./Connect2.1/API/qqConnectAPI.php");
$qc = new QC();
$acs = $qc->qq_callback();
$oid = $qc->get_openid();
$qc = new QC($acs,$oid);
$uinfo = $qc->get_user_info();
session_start();
if (isset($uinfo ) ) {
    $ret=$uinfo ['ret'];
    $_SESSION['ret']=$ret;
    $name=$uinfo ['nickname'];
    $_SESSION['name']=$name;
    $picture=$uinfo ['figureurl_1'];
    $_SESSION['picture']=$picture;
    visit($name,$picture);
}
if ($_SESSION['html']==null){
    echo "<script>window.location.href='index.html';</script>";
}else{
    $html=$_SESSION['html'];
    echo "<script>window.location.href='$html';</script>";
}

function visit($name,$picture){
    $time=date("Y-m-d H:i:s");
    $con=mysqli_connect('localhost','root','12345678','myblog');
    $resql=mysqli_query($con,"SELECT * FROM user_visit WHERE name ='$name'");
    if (mysqli_num_rows($resql)){
        $resql=mysqli_query($con,"UPDATE user_visit SET time='$time',picture='$picture' where name='$name' ");
    }else{
        $rsqwlwrite=mysqli_query($con,"insert  into user_visit value ('$name','$picture','$time')");
    }
}
