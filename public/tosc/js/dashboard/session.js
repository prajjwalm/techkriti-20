$(function () {
    function KeyPress(e) {
        let evt_obj = window.event ? event : e;
        if (evt_obj.keyCode === 90 && evt_obj.ctrlKey && evt_obj.shiftKey) {
            $.ajax({
                type: "POST",
                url: "back/show_session.php",
                data: null,
                dataType: "text",
                success: function (data) {
                    console.log(JSON.stringify(data));
                },
                error: function (data) {
                    console.log("bad");
                    console.log(JSON.stringify(data));
                },
            });
        }
    }

    document.onkeydown = KeyPress;
});