<?php


namespace Ozyris\Controller;


use Ozyris\Service\Collection;
use Ozyris\Service\Ressources;
use Ozyris\Service\SessionManager;
use Ozyris\Service\Users;

class ShopController extends AbstractController
{

    /**
     * @return mixed|ShopController
     * @throws \Exception
     */
    public function indexAction()
    {
        if (!SessionManager::isAuth()) {
            $this->setFlashMessage('Vous devez être connecté pour accéder à cet espace');

            return $this->redirect('authentification');
        }

        $oRessources = new Ressources();
        $iUserMoney = $oRessources->getMoneyByIdUser($_SESSION['user']->getId());
        $token = random_int(100, 1000);
        $this->setSessionValues(['token' => $token]);

        $this->setVariables([
            'iMoney' => $iUserMoney,
            'token' => $token
        ]);

        return $this->render('shop');
    }

    /**
     * @return mixed|ShopController|void
     * @throws \Exception
     */
    public function buyPackAction()
    {
        if (!SessionManager::isAuth()) {
            $this->setFlashMessage('Vous devez être connecté pour accéder à cet espace');

            return $this->redirect('authentification');
        }

        // Récupérer le numéro du pack en post
        if (!empty($_POST)) {

            // TODO appeler un validateur
            if (!$_POST['pack']) {
                return $this->redirect('shop');
            }

            $pack = $_POST['pack'];
            $idPack = $_POST['idpack'];
            $idUser = $_SESSION['user']->getId();

            if ($this->getSessionValue('token') != $_POST['token']) {
                return $this->redirect('shop');
            } else {
                $this->destroySessionValue('token');
            }

            $aCardsConf = include_once(__DIR__ . '/../../../config/cards.conf.php');
            $oRessources = new Ressources();
            $iUserMoney = $oRessources->getMoneyByIdUser($idUser);

            if ($iUserMoney < $aCardsConf[$pack]['Prix']) {
                $this->setFlashMessage('Vous n\'avez pas suffisamment de gemmes !');

                return $this->redirect('shop');
            }

            if (!$oRessources->updateMoneyByIdUser($_SESSION['user']->getId(), - $aCardsConf[$pack]['Prix'])) {
                $this->setFlashMessage('Une erreur est survenue, veuillez réessayer ultèrieurement.');

                return $this->redirect('shop');
            }

            // TODO : voir problème maj rubis dans le header lors de l'achat
            $this->setSessionValues(['money' => $iUserMoney - $aCardsConf[$pack]['Prix']]);

            $aCards = [];
            $oCollection = new Collection();

            for ($i = 0; $i < 5; $i++) {
                // Taux de drop
                $iRandForRarity = rand(1, 1000);

                // Récupération des id de cartes dans le fichier de conf en fonction de la rareté
                if ($iRandForRarity > 50) {
                    $idCard = $aCardsConf[$pack]['Cartes']['Rareté'][1][array_rand($aCardsConf[$pack]['Cartes']['Rareté'][1], 1)];
                    $aCards[$idCard]['rarity'] = 1;
                } elseif ($iRandForRarity > 5) {
                    $idCard = $aCardsConf[$pack]['Cartes']['Rareté'][2][array_rand($aCardsConf[$pack]['Cartes']['Rareté'][2], 1)];
                    $aCards[$idCard]['rarity'] = 2;
                } else {
                    $idCard = $aCardsConf[$pack]['Cartes']['Rareté'][3][array_rand($aCardsConf[$pack]['Cartes']['Rareté'][3], 1)];
                    $aCards[$idCard]['rarity'] = 3;
                }

                !array_key_exists('quantity', $aCards[$idCard]) ? $aCards[$idCard]['quantity'] = 1 : $aCards[$idCard]['quantity']++;
            }

            $aCollection = $oCollection->getCollectionByIdUser($idUser);
            $aComparedCards = $oCollection->getComparedCards($aCollection, $aCards);

            foreach ($aComparedCards as $id => $aInfos) {
                if ($aInfos['double']) {
                    $oCollection->updateCardQuantity($idUser, $id , $idPack, $aInfos['quantity']);
                } else {
                    $oCollection->addNewCard($idUser, $id, $idPack, $aInfos['quantity']);
                }
            }

            $this->setVariables([
                'aComparedCards' => $aComparedCards,
                'aCardsConf' => $aCardsConf,
            ]);

            return $this->render('shop', 'newcards');
        }

        return $this->redirect('shop');
    }

    /**
     * Méthode appeleée en ajax : ajax.js
     *
     * @return bool|null
     * @throws \Exception
     */
    public function updateMoneyAction()
    {
        if ($_POST) {
            echo $this->getSessionValue('money');
        }
    }
}