<?php


namespace Ozyris\Service;


use Ozyris\Model\RessourcesModel;

class Ressources extends RessourcesModel
{
    const STARTER_MONEY = 500;

    /**
     * Crédit de 500 (const) pour les nouveaux inscris
     *
     * @param $idUser
     * @return bool
     */
    public function starterMoneyByIdUser($idUser)
    {
        $iIdUser = (int) $idUser;

        if (!$iIdUser) {
            return false;
        }

        return $this->insertMoneyByIdUser($iIdUser, self::STARTER_MONEY);
    }

    /**
     * @param int $idUser
     * @return int
     */
    public function getMoneyByIdUser($idUser)
    {
        $iIdUser = (int) $idUser;

        if (!$iIdUser) {
            return false;
        }

        return parent::getMoneyByIdUser($iIdUser);
    }

    /**
     * @param int $idUser
     * @param int $montant
     * @return bool
     */
    public function updateMoneyByIdUser($idUser, $montant)
    {
        $iIdUser = (int) $idUser;
        $iMontant = (int) $montant;

        if ($idUser && $iMontant) {
            return parent::updateMoneyByIdUser($iIdUser, $iMontant);
        } else {
            return false;
        }
    }
}