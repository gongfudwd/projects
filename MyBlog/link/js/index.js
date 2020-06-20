function activeIn() {
$("#activeIn").animate({height:"200px",width:"400px","margin-left":"-200px","margin-top":"-100px","font-size":"32px"},1000);
}
function shadow() {
$("#shadow").animate({opacity:"0.4"},1000);
}
function activeBtn1() {

    $("#actBtn1").hover(function(){
        $(this).css("background-color","#43B600");
    },function(){
        $(this).css("background-color","transparent");
    });
}
function activeBtn2() {
    $("#actBtn2").hover(function(){
        $(this).css("background-color","#43B600");
    },function(){
        $(this).css("background-color","transparent");
    });
}
function move1() {
    $("html,body").animate({scrollTop: $("#informationArea").offset().top}, 500);
}
