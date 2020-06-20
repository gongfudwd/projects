<?php
require_once("../API/qqConnectAPI.php");
$qc = new QC();
$qc->qq_callback();    //返回的验证值
$openid = $qc->get_openid();        //qq分配的用户id
$result = $qc->get_user_info(); //获取用户登录信息
$user_info=$qc->get_user_info();// 获取'QQ用户'的基本信息

session_start();
if (isset($uinfo ) ) {
    $ret=$uinfo ['ret'];
    $_SESSION['ret']=$ret;
    $name=$uinfo ['nickname'];
    $_SESSION['name']=$name;
    $picture=$uinfo ['figureurl_qq_1'];
    $_SESSION['picture']=$picture;
}