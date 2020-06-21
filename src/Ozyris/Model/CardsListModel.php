<?php


namespace Ozyris\Model;


use Ozyris\Exception\ModelException;

class CardsListModel extends AbstractModel
{

    const SQL_ERROR = "CardsListModel : Une erreur s'est produite, veuillez réessayer ultérieurement.";

    /**
     * @param int $pack
     * @return array
     */
    protected function getCardsByPack($pack)
    {
        $sql = "SELECT card_name, rarity FROM cardslist WHERE pack = :pack";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':pack', $pack);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new ModelException(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
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
     */
    protected function getCardsList()
    {
        $sql = "SELECT card_name, rarity FROM cardslist";

        $stmt = $this->bdd->prepare($sql);

        try {
            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new ModelException(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
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
     */
    protected function getCardsByPackAndRarity($pack, $rarity)
    {
        $sql = "SELECT card_name, rarity FROM cardslist WHERE pack = :pack, rarity = :rarity";

        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':pack', $pack);
            $stmt->bindParam(':rarity', $rarity);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new ModelException(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
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
     */
    protected function getCard($idCard, $pack, $rarity)
    {
        $sql = "SELECT card_name, rarity FROM cardslist WHERE id_card = :id_card AND pack = :pack AND rarity = :rarity";

        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_card', $idCard);
            $stmt->bindParam(':pack', $pack);
            $stmt->bindParam(':rarity', $rarity);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new ModelException(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $idCard
     * @param int $pack
     * @return array
     */
    protected function getCounterByIdAndPack($idCard, $pack)
    {
        $sql = "SELECT id, counter FROM cardslist WHERE id_card = :id_card AND pack = :pack";

        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_card', $idCard);
            $stmt->bindParam(':pack', $pack);

            if (!$stmt->execute()) {
                // $aSqlErrors = $stmt->errorInfo();
                throw new ModelException(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @param int $counter
     * @return bool
     */
    protected function incrementCounterById($id, $counter)
    {
        $sql = "UPDATE cardslist SET counter = :counter WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':counter', $counter);

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