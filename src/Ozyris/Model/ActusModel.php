<?php


namespace Ozyris\Model;


use Ozyris\Exception\ModelException;

class ActusModel extends AbstractModel
{
    const SQL_ERROR = "ActusModel : Une erreur s'est produite, veuillez réessayer ultérieurement.";

    /**
     * @param string $username
     * @param string $cardName
     * @return bool
     * @throws ModelException
     */
    protected function insertURCard(string $username, string $cardName)
    {
        $sql = "INSERT INTO actus (username, cardname) VALUES (:username, :cardname)";
        $stmt = $this->bdd->prepare($sql);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':cardname', $cardName);

        if (!$stmt->execute()) {
            //$aSqlError = $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        return $stmt->closeCursor();
    }

    /**
     * @return array
     * @throws ModelException
     */
    protected function selectLastsURCards()
    {
        $sql = 'SELECT username, cardname, date_registration FROM actus ORDER BY date_registration DESC LIMIT 10';
        $stmt = $this->bdd->prepare($sql);

        if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
            throw new ModelException(self::SQL_ERROR);
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}