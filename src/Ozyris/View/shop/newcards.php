<?php ?>
<div class="standard-box">
    <div class="row justify-content-md-center">
    <?php foreach ($this->aComparedCards as $idCard => $aInfoCard) { ?>
        <div class="zoom" style="margin: 0 20px 50px; text-align: center; z-index: 1;">
            <p style="float: right;" class="rarity-title-<?= $aInfoCard['rarity']; ?>">
                <?php
                if ($aInfoCard['rarity'] > 1) {
                    echo $this->aCardsConf['Rareté'][$aInfoCard['rarity']];
                }
                ?>
            </p>
            <?php if (!$aInfoCard['double']) { ?>
            <p class="new-card-text" style="float: left">New</p>
            <?php } ?>
            <div class="cards" style="background-image: url('<?= '/../img/cartes/' . $this->aCardsConf['Packs'][$this->idPack]['Cartes'][$idCard]['Image'] ?>');"></div>
            <span class="card-name">
                <?php
                echo $this->aCardsConf['Packs'][$this->idPack]['Cartes'][$idCard]['Nom'];

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