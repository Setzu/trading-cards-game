<div class="align-items-start standard-box">
<?php if (empty($this->aCollection)) { ?>
    <h2>Vous ne possédez pas de cartes</h2>
    <a href="/shop">Boutique</a>
<?php } else { ?>
    <div id="tabs">
        <ul>
            <li><a id="link-tab1" href="#tabs-1">Vos cartes</a></li>
            <li><a id="link-tab2" href="#tabs-2">Tableau</a></li>
            <li><a id="link-tab3" href="#tabs-3">Cartes du Pack 2</a></li>
        </ul>
        <div id="tabs-1">
                <?php
                $aIdCards = [];
                foreach ($this->aCollection as $k => $aCard) {
                    ?>
                    <div class="card-container">
                        <div class="cards card-block" style="background-image: url(<?= '/../img/cartes/' . $this->aCardsConf['Pack 2']['Cartes']['Images'][$aCard['id_card']]; ?>)">
                            &nbsp;
                        </div>
                        <div class="description">
                            <p class="rarity-effect-<?= $aCard['rarity']?>"><?= $this->aCardsConf['Rareté'][$aCard['rarity']]?></p>
                        </div>
                    </div>
                <?php
                    $aIdCards[$aCard['id_card']] = $aCard['id_card'];
                }
                ?>
        </div>
        <div id="tabs-2" style="max-width: 800px; margin: 0 auto;">
            <table id="collection-table" class="table table-dark">
                <thead>
                <tr>
                    <th>Cartes</th>
                    <th>Pack</th>
                    <th>Rareté</th>
                    <th>Quantité</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->aCollection as $k => $aCard) { ?>
                    <tr>
                        <td><?= $aCard['card_name']; ?></td>
                        <td><?= $aCard['pack']; ?></td>
                        <td>
                            <p class="rarity-effect-<?= $aCard['rarity'];?>">
                                <?= $this->aCardsConf['Rareté'][$aCard['rarity']]?>
                            </p>
                        </td>
                        <td><?= $aCard['quantity']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div id="tabs-3">
            <?php foreach ($this->aCardsConf['Pack 2']['Cartes']['Noms'] as $id => $name) { ?>
                <div class="card-container">
                    <?php if (!array_key_exists($id, $aIdCards)) { ?>
                        <div class="cards card-block" title="<?= $name ?>" style="background-image: url(<?= '/../img/cartes/noir_et_blanc/' . $this->aCardsConf['Pack 2']['Cartes']['Images'][$id]; ?>)">
                            &nbsp;
                        </div>
                    <?php } else { ?>
                        <div class="cards card-block" title="<?= $name ?>" style="background-image: url(<?= '/../img/cartes/' . $this->aCardsConf['Pack 2']['Cartes']['Images'][$id]; ?>)">
                            &nbsp;
                        </div>
                    <?php } ?>
                    <div class="description">
                        <p>Rareté</p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
</div>

