$(function () {
    var _cards = $('div.cards');
    var _commons = $("div.rarete-1");
    var _rares = $("div.rarete-2");
    var _ur = $("div.rarete-3");

    $('input.collection-filter').on("click", function () {
        if ($('input#common-cards').is(':checked')) {
            _commons.addClass('visible');
        } else {
            _commons.removeClass('visible');
        }
        if ($('input#rare-cards').is(':checked')) {
            _rares.addClass('visible');
        } else {
            _rares.removeClass('visible');
        }
        if ($('input#ur-cards').is(':checked')) {
            _ur.addClass('visible');
        } else {
            _ur.removeClass('visible');
        }
        _changeVisibility(_cards);
    });

    var _changeVisibility = function(card) {
        card.each(function() {
            if ($(this).hasClass('visible')) {
                $(this).parent().show();
            } else {
                $(this).parent().hide();
            }
        });
    }
});