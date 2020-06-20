<?php
include "checkInformation.php";

$select=new checkInformation();
$select->setSqlHost("localhost");
$select->setSqlUser("root");
$select->setSqlPassword("12345678");
$select->setSqLDatabase("myblog");
$select->setSqlQuery("SELECT * FROM  user_visit WHERE 1  order by time desc limit 0,6");
if ($select->select_sql()==true){
    $query=$select->get_sql_information();
    $str="";
    while($rows=mysqli_fetch_array($query)) {
        $name=$rows["name"];
        $picture=$rows["picture"];
        $str.="
        <div class=\"col-md-6 col-xs-6\"><img src=\"$picture\" ><span>$name</span></div>
        ";
    }
    return $str;
}else{
    return "error";
}