<?php if (empty($this->aCollection)) { ?>
    <div style="margin: 0 auto;">
        <h2>Vous ne possédez pas de cartes</h2>
        <a href="/shop">Boutique</a>
    </div>
<?php } else { ?>
    <div style="margin-bottom: 20px;">
        <input type="checkbox" name="common-cards" id="common-cards" class="collection-filter" checked/>&nbsp;
        <label for="common-cards" class="form-check-label" style="font-size: 20px;">Communes</label>
        &nbsp;&nbsp;
        <input type="checkbox" name="rare-cards" id="rare-cards" class="collection-filter" checked/>&nbsp;
        <label for="rare-cards" class="form-check-label" style="font-size: 20px;">Rares</label>
        &nbsp;&nbsp;
        <input type="checkbox" name="ur-cards" id="ur-cards" class="collection-filter" checked/>&nbsp;
        <label for="ur-cards" class="form-check-label" style="font-size: 20px;">Ultra rares</label>
    </div>
    <?php foreach ($this->aCollection as $k => $aCard) { ?>
        <div class="card-container">
            <div class="cards visible <?= 'rarete-' . $aCard['rarity']; ?>" style="background-image: url(<?= '/../img/cartes/' . $this->aCardsConf['Packs'][1]['Cartes'][$aCard['id_card']]['Image']; ?>)">
                &nbsp;
            </div>
            <div class="row" style="margin: auto 0 auto 0;">
                <div class="col">
                    <p style="width: max-content;" class="rarity-title-<?= $aCard['rarity']; ?>"><?= $this->aCardsConf['Rareté'][$aCard['rarity']]; ?></p>
                </div>
                <?php if ($aCard['quantity'] > 1) { ?>
                    <div title="Quantité" class="col" style="text-align: right">
                        <svg class="bi bi-files" width="24" height="24" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3z"/>
                            <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z"/>
                        </svg>
                        <p style="float: right; margin-bottom: 0;"><?= $aCard['quantity']; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>

<script type="text/javascript" src="/js/sort-collection.js"></script>