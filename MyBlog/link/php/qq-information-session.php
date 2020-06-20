<?php
session_start();
@$ret=$_SESSION['ret'];
@$name=$_SESSION['name'];
@$picture=$_SESSION['picture'];

$all[]=array("RET"=>$ret,"USER"=>$name,"PICTURE"=>$picture);
echo json_encode($all);