<?php
require_once("../../API/qqConnectAPI.php");

$qc = new QC();
$acs = $qc->qq_callback();
$oid = $qc->get_openid();
$qc = new QC($acs,$oid);
$uinfo = $qc->get_user_info();
print_r($uinfo);