function buttonChange() {
    $("#btn").attr("disabled",true);
    $("#viewComment").css("display","none");
    setInterval(function () {
        var str =replace_em($("#content").val());
        if (str.length===1||str.length===0){
            $("#viewData").html("");
            $("#btn").attr("disabled",true);
            $("#viewComment").css("display","none");
        }else {
            $("#viewData").html(str);
            $("#btn").attr("disabled",false);
            if (checkUser()==null){
                $("#viewComment").css("display","none");
            }else {
                $("#comment1").attr("src",getUserPicture());
                $("#comment2-1").html(checkUser());
                $("#comment2-2").html(myBrowser());
                $("#viewComment").css("display","");
                $("#content").css("height","125px");
            }
        }

    },200);

}

function replace_em(str){
    str = str.replace(/\</g,'<；');
    str = str.replace(/\>/g,'>；');
    str = str.replace(/\n/g,'<br/>');
    str = str.replace(/\[em_([0-9]*)\]/g,'<img src="face/$1.gif" border="0" />');
    return str;
}
function comment() {
    $.post("link/php/comment.php",function (data) {
     $("#commentUl").append(data);
    });
}

function insertComment(location,value,type) {
    $.ajax({
        type: "post",
        url: "link/php/set-comment.php",
        data: {
            "location":location,"value":value,"type":type
        },
        success: function (data) {
            eval(data);
        },
        error:function () {
            $.alert({
                theme: 'modern',
                animation: 'news',
                closeAnimation: 'news',
                type:"red",
                title: '提示!',
                content: '网络错误 !',
            });
        }
    });
}


function set_comment() {
    var user=checkUser();
    if (user===null){
        $.alert({
            theme: 'modern',
            animation: 'news',
            closeAnimation: 'news',
            type:"red",
            title: '提示!',
            content: '请先登录 !',
        });

    }else {
        var str = $("#viewData").html();
        if (str.length > 1024 * 150) {
            $.alert({
                theme: 'modern',
                animation: 'news',
                closeAnimation: 'news',
                type: "red",
                title: '提示!',
                content: '超出限制大小150KB !',
            });

        } else {
            $.ajax({
                url: 'http://pv.sohu.com/cityjson?ie=utf-8',
                dataType: "script",
                method: 'GET',
            }).done(function () {
                var city = returnCitySN.cname;
                insertComment(city,str,myBrowser());
            });
        }
    }
}


function myBrowser() {
    var userAgent = navigator.userAgent;
    var isOpera = userAgent.indexOf("Opera") > -1;
    if (isOpera) {
        return "Opera";
    }
    if (userAgent.indexOf("Firefox") > -1) {
        return "Firefox";
    }
    if (userAgent.indexOf("Chrome") > -1) {
        if (window.navigator.webkitPersistentStorage.toString().indexOf('DeprecatedStorageQuota') > -1) {
            return "Chrome";
        } else {
            return "360";
        }
    }
    if (userAgent.indexOf("Safari") > -1) {
        return "Safari";
    }
    if($.browser.version){
        if ($.browser.version==="7.0"){
            return "IE7";
        }else if($.browser.version==="8.0"){
            return "IE8";
        }else if ($.browser.version==="9.0"){
            return "IE9";
        }
        else if ($.browser.version==="10.0"){
            return "IE10";
        }
        else if ($.browser.version==="11.0"){
            return "IE11";
        }
        else if ($.browser.version<7){
            return "IE6及其以下";
        }
    }

}
function checkUser() {
    var name;
    $.ajax({
        type: "post",
        async:false,
        url: 'link/php/qq-information-session.php',
        data: {"ds":""},
        success: function (data) {
            var jsonObjDate=eval("("+data+")");
            $.each(jsonObjDate, function (index, value) {
                 name=value.USER;
            });
        },
    });
    return name;
}
function getUserPicture() {
    var picture;
    $.ajax({
        type: "post",
        async:false,
        url: 'link/php/qq-information-session.php',
        data: {"ds":""},
        success: function (data) {
            var jsonObjDate=eval("("+data+")");
            $.each(jsonObjDate, function (index, value) {
                picture=value.PICTURE;
            });
        },
    });
    return picture;
}
function commentHtml() {
    $.ajax({
        type: "post",
        url: 'link/php/windows-loaction.php',
        data: {"html":"comment.html"},
        success: function (data) {
            window.location.href="Connect2.1/oauth/index.php";
        },
    });
}
function diaryHtml() {
    $.ajax({
        type: "post",
        url: 'link/php/windows-loaction.php',
        data: {"html":"diary.html"},
        success: function (data) {
            window.location.href="Connect2.1/oauth/index.php";
        },
    });
}
function blogHtml() {
    $.ajax({
        type: "post",
        url: 'link/php/windows-loaction.php',
        data: {"html":"blog.html"},
        success: function (data) {
            window.location.href="Connect2.1/oauth/index.php";
        },
    });
}

