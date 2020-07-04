<?php


namespace Ozyris\Service;


use Ozyris\Model\ActusModel;

class Actus extends ActusModel
{

    /**
     * @param string $username
     * @param string $cardName
     */
    public function addURCard(string $username, string $cardName)
    {
        if (!$username && !$cardName) {
            return false;
        }

        $this->insertURCard($username, $cardName);

        return true;
    }

    /**
     * @return array
     */
    public function getLastsURCards()
    {
        return $this->selectLastsURCards();
    }
}