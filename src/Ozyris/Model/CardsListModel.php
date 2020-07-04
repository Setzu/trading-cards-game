<?php


namespace Ozyris\Model;


use Ozyris\Exception\ModelException;

class CardsListModel extends AbstractModel
{

    const SQL_ERROR = "CardsListModel : Une erreur s'est produite, veuillez réessayer ultérieurement.";

    /**
     * @param int $pack
     * @return array
     * @throws ModelException
     */
    protected function selectCardsByPack(int $pack)
    {
        $sql = "SELECT card_name, rarity FROM cardslist WHERE pack = :pack";
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':pack', $pack);

        if (!$stmt->execute()) {
//          $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        $aCardsList = [];

        while ($aCardsList[] = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            continue;
        }

        $stmt->closeCursor();
        array_pop($aCardsList);

        return $aCardsList;
    }

    /**
     * @return array
     * @throws ModelException
     */
    protected function selectCardsList()
    {
        $sql = "SELECT card_name, rarity FROM cardslist";
        $stmt = $this->bdd->prepare($sql);

        if (!$stmt->execute()) {
//          $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        $aCardsList = [];

        while ($aCardsList[] = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            continue;
        }

        $stmt->closeCursor();
        array_pop($aCardsList);

        return $aCardsList;
    }

    /**
     * @param int $pack
     * @param int $rarity
     * @return array
     * @throws ModelException
     */
    protected function selectCardsByPackAndRarity($pack, $rarity)
    {
        $sql = "SELECT card_name, rarity FROM cardslist WHERE pack = :pack, rarity = :rarity";
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':pack', $pack);
        $stmt->bindParam(':rarity', $rarity);

        if (!$stmt->execute()) {
//          $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        $aCardsList = [];

        while ($aCardsList[] = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            continue;
        }

        $stmt->closeCursor();
        array_pop($aCardsList);

        return $aCardsList;
    }

    /**
     * @param int $idCard
     * @param int $pack
     * @param int $rarity
     * @return array
     * @throws ModelException
     */
    protected function selectCard($idCard, $pack, $rarity)
    {
        $sql = "SELECT card_name, rarity FROM cardslist WHERE id_card = :id_card AND pack = :pack AND rarity = :rarity";
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id_card', $idCard);
        $stmt->bindParam(':pack', $pack);
        $stmt->bindParam(':rarity', $rarity);

        if (!$stmt->execute()) {
//          $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $idCard
     * @param int $pack
     * @return array
     * @throws ModelException
     */
    protected function selectCounterByIdAndPack($idCard, $pack)
    {
        $sql = "SELECT id, counter FROM cardslist WHERE id_card = :id_card AND pack = :pack";
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id_card', $idCard);
        $stmt->bindParam(':pack', $pack);

        if (!$stmt->execute()) {
//          $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }


        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @param int $counter
     * @return bool
     * @throws ModelException
     */
    protected function updateCounter($id, $counter)
    {
        $sql = "UPDATE cardslist SET counter = :counter WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':counter', $counter);

        if (!$stmt->execute()) {
//          $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        return $stmt->closeCursor();
    }
}