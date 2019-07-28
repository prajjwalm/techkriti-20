$(function () {
    $("#sign_out").click(function () {
        $.ajax({
            type: "POST",
            url: "back/destroy.php",
            data: {},
            success: function () {
                location.href="index.php";
            },
            error:function () {
                console.log("sign out failed");
            },
        });
    });
});