$(function () {
    $('.test').on('click', function () {
        if (confirm('Confirmer l\'échange contre gemmes ?')) {
            $('div.ajax-loader').show();
            var _idCard = $(this).find('span.id-card').text();
            var _idPack = $(this).find('span.pack').text();

            $.post("/collection/selling", {idCard: _idCard, idPack: _idPack})
                .done(function (jsondata) {
                    var data = JSON.parse(jsondata)

                    if (data.redirection) {
                        window.location.href = data.redirection;
                    } else {
                        var _tr = 'tr.id-' + data.idCard + '.pack-' + data.idPack

                        if (data.quantity == 0) {
                            $(_tr).remove();
                        } else {
                            $(_tr).find('td.quantity').html(data.quantity);
                        }

                        $('span#rubis').html(data.rubis);
                        window.location.href = '/collection';
                    }
                    $('div.ajax-loader').hide();

                    // TODO ajouter message de confirmation dans une div html
                });
        }
    });
});