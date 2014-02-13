confirmWindow = function(text, yes, no) {
    var modal = $('#confirmModal');
    var label = $('#confirmModalLabel', modal);
    label.html(text);
    var body = $('.modal-body', modal);
    body.empty();
    $('<button/>', {
        'type': 'button',
        'class': 'btn btn-danger',
        'text': 'Нет!',
        'data-dismiss': 'modal',
        'aria-hidden': 'true',
        'click': function() {
            no();
        }
    }).appendTo(body);
    $('<button/>', {
        'type': 'button',
        'class': 'btn btn-success',
        'text': 'Да!',
        'data-dismiss': 'modal',
        'click': function() {
            yes();
        }
    }).appendTo(body);
    modal.modal('show');
};

jQuery(function($) {
    $('.url-delete-link').click(function() {
        var url = $(this);
        confirmWindow(
            'Вы уверены, что хотите удалить этот элемент?',
            function() {
                var parent = url.parent();
                var anime_id = parent.attr('anime-id');
                var site_id = parent.attr('site-id');
                $.ajax('/urls/delete', {
                    'type':'POST',
                    'cache':false,
                    'data':'anime_id='+anime_id+'&site_id='+site_id,
                    'success': function(data) {
                       $('#jgrowl').jGrowl(data);
                    }
                });
                url.parent().remove();
            },
            function() {

            }
        );
    });
    $('.url-edit-link').click(function() {
        var parent = $(this).parent();
        var anime_id = parent.attr('anime-id');
        var site_id = parent.attr('site-id');
        var url = $('a', parent).attr('href');
        var modal = $('#addUrlModal');
        var form = $('form', modal);
        $('[name="Urls[anime_id]"]', form).val(anime_id);
        $('[name="Urls[site_id]"]', form).val(site_id);
        $('[name="Urls[url]"]', form).val(url);
//        $('[name="Urls[site_id]"]', form).attr("disabled","disabled");
        $('#urlsEditbtn', form).show();
        $('#urlsAddbtn', form).hide();
        modal.modal('show');
    });
    $('.url-add-link').click(function() {
        var parent = $(this).parent();
        var anime_id = parent.attr('anime-id');
        var modal = $('#addUrlModal');
        var form = $('form', modal);
        $('[name="Urls[anime_id]"]', form).val(anime_id);
        $('[name="Urls[url]"]', form).val('');
        $('[name="Urls[site_id]"]', form).removeAttr("disabled");
        $('#urlsEditbtn', form).hide();
        $('#urlsAddbtn', form).show();
        modal.modal('show');
    });
});

