$(function () {
    $("#to_dashboard").click(function () {
        $("#modal-shadow").show();
    });

    $(document).keyup(function(e) {
        if (e.key === "Escape") { // escape key maps to keycode `27`
            $("#modal-shadow").hide();
        }
    });

    $(document).mouseup(function (e) {
        let modal = $("#modal-login");
        if (!modal.is(e.target) && modal.has(e.target).length === 0) {
            $("#modal-shadow").hide();
        }
    });

    $("#login_submit").click(function () {
        let email = $("#email_input").val();
        let psd = $("#password_input").val();

        let data = {
            email: email,
            password: psd,
        };

        $.ajax({
            type: "POST",
            url: "back/login_manager.php",
            data: data,
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data['status'] === 'success') {
                    window.location.replace("dashboard.php");
                } else if (data['status'] === 'wrong') {
                    alert("Couldn't Login. Either the email or the password is incorrect");
                } else if (data['status'] === 'error') {
                    alert("server error occurred, please try again later");
                }
            },
            error:function (data) {
                console.log(data);
            },
        });
    });
});