<div class="standard-box">

    <div class="row justify-content-end" style="text-align: left; margin: 0; color: #FFFFFF;">
        <div class="col-4 box-actus">
            <?php foreach($this->aLastsURCards as $k => $aInfosCard) { ?>

                <p>
                    <?= \Ozyris\Service\Utils::formatDateToEU($aInfosCard['date_registration']) . ' : '
                    . '<strong>' . $aInfosCard['username'] . '</strong>' . ' a obtenu '
                    . '<strong>' . $aInfosCard['cardname'] . '</strong>'
                    . '<span class="rarity-title-3"> Ultra Rare</span>'; ?>
                </p>

            <?php } ?>
        </div>
    </div>

</div>
