<?php


namespace Ozyris\Model;


class RessourcesModel extends AbstractModel
{

    const SQL_ERROR = "Une erreur s'est produite, veuillez réessayer ultérieurement.";

    /**
     * @param $iIdUser
     * @return int
     */
    public function getMoneyByIdUser($iIdUser)
    {
        $sql = "SELECT money FROM ressources WHERE id_user = :id_user";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_user', $iIdUser);

            if (!$stmt->execute()) {
//                $aSqlError = $stmt->errorInfo();
                throw new \Exception(self::SQL_ERROR);
            }
        } catch(\Exception $e) {
            die($e->getMessage());
        }

        return (int) $stmt->fetchColumn();
    }

    /**
     * @param $idUser
     * @param $montant
     * @return bool
     */
    public function insertMoneyByIdUser($idUser, $montant)
    {
        $sql = "INSERT INTO ressources (id_user, money, operation) VALUES (:id_user, :money, :operation)";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_user', $idUser);
            $stmt->bindParam(':money', $montant);
            $stmt->bindParam(':operation', $montant);

            if (!$stmt->execute()) {
                echo '<pre>'; var_dump($stmt->errorInfo()); echo'</pre>'; die;
//                $aSqlError = $stmt->errorInfo();
                throw new \Exception(self::SQL_ERROR);
            }
        } catch(\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }

    /**
     * Mise à jour des gemmes de l'utilisateur
     *
     * @param int $idUser
     * @param int $montant
     * @return bool
     */
    public function updateMoneyByIdUser($idUser, $montant)
    {
        $sql = "UPDATE ressources SET money = :money, operation = :operation WHERE id_user = :id_user";
        $stmt = $this->bdd->prepare($sql);

        $iOldMoney = $this->getMoneyByIdUser($idUser);
        $iMoney = $iOldMoney + $montant;

        if ($iMoney >= 0) {

            try {
                $stmt->bindParam(':id_user', $idUser);
                $stmt->bindParam(':money', $iMoney);
                $stmt->bindParam(':operation', $montant);

                if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                    throw new \Exception(self::SQL_ERROR);
                }

            } catch (\Exception $e) {
                die($e->getMessage());
            }

            return $stmt->closeCursor();

        } else {
            return false;
        }
    }
}