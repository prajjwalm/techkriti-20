$(function () {
    $("#PAY").click(function () {
        $.ajax({
            type: "POST",
            url: "back/payment_manager.php",
            data: {},
            dataType: "json",
            success: function (data) {
                if (data['status'] === "success") {
                    console.log('my backend worked ok');
                    console.log(data);
                    $.ajax({
                        type: "POST",
                        url: "https://test.payu.in/_payment",
                        crossDomain: true,
                        data: data['payu_data'],
                        success: function (data) {
                            alert(JSON.stringify(data));
                        },
                        error: function (data) {
                            alert(JSON.stringify(data));
                        }
                    });
                }
            },
            error:function (data) {
                console.log("payment error");
                console.log(data);
            },
        });
    });
});