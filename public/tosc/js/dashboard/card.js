$(function () {
    $(".row").click(function () {
        $(this).toggleClass('selected');
        let name = $(this).attr('id');
        if ($(this).hasClass('selected')) {
            $('.c_' + name).show();
        } else {
            $('.c_' + name).hide();
        }
    });

    $(".card-m .close").click(function () {
        let card = $(this).parent();
        card.hide();
        /*let classes = card.attr('class').split(/\s+/);
        let name = "";
        for (let i = 0; i < classes.length; i++) {
            if (classes[i].startsWith('c_')) {
                name = classes[i].substring(2);
            }
        }
        alert(name);
        if (name === "") return;
        let tab = $('#' + name);
        if(tab.children(':hidden').length === 0) {
            // action when all are hidden
            tab.removeClass('selected');
        }*/
    });
});