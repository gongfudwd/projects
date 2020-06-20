function readyConfirm(user) {
    if (user==null){
        $.alert({
            theme: 'modern',
            animation: 'news',
            closeAnimation: 'news',
            type:"red",
            title: '提示!',
            content: '请先登录 !',
        });
    }else {
        $.confirm({
            theme: 'modern',
            boxWidth: '30%',
            useBootstrap: false,
            title:"设置",
            content:
                '<div>'+
                '<span>标题</span><input type="text" class="form-control" id="title">'+
                '<div align="left">类型  <select id="type"><option value="PHP">PHP</option><option value="HTML/CSS">HTML/CSS</option>' +
                '<option value="JavaScript">JavaScript</option><option value="MySql">生活</option>生活</select></div>'+
                '<div align="left">博客出处  <select id="copyright"><option value="原创">原创</option><option value="转载">转载</option></div>'+
                '<div><textarea class="form-control" style="height: 100px" id="brief" placeholder="请输入简介"></textarea></div>'+
                '<div><span>选择预览图标</span><input type="file" id="file"></div>'+
                '</div>',
            buttons: {
                设置:{
                    btnClass: 'btn-blue',
                    action: function(){
                        var file=$("#file")[0].files[0];
                        var title=$("#title").val();
                        var type=$("#type").val();
                        var brief=$("#brief").val();
                        var copyright=$("#copyright").val();
                        if (title===""||type===""||brief===""||copyright===""||file===""){
                            $.confirm({
                                theme: 'modern',
                                animation: 'news',
                                closeAnimation: 'news',
                                type:"red",
                                title: '提示!',
                                content: '设置结果不能为空 !',
                                buttons:{
                                    确定:{
                                        action:function () {
                                            readyConfirm(user);
                                        }
                                    }
                                }
                            });

                        }else {
                            if (validate_img($("#file")[0])==="type"){
                                $.confirm({
                                    theme: 'modern',
                                    animation: 'news',
                                    closeAnimation: 'news',
                                    type:"red",
                                    title: '提示!',
                                    content: '文件类型为图片格式 !',
                                    buttons:{
                                        确定:{
                                            action:function () {
                                                readyConfirm(user);
                                            }
                                        }
                                    }
                                });
                            }else if (validate_img($("#file")[0])==="size"){
                                $.confirm({
                                    theme: 'modern',
                                    animation: 'news',
                                    closeAnimation: 'news',
                                    type:"red",
                                    title: '提示!',
                                    content: '文件大小超出600kb !',
                                    buttons:{
                                        确定:{
                                            action:function () {
                                                readyConfirm(user);
                                            }
                                        }
                                    }
                                });
                            }else if (validate_img($("#file")[0])==="true"){
                                if (window.FileReader){
                                    var reader=new FileReader();
                                    reader.readAsDataURL(file);
                                    reader.onloadend=function (e) {
                                        $("#blogFile").attr("src",e.target.result);
                                    };
                                }
                                var name=user;
                                var time=new Date();
                                $("#TITLE").append(title);
                                $("#USER").append(name);
                                $("#TIME").append("&nbsp;"+time.getFullYear()+"-"+time.getMonth()+"-"+time.getDate()+" "+time.getHours()+"-"+time.getMinutes()+"-"+time.getSeconds());
                                $("#TIME1").append(time.getMonth()+"月 "+time.getFullYear());
                                $("#TIME2").append(time.getDate());
                                $("#blogTitle").html(title);    $("#blogName").html(name);
                                $("#blogDate").html(time.getFullYear()+"-"+time.getMonth()+"-"+time.getDate()+" "+time.getHours()+":"+time.getMinutes()+":"+time.getSeconds());
                                $("#blogTime1").html(time.getMonth()+"月 "+time.getFullYear());
                                $("#blogTime2").html(time.getDate());    $("#blogBrief").html(brief);
                                $("#blogType").html(type);    $("#blogCopyright").html(copyright);
                            }

                        }

                    }
                },

            },
        });
    }
}
function previews(){
    var values = $('#summernote').summernote('code');
    $("#blogs-values").html(values);
    $("#preview").css("display","none");
    $("#vim").css("display","none");
    $("#recover").css("display","");
}
function recover(){
    $("#blogs-values").html("");
    $("#preview").css("display","");
    $("#vim").css("display","");
    $("#recover").css("display","none");
}
function create() {

    var markupStr=$('#summernote').summernote('code');
    var blogTitle=$("#blogTitle").html();    var blogName=$("#blogName").html();
    var blogDate=$("#blogDate").html();    var blogTime1=$("#blogTime1").html();
    var blogTime2=$("#blogTime2").html();    var blogBrief=$("#blogBrief").html();
    var blogType=$("#blogType").html();    var blogCopyright=$("#blogCopyright").html();
    var blogFile=$("#blogFile")[0].files[0];
    var form=new FormData();
    form.append('file',blogFile); form.append("value",markupStr);
    form.append("blogTitle",blogTitle); form.append("blogName",blogName);
    form.append("blogDate",blogDate); form.append("blogTime1",blogTime1);
    form.append("blogTime2",blogTime2); form.append("blogBrief",blogBrief);
    form.append("blogType",blogType); form.append("blogCopyright",blogCopyright);
    alert("dsdsdsd");

    $.ajax({
        type: "post",
        url: 'link/php/.php',
        data: form,
        success: function (data) {
            eval(data);
        },
    });
}

function validate_img(ele){
    // 返回 KB，保留小数点后两位
    //alert((ele.files[0].size/(1024*1024)).toFixed(2));
    var file = ele.value;
    if(((ele.files[0].size).toFixed(2))>=(600*1024)){
        return "size";
    }
    if(!/.(gif|jpg|jpeg|png|GIF|JPG|PNG)$/.test(file)){
        return "type";
    }else{
        //alert((ele.files[0].size).toFixed(2));
        //返回Byte(B),保留小数点后两位
        return "true";
    }
}

function createHtml() {
    $.ajax({
        type: "post",
        url: 'link/php/windows-loaction.php',
        data: {"html":"create.html"},
        success: function (data) {
            window.location.href="Connect2.1/oauth/index.php";
        },
    });
}