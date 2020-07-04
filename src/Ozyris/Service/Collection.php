<?php


namespace Ozyris\Service;


use Ozyris\Model\CollectionModel;

class Collection extends CollectionModel
{

    /**
     * @param int $idUser
     * @return array
     */
    public function getCollectionByIdUser(int $idUser)
    {
        if (!$idUser) {
            return [];
        }

        return $this->selectCollectionByIdUser($idUser);
    }

    /**
     * @param int $idUser
     * @param int $pack
     * @return array
     */
    public function getIdCardByIdUserAndPack(int $idUser, int $pack)
    {
        if (!$idUser || !$pack) {
            return [];
        }

        $aResult = $this->selectIdCardByIdUserAndPack($idUser, $pack);
        $aReturn = [];

        foreach ($aResult as $k => $aIdCards) {
            $aReturn[$aIdCards['id_card']] = $aIdCards['id_card'];
        }

        return $aReturn;
    }

    /**
     * Renvoi un array contenant les nouvelles cartes et les doubles
     *
     * @param array $collection
     * @param array $cards
     * @return array
     */
    public function getComparedCards($collection, $cards)
    {
        if (empty($cards)) {
            return [];
        }

        $aComparedCards = [];

        foreach ($collection as $k => $aCard) {
            if (array_key_exists($aCard['id_card'], $cards)) {
                $aComparedCards[$aCard['id_card']]['rarity'] = $cards[$aCard['id_card']]['rarity'];
                $aComparedCards[$aCard['id_card']]['quantity'] = $cards[$aCard['id_card']]['quantity'];
                $aComparedCards[$aCard['id_card']]['total'] = $cards[$aCard['id_card']]['quantity'] + $aCard['quantity'];
                $aComparedCards[$aCard['id_card']]['double'] = true;
                unset($cards[$aCard['id_card']]);
            }
        }

        if (!empty($cards)) {
            foreach ($cards as $id => $aInfo) {
                $aComparedCards[$id]['rarity'] = $aInfo['rarity'];
                $aComparedCards[$id]['quantity'] = $aInfo['quantity'];
                $aComparedCards[$id]['double'] = false;
            }
        }

        return $aComparedCards;
    }

    /**
     * @param int $idUser
     * @param int $idCard
     * @param int $pack
     * @param int $quantity
     * @return bool
     */
    public function addNewCard($idUser, $idCard, $pack, $quantity)
    {
        $iIdUser = (int) $idUser;
        $iIdCard = (int) $idCard;
        $iPack = (int) $pack;
        $iQuantity = (int) $quantity;

        if (!$iIdUser || !$iIdCard || !$iPack || !$iQuantity) {
            return false;
        }

        $oCardsList = new CardsList();
        $this->insertCard($iIdUser, $iIdCard, $iPack, $iQuantity);
        $oCardsList->incrementCounter($iIdCard, $iPack, $iQuantity);

        return true;
    }

    /**
     * @param int $iIdUser
     * @param int $iIdCard
     * @param int $iPack
     * @param int $iQuantity
     * @return bool|mixed
     */
    public function updateCardQuantity(int $iIdUser, int $iIdCard, int $iPack, int $iQuantity)
    {
        if (!$iIdUser || !$iIdCard || !$iPack || !$iQuantity) {
            return false;
        }

        $oCardsList = new CardsList();

        if ($iQuantity > 0) {
            $oCardsList->incrementCounter($iIdCard, $iPack, $iQuantity);
        }

        return parent::updateCardQuantity($iIdUser, $iIdCard, $iPack, $iQuantity);
    }

    /**
     * @param int $idUser
     * @param int $idCard
     * @param int $idPack
     * @return array
     */
    public function getCard(int $idUser, int $idCard, int $idPack)
    {
        $iIdUser = (int) $idUser;
        $iIdCard = (int) $idCard;
        $iIdPack = (int) $idPack;

        if (!$iIdUser || !$iIdCard || !$iIdPack) {
            return [];
        }

        return $this->selectCard($iIdUser, $iIdCard, $iIdPack);
    }

    public function deleteCard(int $idUser, int $idCard, int $idPack)
    {
        $iIdUser = (int) $idUser;
        $iIdCard = (int) $idCard;
        $iIdPack = (int) $idPack;

        if (!$iIdUser || !$iIdCard || !$iIdPack) {
            return [];
        }

        return parent::deleteCard($iIdUser, $iIdCard, $iIdPack);
    }
}