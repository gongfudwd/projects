<?php
include "checkInformation.php";
$comment=new checkInformation();
$comment->setSqlHost("localhost");
$comment->setSqlUser("root");
$comment->setSqlPassword("12345678");
$comment->setSqLDatabase("myblog");
$comment->setSqlQuery("SELECT * FROM  comment order by time desc ");
if ($comment->get_sql_information()==false){
    echo "error";
}else{
    $query=$comment->get_sql_information();
    $code=0;
    while ($rows=mysqli_fetch_array($query)){
        $url=$rows["url"];
        $name=$rows["name"];
        $time=$rows["time"];
        $value=$rows["value"];
        $location=$rows["location"];
        $type=$rows["type"];
        $CommentLocation=$rows["CommentLocation"];
        $code++;
        $str=reply($CommentLocation,$code);
        if ($str==""){
            $hr=null;
            $str=null;
        }else{
            $hr=" <div class=\"comment-hr\"></div>";
        }
        echo"
         <li class=\"comment-li\" id=\"message$code\">
                <img class=\"comment1\" src=\"$url\" width=\"45px\" height=\"45px\">
                <div class=\"comment2\"><span class=\"comment2-1\" id=\"message$code-user1\">$name</span> <span class=\"comment2-2\">$type</span></div>
                <div class=\"comment3\" id=\"message$code-data\">$value</div>
                <p class=\"comment4\">&nbsp;&nbsp;<span class=\"glyphicon glyphicon-cloud\"></span>&nbsp;&nbsp;<span>$location</span>&nbsp;&nbsp;<span>$time</span>&nbsp;&nbsp;
                    <span><a href=\"javascript:void(0);\" onclick='reply1(this);' id=\"message$code-act\">回复</a></span><span id='message$code-id' style='display: none'>$CommentLocation</span></p>
           $hr
           $str
            </li>

        ";
    }
}

function reply($CommentLocation,$fatherCode){
    $reply=new checkInformation();
    $reply->setSqlHost("localhost");
    $reply->setSqlUser("root");
    $reply->setSqlPassword("12345678");
    $reply->setSqLDatabase("myblog");
    $reply->setSqlQuery("SELECT * FROM  reply where CommentLocation='$CommentLocation' order by time asc");
    if ($reply->get_sql_information()==false){
        return '';
    }else{
        $query=$reply->get_sql_information();
        $code=0;
        $str="";
        while ($rows=mysqli_fetch_array($query)){
            $url=$rows["url"];
            $name1=$rows["name1"];
            $name2=$rows["name2"];
            $time=$rows["time"];
            $value=$rows["value"];
            $location=$rows["location"];
            $CommentLocation=$rows["CommentLocation"];
            $code++;
            $str.= "
                <div style=\"position: relative;height: auto;left: 55px\" id=\"message$fatherCode-reply$code\">
                    <img class=\"comment1-reply\" src=\"$url\" width=\"45px\" height=\"45px\">
                    <div class=\"comment2-reply\"><span class=\" comment2-1\" id=\"message$fatherCode-reply$code-user1\">$name1</span>&nbsp;<strong class=\"\">回复</strong>&nbsp;<span class=\" comment2-1\" id=\"message$fatherCode-reply$code-user2\">$name2</span></div>
                    <div class=\"comment3-reply\" id='message$fatherCode-reply$code-model' ><span >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span id=\"message$fatherCode-reply$code-data\" class='comment3-text'>$value</span>
                        <p class=\"comment4 comment4-reply\" >&nbsp;&nbsp;<span class=\"glyphicon glyphicon-cloud\"></span>&nbsp;&nbsp;<span>$location</span>&nbsp;&nbsp;<span>$time</span>&nbsp;&nbsp;
                            <span><a href=\"javascript:void(0);\" onclick='reply2(this);' id=\"message$fatherCode-reply$code-act\">回复</a></span><span id='message$fatherCode-reply$code-id' style='display: none'>$CommentLocation</span></p>
                    </div>
                    <div id='message$fatherCode-reply$code-box'></div>
                    
                </div>
                <script>
                    $('#message$fatherCode-reply$code-box').height($('#message$fatherCode-reply$code-model').height()+15);
                </script>
            ";
        }
        return $str;
    }

}

