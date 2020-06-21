<?php


namespace Ozyris\Model;


use Ozyris\Exception\ModelException;

class CollectionModel extends AbstractModel
{

    const SQL_ERROR = "CollectionModel : Une erreur s'est produite, veuillez réessayer ultérieurement.";

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param int $idUser
     * @return array
     */
    public function getCollectionByIdUser($idUser)
    {
        // TODO récupérer id plutôt que id_card pour faciliter les requêtes
        $sql = 'SELECT a.id_card, a.pack, a.quantity, b.card_name, b.rarity FROM collections AS a 
INNER JOIN cardslist AS b ON a.id_card = b.id_card AND a.pack = b.pack WHERE id_user = :id_user';
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_user', $idUser);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new ModelException(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);// Permet de récupérer uniquement les tableaux associatifs
    }

    /**
     * @param int $idUser
     * @param int $idCard
     * @param int $pack
     * @param int $quantity
     * @return array|bool
     */
    public function insertCard($idUser, $idCard, $pack, $quantity = 1)
    {
        $sql = "INSERT INTO collections (id_user, id_card, pack, quantity) VALUES (:id_user, :id_card, :pack, :quantity)";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_user', $idUser);
            $stmt->bindParam(':id_card', $idCard);
            $stmt->bindParam(':pack', $pack);
            $stmt->bindParam(':quantity', $quantity);

            if (!$stmt->execute()) {
                //$aSqlError = $stmt->errorInfo();
                throw new ModelException(self::SQL_ERROR);
            }
        } catch(\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }

    /**
     * @param int $idUser
     * @param int $idCard
     * @param int $pack
     * @param int $quantity
     * @return bool
     */
    public function updateCardQuantity($idUser, $idCard, $pack, $quantity)
    {
        $sql = "UPDATE collections SET quantity = :quantity, date_registration = :date_registration WHERE id_card = :id_card AND pack = :pack AND id_user = :id_user";
        $stmt = $this->bdd->prepare($sql);
        $date = date('Y-m-d h:i:s');

        try {
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':id_card', $idCard);
            $stmt->bindParam(':pack', $pack);
            $stmt->bindParam(':id_user', $idUser);
            $stmt->bindParam(':date_registration', $date);

            if (!$stmt->execute()) {
                //$aSqlErrors = $stmt->errorInfo();
                throw new ModelException(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }
}