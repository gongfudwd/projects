function visits() {
    $.ajax({
        type: "post",
        url: 'link/php/visit.php',
        success: function (data) {
            $("#visit").html(data);
        },
    });
}