$(function () {
    $("#main-form")[0].addEventListener("submit", function (event) {
        event.preventDefault();
    }, false);
    
    var data = {};
    var ok = {};
    $(".xinput").each(function () {
        ok[$(this).attr('id')] = !$(this).prop('required');
        $(this).on('input', function () {
            let isOk = $(this)[0].validity.valid;
            ok[$(this).attr('id')] = isOk;
            data[$(this).attr('id')] = $(this).val();
            if (isOk) {
                $(this).parent().siblings(".undertext").find(".undertext-error").hide();
                $(this).parent().siblings(".undertext").find(".undertext-info").show();
            }
        });
    });

    function KeyPress(e) {
        var evtobj = window.event? event : e;
        if (evtobj.keyCode == 90 && evtobj.ctrlKey && evtobj.shiftKey) {
            console.log(JSON.stringify(ok));
            console.log(JSON.stringify(data));
        }
    }
    document.onkeydown = KeyPress;
    
    $("input[type=submit]").click(function () {
        // now check if the remaining form inputs are ok, if so call ajax
        let all_finputs_ok = true;
        for (const key in ok) {
            if (ok.hasOwnProperty(key)) {
                if (!ok[key]) {
                    all_finputs_ok = false;
                    $("#" + key).parent().siblings(".undertext").find(".undertext-info").hide();
                    $("#" + key).parent().siblings(".undertext").find(".undertext-error").show();
                }
            }
        }

        // send ajax request to server
        if (all_finputs_ok) {

            data["gender1"] = $('input[name="student-gender"]:checked').val();
            data["gender2"] = $('input[name="student-gender2"]:checked').val();
            data["grade1"] = $('input[name="student-class"]:checked').val();
            data["grade2"] = $('input[name="student-class2"]:checked').val();

            if (data["gender1"] && data["gender2"] && data["grade1"] && data["grade2"]) {

                $.ajax({
                    type: "POST",
                    url: "back/login_manager.php",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        if (data['status'] === "success") {
                            $("#team-confirm").text(data['team']);
                            $("#mem1-confirm").text(data['name1']);
                            $("#mem2-confirm").text(data['name2']);
                            $("#techid1-confirm").text(data['techid1']);
                            $("#techid2-confirm").text(data['techid2']);
                            $("#main-form").hide();
                            $("#success").show();
                        } else if (data['status'] === "already present") {
                            alert("Error: Credentials taken: either the team name is taken or one of the emails is " +
                                "registered. Sign up aborted");
                        }
                        else if (data['status'] === "wrong") {
                            if (data['msg'] === "Params missing") {
                                $(data['erring_elmts_id']).parents().siblings(".undertext").find(".undertext-info").hide();
                                $(data['erring_elmts_id']).parents().siblings(".undertext").find(".undertext-error").show();
                                alert("some elements did not match expected input format, please correct them and try again");
                            }
                        } else if (data['status'] === "error") {
                            alert("server error occurred, please try again after some time");
                        }
                    },
                    error: function (data) {
                        console.log(JSON.stringify(data));
                    },
                });
            } else {
                alert("not all radio buttons are selected");
                console.log(data);
            }

        } else {
            alert("not all fields are valid");
        }
    });
});