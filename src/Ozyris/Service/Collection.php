<?php


namespace Ozyris\Service;


use Ozyris\Model\CollectionModel;

class Collection extends CollectionModel
{

    /**
     * @param int $idUser
     * @return array
     */
    public function getCollectionByIdUser($idUser)
    {
        $iIdUser = (int) $idUser;

        if (!$iIdUser) {
            return [];
        }

        return parent::getCollectionByIdUser($idUser);
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
        if (empty($collection) || empty($cards)) {
            return [];
        }

        $aComparedCards = [];

        foreach ($collection as $k => $aCard) {
            if (array_key_exists($aCard['id_card'], $cards)) {
                $aComparedCards[$aCard['id_card']]['rarity'] = $cards[$aCard['id_card']]['rarity'];
                $aComparedCards[$aCard['id_card']]['quantity'] = $cards[$aCard['id_card']]['quantity'];
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
     * @param int $idUser
     * @param int $idCard
     * @param int $pack
     * @param int $quantity
     * @return bool|mixed
     */
    public function updateCardQuantity($idUser, $idCard, $pack, $quantity)
    {
        $iIdUser = (int) $idUser;
        $iIdCard = (int) $idCard;
        $iPack = (int) $pack;
        $iQuantity = (int) $quantity;

        if (!$iIdUser || !$iIdCard || !$iPack || !$iQuantity) {
            return false;
        }

        $oCardsList = new CardsList();
        $oCardsList->incrementCounter($iIdCard, $iPack, $iQuantity);

        return parent::updateCardQuantity($iIdUser, $iIdCard, $iPack, $iQuantity);
    }
}