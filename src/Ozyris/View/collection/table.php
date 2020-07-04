<table id="collection-table" class="table table-dark">
    <thead>
    <tr>
        <th></th>
        <th>Cartes</th>
        <th>Pack</th>
        <th>Rareté</th>
        <th>Quantité</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->aCollection as $k => $aCard) { ?>
        <tr class="pack-<?= $aCard['pack']; ?> id-<?= $aCard['id_card']; ?>">
            <td style="background-size: contain; background-repeat: no-repeat; background-image: url('<?= '/../img/cartes/' . $this->aCardsConf['Packs'][$aCard['pack']]['Cartes'][$aCard['id_card']]['Image']; ?>');"></td>
            <td><?= $aCard['card_name']; ?></td>
            <td><?= $this->aCardsConf['Packs'][$aCard['pack']]['Nom']; ?></td>
            <td>
                <p style="width: max-content;" class="rarity-title-<?= $aCard['rarity'];?>">
                    <?= $this->aCardsConf['Rareté'][$aCard['rarity']]?>
                </p>
            </td>
            <td class="quantity" style="text-align: center;"><?= $aCard['quantity']; ?></td>
            <td>
                <button class="btn btn-outline-warning test">
                    <span class="id-card" hidden><?= $aCard['id_card']; ?></span>
                    <span class="pack" hidden><?= $aCard['pack']; ?></span>
                    <input type="hidden" name="idCard" class="id-card" value="<?= $aCard['id_card']; ?>">
                    <input type="hidden" name="idPack" class="pack" value="<?= $aCard['pack']; ?>">
                    <?= $this->aCardsConf['Revente'][$aCard['rarity']]; ?>
                    <svg class="bi bi-gem" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #ea2900;">
                        <path fill-rule="evenodd" d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785l-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004l.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495l5.062-.005L8 13.366 5.47 5.495zm-1.371-.999l-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l2.92-.003 2.193 6.82L1.5 5.5zm7.889 6.817l2.194-6.828 2.929-.003-5.123 6.831z"/>
                    </svg>
                </button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<script type="text/javascript" src="/js/ajax/selling.js"></script>
<script type="text/javascript" src="/js/collection-datatable.js"></script>