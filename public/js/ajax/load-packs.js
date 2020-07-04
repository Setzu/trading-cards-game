$(function () {
    $('a#link-tab3').on('click', function () {
        $('div.ajax-loader').show();

        $.ajax({
            method: 'POST',
            url: '/collection/loadpacks',
            data: {
                action: 'loadpacks'
            },
            dataType: "html",
            success: function (data) {
                $('div#tabs-3').html(data);
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
    });
});