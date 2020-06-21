<?php ?>
<div class="new-card-box">
    <div class="row justify-content-md-center" style="margin-bottom: 20px;">
    <?php foreach ($this->aComparedCards as $idCard => $aInfoCard) { ?>
        <div class="zoom" style="margin: 0 20px 50px; text-align: center;">
            <p style="float: right;" class="rarity-effect-<?= $aInfoCard['rarity']; ?>">
                <?php
                if ($aInfoCard['rarity'] > 1) {
                    echo $this->aCardsConf['Rareté'][$aInfoCard['rarity']];
                }
                ?>
            </p>
            <?php if (!$aInfoCard['double']) { ?>
            <p class="new-card-text" style="float: left">New</p>
            <?php } ?>
            <div class="shop-card" style="background-image: url('<?= '/../img/cartes/' . $this->aCardsConf['Pack 2']['Cartes']['Images'][$idCard] ?>');"></div>
            <span class="card-name">
                <?php
                echo $this->aCardsConf['Pack 2']['Cartes']['Noms'][$idCard];

                if ($aInfoCard['quantity'] > 1) {
                    echo ' x' . $aInfoCard['quantity'];
                }
                ?>
            </span>
        </div>
    <?php } ?>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <a href="/shop" class="btn btn-success">Retour</a>
        </div>
        <div class="col-md-auto">
            <a href="/collection" class="btn btn-primary">Mes cartes</a>
        </div>
    </div>
</div>