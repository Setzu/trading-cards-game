<div class="standard-box">
    <table id="reception-table" class="table table-dark">
        <thead>
            <tr>
                <th></th>
                <th>Date de réception</th>
                <th>Expéditeur</th>
                <th>Sujet</th>
                <th>Message</th>
                <th>Pièces jointes</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->aMessages as $k => $aInfosMessages) { ?>
                <tr>
                    <td><input type="checkbox" value="<?= $aInfosMessages['id']; ?>"></td>
                    <td><?= \Ozyris\Service\Utils::formatDateForReception($aInfosMessages['date_reception']); ?></td>
                    <td><?= $aInfosMessages['sender']; ?></td>
                    <td><?= $aInfosMessages['header']; ?></td>
                    <td><?= $aInfosMessages['content']; ?></td>
                    <td>
                        <a href="/Reception/collectattachment">
                            <?= (!$aInfosMessages['id_attachment']) ?: $this->aAttachmentsType[$aInfosMessages['attachment_type']]; ?>
                        </a>
                    </td>
                    <td>
                        <a href="/Reception/delete">
                            <svg width="32" height="32" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" src="/js/reception-datatable.js"></script>