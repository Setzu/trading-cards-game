<?php


namespace Ozyris\Service;


use Ozyris\Model\RessourcesModel;

class Ressources extends RessourcesModel
{
    const STARTER_RUBIS = 500;
    const TEST_RUBIS = 1000000;

    /**
     * TODO changer rubis de départ dès que les test sont ok !!!
     * Crédit de 500 (const) pour les nouveaux inscris
     *
     * @param int $idUser
     * @return bool
     */
    public function starterRubisByIdUser(int $idUser)
    {
        if (!$idUser) {
            return false;
        }

        return $this->insertRubisByIdUser($idUser, self::TEST_RUBIS);
    }

    /**
     * @param int $idUser
     * @return int
     */
    public function getRubisByIdUser(int $idUser)
    {
        if (!$idUser) {
            return false;
        }

        return $this->selectRubisByIdUser($idUser);
    }

    /**
     * @param int $idUser
     * @param int $montant
     * @return bool
     */
    public function updateRubisByIdUser(int $idUser, int $montant)
    {
        if ($idUser && $montant) {
            return parent::updateRubisByIdUser($idUser, $montant);
        } else {
            return false;
        }
    }

    /**
     * @param int $iIdUser
     * @param int $iIdCard
     * @param int $iIdPack
     * @param int $iPrice
     * @param int $iQuantity
     * @return bool
     */
    public function sellCard(int $iIdUser, int $iIdCard, int $iIdPack, int $iPrice, int $iQuantity = 1)
    {
        if (!$iIdUser || !$iIdCard || !$iIdPack || !$iPrice || !$iQuantity) {
            return false;
        }

        $oCollection = new Collection();
        $aCard = $oCollection->getCard($iIdUser, $iIdCard, $iIdPack);

        $iNewQuantity = $aCard['quantity'] - $iQuantity;

        if (empty($aCard) || $iNewQuantity < 0) {
            return false;
        } elseif ($iNewQuantity == 0) {
            $oCollection->deleteCard($iIdUser, $iIdCard, $iIdPack);
        } else {
            $oCollection->updateCardQuantity($iIdUser, $iIdCard, $iIdPack, $iNewQuantity);
        }

        return $this->updateRubisByIdUser($iIdUser, ($iPrice * $iQuantity));
    }
}