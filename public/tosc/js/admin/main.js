$(function () {
    $("#submit").click(function () {
        let name = $("#name").val();
        let psd = $("#psd").val();

        let data = {
            name: name,
            password: psd,
        };

        $.ajax({
            type: "POST",
            url: "../back/admin.php",
            data: data,
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data['status'] === 'success') {
                    let tbl = $("#data table");
                    tbl.empty();
                    tbl.append("<thead><tr>");
                    let d = data['data'];
                    for (let key in d[0]) {
                        if (d[0].hasOwnProperty(key)) {
                            tbl.append(`<th>${key}</th>`);
                        }
                    }
                    tbl.append("</tr></thead><tbody>");

                    let tbody_str = "";
                    for (let i = 0; i < data['data'].length; i++) {
                        tbody_str += ("<tr>");
                        for (let key in d[i]) {
                            if (d[i].hasOwnProperty(key)) {
                                tbody_str += (`<td>${d[i][key]} </td>`);
                            }
                        }
                        tbody_str += ("</tr>")
                    }
                    tbody_str += ("</tbody>");
                    tbl.append(tbody_str);
                    $("#data").show();
                } else {
                    alert(data['status']);
                    alert(JSON.stringify(data));
                }
            },
            error:function (data) {
                console.log(data);
            },
        });
    });
});