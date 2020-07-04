<?php


namespace Ozyris\Model;


use Ozyris\Exception\ModelException;

class CollectionModel extends AbstractModel
{

    const SQL_ERROR = "CollectionModel : Une erreur s'est produite, veuillez réessayer ultérieurement.";


    /**
     * @param int $idUser
     * @return array
     * @throws ModelException
     */
    public function selectCollectionByIdUser(int $idUser)
    {
        $sql = 'SELECT a.id_card, a.pack, a.quantity, b.card_name, b.rarity FROM collections AS a 
INNER JOIN cardslist AS b ON a.id_card = b.id_card AND a.pack = b.pack WHERE id_user = :id_user';
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id_user', $idUser);

        if (!$stmt->execute()) {
//          $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $idUser
     * @param int $pack
     * @return array
     * @throws ModelException
     */
    public function selectIdCardByIdUserAndPack(int $idUser, int $pack)
    {
        $sql = 'SELECT id_card FROM collections WHERE id_user = :id_user';
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id_user', $idUser);

        if (!$stmt->execute()) {
//          $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $idUser
     * @param int $idCard
     * @param int $pack
     * @param int $quantity
     * @return array|bool
     * @throws ModelException
     */
    public function insertCard($idUser, $idCard, $pack, $quantity = 1)
    {
        $sql = "INSERT INTO collections (id_user, id_card, pack, quantity) VALUES (:id_user, :id_card, :pack, :quantity)";
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id_user', $idUser);
        $stmt->bindParam(':id_card', $idCard);
        $stmt->bindParam(':pack', $pack);
        $stmt->bindParam(':quantity', $quantity);

        if (!$stmt->execute()) {
//          $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        return $stmt->closeCursor();
    }

    /**
     * @param int $idUser
     * @param int $idCard
     * @param int $pack
     * @param int $quantity
     * @return bool
     * @throws ModelException
     */
    public function updateCardQuantity(int $idUser, int $idCard, int $pack, int $quantity)
    {
        $sql = "UPDATE collections SET quantity = :quantity, date_registration = :date_registration WHERE id_card = :id_card AND pack = :pack AND id_user = :id_user";
        $stmt = $this->bdd->prepare($sql);
        $date = date('Y-m-d h:i:s');
        $stmt->bindParam(':id_card', $idCard);
        $stmt->bindParam(':pack', $pack);
        $stmt->bindParam(':id_user', $idUser);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':date_registration', $date);

        if (!$stmt->execute()) {
//          $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        return $stmt->closeCursor();
    }

    /**
     * @param int $iIdUser
     * @param int $iIdCard
     * @param int $iIdPack
     * @return array
     */
    public function selectCard(int $iIdUser, int $iIdCard, int $iIdPack)
    {
        $sql = 'SELECT a.id_card, a.pack, a.quantity, b.card_name, b.rarity FROM collections AS a INNER JOIN cardslist 
AS b ON a.id_card = b.id_card AND a.pack = b.pack WHERE id_user = :id_user AND a.id_card = :id_card AND a.pack = :pack';
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id_user', $iIdUser);
        $stmt->bindParam(':id_card', $iIdCard);
        $stmt->bindParam(':pack', $iIdPack);

        if (!$stmt->execute()) {
//          $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $iIdUser
     * @param int $iIdCard
     * @param int $iIdPack
     * @return bool
     * @throws ModelException
     */
    public function deleteCard(int $iIdUser, int $iIdCard, int $iIdPack)
    {
        $sql = 'DELETE FROM collections WHERE id_user = :id_user AND id_card = :id_card AND pack = :pack';
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id_user', $iIdUser);
        $stmt->bindParam(':id_card', $iIdCard);
        $stmt->bindParam(':pack', $iIdPack);

        if (!$stmt->execute()) {
//          $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        return $stmt->closeCursor();
    }
}