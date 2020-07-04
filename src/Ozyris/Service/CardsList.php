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
            return parent::selectCardsByPack($iPack);
        } else {
            return [];
        }
    }

    /**
     * @return array
     */
    public function getCardsList()
    {
        return parent::selectCardsList();
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
            return $this->selectCardsByPackAndRarity($iPack, $iRarity);
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
        if ($idCard && $rarity && $pack) {
            return parent::selectCard($idCard, $pack, $rarity);
        } else {
            return [];
        }
    }

    /**
     * @param int $idCard
     * @param int $pack
     * @return array
     */
    public function getCounterByIdAndPack(int $idCard, int $pack)
    {
        if ($idCard) {
            return $this->selectCounterByIdAndPack($idCard, $pack);
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
    public function incrementCounter(int $idCard, int $pack, int $quantity)
    {
        $aInfosCard = $this->getCounterByIdAndPack($idCard, $pack);

        if (empty($aInfosCard) || !$quantity) {
            return false;
        }

        return $this->updateCounter($aInfosCard['id'], $aInfosCard['counter'] + $quantity);
    }
}