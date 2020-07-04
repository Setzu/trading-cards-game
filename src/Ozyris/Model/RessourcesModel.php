<?php


namespace Ozyris\Model;


use Ozyris\Exception\ModelException;

class RessourcesModel extends AbstractModel
{

    const SQL_ERROR = "Une erreur s'est produite, veuillez réessayer ultérieurement.";

    /**
     * @param int $iIdUser
     * @return int
     * @throws ModelException
     */
    public function selectRubisByIdUser(int $iIdUser)
    {
        $sql = "SELECT rubis FROM ressources WHERE id_user = :id_user";
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id_user', $iIdUser);

        if (!$stmt->execute()) {
//                $aSqlError = $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        return (int) $stmt->fetchColumn();
    }

    /**
     * @param int $idUser
     * @param int $montant
     * @return bool
     * @throws ModelException
     */
    public function insertRubisByIdUser(int $idUser, int $montant)
    {
        $sql = "INSERT INTO ressources (id_user, rubis, operation) VALUES (:id_user, :rubis, :operation)";
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id_user', $idUser);
        $stmt->bindParam(':rubis', $montant);
        $stmt->bindParam(':operation', $montant);

        if (!$stmt->execute()) {
//                $aSqlError = $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        return $stmt->closeCursor();
    }

    /**
     * Mise à jour des gemmes de l'utilisateur
     *
     * @param int $idUser
     * @param int $montant
     * @return bool
     * @throws ModelException
     */
    public function updateRubisByIdUser(int $idUser, int $montant)
    {
        $sql = "UPDATE ressources SET rubis = :rubis, operation = :operation WHERE id_user = :id_user";
        $stmt = $this->bdd->prepare($sql);
        $iOldRubis = $this->selectRubisByIdUser($idUser);
        $iRubis = $iOldRubis + $montant;

        if ($iRubis >= 0) {

            $stmt->bindParam(':id_user', $idUser);
            $stmt->bindParam(':rubis', $iRubis);
            $stmt->bindParam(':operation', $montant);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new ModelException(self::SQL_ERROR);
            }

            return $stmt->closeCursor();

        } else {
            return false;
        }
    }
}