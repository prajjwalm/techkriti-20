$(function () {
    $("#PAY").click(function () {
        $.ajax({
            type: "POST",
            url: "back/payment_manager.php",
            data: {},
            dataType: "json",
            success: function (data) {},
            error:function (data) {
                console.log("payment error");
                console.log(data);
            },
        });
    });
});