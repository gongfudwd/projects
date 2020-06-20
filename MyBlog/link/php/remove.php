<?php
session_start();
$killsession=$_POST['kill'];
switch ($killsession){
    case "kill":
        $_SESSION=array();
        echo "window.location.reload();";
        break;
}
