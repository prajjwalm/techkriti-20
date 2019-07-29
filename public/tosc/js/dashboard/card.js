$(function () {
    $(".row").click(function () {
        $(".card-s, .card-m, .card-l").addClass('hidden');
        if ($(this).hasClass('selected')) {
            $('.row').removeClass('selected');
        } else {
            $('.row').removeClass('selected');
            $(this).addClass('selected');
            let name = $(this).attr('id');
            $('.c_' + name).removeClass('hidden');
        }
    });

    $(".card-s .close, .card-m .close, .card-l .close").click(function () {
        let card = $(this).parent();
        card.addClass('hidden');
        let classes = card.attr('class').split(/\s+/);
        let name = "";
        for (let i = 0; i < classes.length; i++) {
            if (classes[i].startsWith('c_')) {
                name = classes[i].substring(2);
            }
        }
        if (name === "") return;
        let tab = $('#' + name);
        if(tab.children('.hidden').length === 0) {
            // action when all are hidden
            tab.removeClass('selected');
        }
    });
});