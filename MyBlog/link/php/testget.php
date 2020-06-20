<?php
include "checkInformation.php";
$select=new checkInformation();
$select->setSqlHost("localhost");
$select->setSqlUser("root");
$select->setSqlPassword("12345678");
$select->setSqLDatabase("myblog");
$select->setSqlQuery("SELECT * FROM  test WHERE 1 ");
if ($select->select_sql()==true){
    $query=$select->get_sql_information();
    while($rows=mysqli_fetch_array($query)) {
        $value=$rows["value"];
        echo $value;
    }
}else{
    echo "error";
}