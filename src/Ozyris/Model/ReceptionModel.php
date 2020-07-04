<?php


namespace Ozyris\Model;


use Ozyris\Exception\ModelException;

class ReceptionModel extends AbstractModel
{

    const SQL_ERROR = "ReceptionModel : Une erreur s'est produite, veuillez réessayer ultérieurement.";

    /**
     * @param int $idUser
     * @param string $header
     * @param string $content
     * @param int $idAttachment
     * @param string $sender
     * @return bool
     * @throws ModelException
     */
    public function insertMessageByIdUser(int $idUser, string $header, string $content, int $idAttachment, string $sender)
    {
        $sql = "INSERT INTO reception (id_user, sender, header, content, id_attachment)
VALUES (:id_user, :sender, :header, :content, :id_attachment)";
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id_user', $idUser);
        $stmt->bindParam(':header', $header);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':id_attachment', $idAttachment);
        $stmt->bindParam(':sender', $sender);

        if (!$stmt->execute()) {
            $aSqlError = $stmt->errorInfo();
            throw new ModelException('insertMessageByIdUser : ' . $aSqlError[2]);
        }

        return $stmt->closeCursor();
    }

    /**
     * @param int $type
     * @param int $quantity
     * @return bool
     * @throws ModelException
     */
    public function insertAttachment(int $type, int $quantity)
    {
        $sql = "INSERT INTO attachments (attachment_type, quantity) VALUES (:attachment_type, :quantity)";
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':attachment_type', $type);
        $stmt->bindParam(':quantity', $quantity);

        if (!$stmt->execute()) {
            $aSqlError = $stmt->errorInfo();
            throw new ModelException($aSqlError[2]);
        }

        return $stmt->closeCursor();
    }

    /**
     * @param int $idUser
     * @return array
     * @throws ModelException
     */
    protected function selectMessagesAndAttachmentsByIdUser(int $idUser)
    {
        $sql = 'SELECT r.id, r.id_user, r.sender, r.header, r.content, r.readed, r.id_attachment, r.collected, r.date_reception, a.attachment_type, a.quantity 
FROM reception AS r INNER JOIN attachments AS a ON r.id_attachment = a.id WHERE r.id_user = :id_user';
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id_user', $idUser);

        if (!$stmt->execute()) {
            $aSqlError = $stmt->errorInfo();
            throw new ModelException($aSqlError[2]);
        }

        $aResult = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $aResult;
    }

    /**
     * @param int $idUser
     * @param int $readed
     * @return array
     * @throws ModelException
     */
    public function selectReadedMessages(int $idUser, int $readed)
    {
        $sql = 'SELECT * FROM reception WHERE id_user = :id_user AND readed = :readed';
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id_user', $idUser);
        $stmt->bindParam(':readed', $readed);

        if (!$stmt->execute()) {
            $aSqlError = $stmt->errorInfo();
            throw new ModelException($aSqlError[2]);
        }

        $aResults = $stmt->fetch();
        $stmt->closeCursor();

        return $aResults;
    }

    public function updateWatchedById(int $id)
    {

    }

    public function updateCollectedById(int $id)
    {

    }

    public function deleteMessageById(int $id)
    {

    }
}