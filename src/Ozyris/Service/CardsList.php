<?php


namespace Ozyris\Service;


use Ozyris\Model\CardsListModel;

class CardsList extends CardsListModel
{

    /**
     * @param int $pack
     * @return array
     */
    public function getCardsByPack($pack)
    {
        $iPack = (int) $pack;

        if ($iPack) {
            return parent::getCardsByPack($iPack);
        } else {
            return [];
        }
    }

    /**
     * @return array
     */
    public function getCardsList()
    {
        return parent::getCardsList();
    }

    /**
     * @param int $pack
     * @param int $rarity
     * @return array
     */
    public function getCardsByPackAndRarity($pack, $rarity)
    {
        $iPack = (int) $pack;
        $iRarity = (int) $rarity;

        if ($iRarity) {
            return parent::getCardsByPackAndRarity($iPack, $iRarity);
        } else {
            return [];
        }
    }

    /**
     * @param int $idCard
     * @param int $pack
     * @param int $rarity
     * @return array
     */
    public function getCard($idCard, $pack, $rarity)
    {
        $iIdCard = (int) $idCard;
        $iPack = (int) $pack;
        $iRarity = (int) $rarity;

        if ($iIdCard && $iRarity) {
            return parent::getCard($iIdCard, $iPack, $iRarity);
        } else {
            return [];
        }
    }

    /**
     * @param int $idCard
     * @param int $pack
     * @return array
     */
    public function getCounterByIdAndPack($idCard, $pack)
    {
        $iIdCard = (int) $idCard;
        $iIdPack = (int) $pack;

        if ($iIdCard) {
            return parent::getCounterByIdAndPack($iIdCard, $iIdPack);
        } else {
            return [];
        }
    }

    /**
     * @param int $idCard
     * @param int $pack
     * @param int $quantity
     * @return bool
     */
    public function incrementCounter($idCard, $pack, $quantity)
    {
        $aInfosCard = $this->getCounterByIdAndPack($idCard, $pack);
        $iQuantity = (int) $quantity;

        if (empty($aInfosCard) || !$iQuantity) {
            return false;
        }

        return parent::incrementCounterById($aInfosCard['id'], $aInfosCard['counter'] + $quantity);
    }
}