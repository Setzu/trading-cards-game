$(function () {
    var _cards = $('div.cards');
    var _commons = $("div.rarete-1");
    var _rares = $("div.rarete-2");
    var _ur = $("div.rarete-3");

    $('input.packs-filter').on("click", function () {
        // Affichage des cartes manquantes, prend en compte les inputs de rareté
        if ($('input#missing-cards').is(':checked')) {
            _cards.removeClass('visible');

            if ($('input#packs-common-cards').is(':checked')) {
                $('div.missing.rarete-1').addClass('missing-visible');
            } else {
                $('div.missing.rarete-1').removeClass('missing-visible');
            }
            if ($('input#packs-rare-cards').is(':checked')) {
                $('div.missing.rarete-2').addClass('missing-visible');
            } else {
                $('div.missing.rarete-2').removeClass('missing-visible');
            }
            if ($('input#packs-ur-cards').is(':checked')) {
                $('div.missing.rarete-3').addClass('missing-visible');
            } else {
                $('div.missing.rarete-3').removeClass('missing-visible');
            }
            // Affichage des cartes par rareté, prend en compte l'input missing-cards
        } else {
            _cards.removeClass('missing-visible');

            if ($('input#packs-common-cards').is(':checked')) {
                $(_commons).addClass('visible');
            } else {
                $(_commons).removeClass('visible');
            }
            if ($('input#packs-rare-cards').is(':checked')) {
                $(_rares).addClass('visible');
            } else {
                $(_rares).removeClass('visible');
            }
            if ($('input#packs-ur-cards').is(':checked')) {
                $(_ur).addClass('visible');
            } else {
                $(_ur).removeClass('visible');
            }
        }

        _changeVisibility(_cards);
    });

    var _changeVisibility = function(card) {
        card.each(function() {
            if ($(this).hasClass('missing-visible')) {
                $(this).parent().show();
            } else if ($(this).hasClass('visible')) {
                $(this).parent().show();
            } else {
                $(this).parent().hide();
            }
        });
    }
});