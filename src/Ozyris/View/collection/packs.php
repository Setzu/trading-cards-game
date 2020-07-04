<div style="margin-bottom: 20px;">
    <input type="checkbox" name="packs-common-cards" id="packs-common-cards" class="packs-filter" checked/>&nbsp;
    <label for="packs-common-cards" class="form-check-label" style="font-size: 20px;">Communes</label>
    &nbsp;&nbsp;
    <input type="checkbox" name="packs-rare-cards" id="packs-rare-cards" class="packs-filter" checked/>&nbsp;
    <label for="packs-rare-cards" class="form-check-label" style="font-size: 20px;">Rares</label>
    &nbsp;&nbsp;
    <input type="checkbox" name="packs-ur-cards" id="packs-ur-cards" class="packs-filter" checked/>&nbsp;
    <label for="packs-ur-cards" class="form-check-label" style="font-size: 20px;">Ultra rares</label>
    &nbsp;&nbsp;
    <input type="checkbox" name="missing-cards" id="missing-cards" class="packs-filter"/>&nbsp;
    <label for="missing-cards" class="form-check-label" style="font-size: 20px;">Non obtenues</label>
</div>
<!-- TODO : Récupérer l'id du pack dynamiquement -->
<?php foreach ($this->aCardsConf['Packs'][1]['Cartes'] as $id => $infos) { ?>
    <div class="card-container">
        <?php if (!array_key_exists($id, $this->aCollection)) { ?>
            <div class="cards missing visible <?= 'rarete-' . $infos['Rareté']; ?>" title="<?= $infos['Nom']; ?>" style="background-image: url(<?= '/../img/cartes/noir_et_blanc/' . $this->aCardsConf['Packs'][1]['Cartes'][$id]['Image']; ?>)">
                &nbsp;
            </div>
        <?php } else { ?>
            <div class="cards visible <?= 'rarete-' . $infos['Rareté']; ?>" title="<?= $infos['Nom']; ?>" style="background-image: url(<?= '/../img/cartes/' . $this->aCardsConf['Packs'][1]['Cartes'][$id]['Image']; ?>)">
                &nbsp;
            </div>
        <?php } ?>
        <p style="font-weight: bold; width: max-content; margin: 0 auto;" class="rarity-title-<?= $infos['Rareté']; ?>"><?= $this->aCardsConf['Rareté'][$infos['Rareté']]; ?></p>
    </div>
<?php } ?>

<script type="text/javascript" src="/js/sort-packs.js"></script>