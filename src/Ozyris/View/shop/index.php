<div class="shop shop-box">
    <div class="row">
        <div class="col-lg-2">
            <?= $this->iMoney; ?>
            <svg class="bi bi-gem" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #ea2900;">
                <path fill-rule="evenodd" d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785l-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004l.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495l5.062-.005L8 13.366 5.47 5.495zm-1.371-.999l-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l2.92-.003 2.193 6.82L1.5 5.5zm7.889 6.817l2.194-6.828 2.929-.003-5.123 6.831z"/>
            </svg>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="pack">
            <p style="text-align: center;">Pack 1</p>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <form method="post" role="form" action="/shop/buyPack" id="buyPackForm" onsubmit="return confirmAction();">
                <input name="gems" id="gems" type="hidden" value="<?= $this->iMoney; ?>" />
                <input name="token" type="hidden" id="token" value="<?= $this->token; ?>" />
                <!-- A changer, récupérer les pack dynamiquement depuis la table packsList et faire foreach -->
                <input name="pack" type="hidden" id="pack" value="Pack 2" />
                <input name="idpack" type="hidden" id="idpack" value="2" />
                <button name="submit" type="submit" id="submit-buypack" class="btn btn-outline-warning">
                    <span><strong>100</strong>
                        <svg class="bi bi-gem" width="25" height="25" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #ea2900;">
                            <path fill-rule="evenodd" d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785l-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004l.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495l5.062-.005L8 13.366 5.47 5.495zm-1.371-.999l-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l2.92-.003 2.193 6.82L1.5 5.5zm7.889 6.817l2.194-6.828 2.929-.003-5.123 6.831z"/>
                        </svg>
                    </span>
                </button>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    document.getElementById("submit-buypack").disabled;
    /* Récupérer le prix des pack dynamiquement */
        var _gems = document.getElementById("gems").value - 100;

    if (_gems < 0) {
        document.getElementById("submit-buypack").disabled = true;
    }

    var _text = 'Etes-vous sur ? Rubis restants après achat : ' + _gems;
    var confirmAction = function() {
        return confirm(_text);
    }
</script>