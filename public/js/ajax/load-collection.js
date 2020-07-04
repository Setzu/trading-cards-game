$(function () {

    var _ajax = function() {
        $('div.ajax-loader').show();

        $.ajax({
            method: 'POST',
            url: '/collection/loadcollection',
            data: {
                action: 'loadcollection'
            },
            dataType: "html",
            success: function (data) {
                $('div#tabs-1').html(data);
                $('.ajax-loader').hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert('error');
                //alert(xhr.status);
                //alert(xhr.responseText);
                //alert(thrownError);
                $('div.ajax-loader').hide();
            }
        });
    }

    _ajax();

    $('a#link-tab1').on('click', function () {
        _ajax();
    });
});