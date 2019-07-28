$(function () {
    $("#main-form")[0].addEventListener("submit", function (event) {
        event.preventDefault();
    }, false);

    let data = {};
    let ok = {};
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
        const evtobj = window.event ? event : e;
        if (evtobj.keyCode === 90 && evtobj.ctrlKey && evtobj.shiftKey) {
            console.log(JSON.stringify(ok));
            console.log(JSON.stringify(data));
        }
    }
    document.onkeydown = KeyPress;
    
    $("input[type=submit]").click(function () {

        // verify all inputs
        let all_inputs_ok = true;
        for (const key in ok) {
            if (ok.hasOwnProperty(key)) {
                if (!ok[key]) {
                    all_inputs_ok = false;
                    let input = $("#" + key);
                    input.parent().siblings(".undertext").find(".undertext-info").hide();
                    input.parent().siblings(".undertext").find(".undertext-error").show();
                }
            }
        }

        if (! all_inputs_ok) {
            alert("not all fields are valid");
            console.log(data);
            return;
        }

        data["gender1"] = $('input[name="student-gender"]:checked').val();
        data["gender2"] = $('input[name="student-gender2"]:checked').val();
        data["grade1"] = $('input[name="student-class"]:checked').val();
        data["grade2"] = $('input[name="student-class2"]:checked').val();

        if (!(data["gender1"] && data["gender2"] && data["grade1"] && data["grade2"])) {
            alert("not all radio buttons are selected");
            console.log(data);
            return;
        }

        if (data["grade1"] == "9" || data["grade1"] == "10") {
            if (data["grade2"] == "11" || data["grade2" == "12"]) {
                alert("Students belong to different pools and cannot form a team");
                return;
            }
        }

        if (data["grade1"] == "11" || data["grade1"] == "12") {
            if (data["grade2"] == "9" || data["grade2" == "10"]) {
                alert("Students belong to different pools and cannot form a team");
                return;
            }
        }

        if (data['password_input'] !== data['password_repeat_input']) {
            alert("password mismatch");
            console.log(data);
            return;
        }

        // send ajax request to server
        $.ajax({
            type: "POST",
            url: "back/register_manager.php",
            data: data,
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data['status'] === "success") {
                    $("#mem1-confirm").text(data['name1']);
                    $("#mem2-confirm").text(data['name2']);
                    $("#techid1-confirm").text(data['techid1']);
                    $("#techid2-confirm").text(data['techid2']);
                    $("#city-confirm").text(data['city']);
                    $("#main-form").hide();
                    $("#success").show();
                } else if (data['status'] === "already present") {
                    alert("Error: Credentials taken: one of the emails is registered. Sign up aborted");
                }
                else if (data['status'] === "wrong") {
                    if (data['msg'] === "Params missing") {
                        $(data['erring_elmts_id']).parents().siblings(".undertext").find(".undertext-info").hide();
                        $(data['erring_elmts_id']).parents().siblings(".undertext").find(".undertext-error").show();
                        alert("some elements did not match expected input format, please correct them and try again");
                    } else if (data['msg'] === "incompatible pools") {
                        alert("Students belong to different pools and cannot form a team");
                    }
                } else if (data['status'] === "error") {
                    console.log(data);
                    alert("server error occurred, please try again after some time");
                }
            },
            error: function (data) {
                console.log(JSON.stringify(data));
            },
        });
    });
});