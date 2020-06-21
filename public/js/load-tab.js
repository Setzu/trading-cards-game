$(function () {

    $('a#link-tab2').on('click', function () {

        $.ajax({
            method: 'POST',
            url: '/collection/tab',
            data: {
                action: 'tab'
            },
            dataType: 'html',
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
});