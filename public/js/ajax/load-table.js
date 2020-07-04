$(function () {
    $('a#link-tab2').on('click', function () {
        $('div.ajax-loader').show();

        $.ajax({
            method: 'POST',
            url: '/collection/loadtable',
            data: {
                action: 'loadtable'
            },
            dataType: "html",
            success: function (data) {
                $('div#tabs-2').html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert('error');
                //alert(xhr.status);
                //alert(xhr.responseText);
                //alert(thrownError);
            }
        });
    });
    $('div.ajax-loader').hide();
});