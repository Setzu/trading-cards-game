/*
$('#buyPackForm').submit(function () {
    var request = $.ajax({
        url: '/shop/updateMoney',
        method: "POST",
        statusCode: {
            404: function() {
                alert( "page not found" );
            }
        }
    });

    request.done(function(data) {
        if (console && console.log) {
            console.log(data);
        }
    });

    request.fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
    });
});
*/

/*
$(function () {
    $('#buyPackForm').on('click', function () {
        $.ajax({
            method: 'POST',
            url: '/shop/updateMoney',
            dataType: 'text',
            success: function (request_data) {
                console.log(request_data);
                $('a#money').val(request_data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText);
                console.log(textStatus);
                //alert(textStatus);
                //alert(jqXHR.responseText);
            }
        });
    });
});
*/
