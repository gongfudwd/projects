<?php
include "checkInformation.php";
$value=$_POST['value'];
$value=addslashes($value);
$add=new checkInformation();
$add->setSqlHost("localhost");
$add->setSqlUser("root");
$add->setSqlPassword("12345678");
$add->setSqLDatabase("myblog");
$add->setSqlQuery("insert  into test value ('$value')");
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
$file="data:image/png;base64,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…";
$base64_string= explode(',', $file);
echo $base64_string[1];