function exit() {
    $.ajax({
        type: "post",
        url: 'link/php/remove.php',
        data: {"kill":"kill"},
        success: function (data) {
            eval(data);
        },
    });
}

function reply1(obj) {
    var currentNode = $(obj);
    var id = currentNode.attr("id");
    var str=id.substring(7,id.indexOf('-'));
    var name1=checkUser();
    var name2id="#message"+str+"-user1";
    var name2=$(name2id).html();
    var CommentLocationid="#message"+str+"-id";
    var CommentLocation=$(CommentLocationid).text();
    if (name1==null){
        $.alert({
            theme: 'modern',
            animation: 'news',
            closeAnimation: 'news',
            type:"red",
            title: '提示!',
            content: '请先登录 !',
        });
    }else {
        replyConfirm(name1,name2,CommentLocation);
    }
}

function reply2(obj) {
    var currentNode = $(obj);
    var id = currentNode.attr("id");
    var str1=id.substring(7,id.indexOf('-'));
    var str2=id.substring(13+str1.length,id.indexOf("t")-3);
    var name1=checkUser();
    var name2id="#message"+str1+"-reply"+str2+"-user2";
    var name2=$(name2id).text();
    var CommentLocationid="#message"+str1+"-reply"+str2+"-id";
    var CommentLocation=$(CommentLocationid).html();
    if (name1==null){
        $.alert({
            theme: 'modern',
            animation: 'news',
            closeAnimation: 'news',
            type:"red",
            title: '提示!',
            content: '请先登录 !',
        });
    }else {
        replyConfirm(name1,name2,CommentLocation);
    }
}

function replyConfirm(name1,name2,CommentLocation) {
    $.confirm({
        theme: 'modern',
        boxWidth: '30%',
        useBootstrap: false,
        title:name1+" 回复 "+name2,
        content:
            '<div>'+
            '<div id="emoji2" align="left" class="" style="border: lightgrey 1px solid;width:100%" >😄</div>\n'+
            '<textarea class="form-control" id="reply" style="width: calc(100% - 15px);height: 150px" placeholder="来输入点东西吧"></textarea>'+
            '</div>'+
            '<script>setTimeout(function() { ' +
            '    $(\'#emoji2\').qqFace({\n' +
            '                assign:\'reply\', //给输入框赋值\n' +
            '                path:\'face/\' //表情图片存放的路径\n' +
            '            });' +
            '},500)</script>',
        buttons: {
                提交:{
                    btnClass: 'btn-blue',
                    action: function(){
                        $.ajax({
                            url: 'http://pv.sohu.com/cityjson?ie=utf-8',
                            dataType: "script",
                            method: 'GET',
                        }).done(function () {
                            var city = returnCitySN.cname;
                            var value=$("#reply").val();
                            value=replace_em(value);
                            if (value.length>=1024*150){
                                $.alert({
                                    theme: 'modern',
                                    animation: 'news',
                                    closeAnimation: 'news',
                                    type: "red",
                                    title: '提示!',
                                    content: '超出限制大小150KB !',
                                });
                            }else{
                                $.ajax({
                                    type: "post",
                                    url: 'link/php/set-reply1.php',
                                    data: {"value":value,"location":city,"CommentLocation":CommentLocation,"name2":name2},
                                    success: function (data) {
                                        eval(data);
                                    },
                                });
                            }
                        });
                    }
                },
                关闭:{
                    btnClass: "btn-purple",
                //close
            },
        },
    });
}


