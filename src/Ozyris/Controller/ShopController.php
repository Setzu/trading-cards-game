<?php


namespace Ozyris\Controller;


use Ozyris\Service\Actus;
use Ozyris\Service\Collection;
use Ozyris\Service\Ressources;
use Ozyris\Service\SessionManager;

class ShopController extends AbstractController
{

    public function indexAction()
    {
        if (!SessionManager::isAuth()) {
            $this->addFlashMessage('Vous devez être connecté pour accéder à cet espace');

            return $this->redirect('authentification');
        }

        $oRessources = new Ressources();
        $iUserRubis = $oRessources->getRubisByIdUser($_SESSION['user']->getId());
        $token = random_int(100, 1000);
        $this->setSessionValues(['token' => $token]);

        $aCardsConf = include_once(__DIR__ . '/../../../config/cards.conf.php');

        $this->setVariables([
            'iRubis' => $iUserRubis,
            'aCardsConf' => $aCardsConf,
            'token' => $token
        ]);

        return $this->getView('shop');
    }

    public function buyPackAction()
    {
        if (!SessionManager::isAuth()) {
            $this->addFlashMessage('Vous devez être connecté pour accéder à cet espace');

            return $this->redirect('authentification');
        }

        if (!empty($_POST)) {

            if (!array_key_exists('token', $_POST) || !array_key_exists('idPack', $_POST)) {
                return $this->redirect('shop');
            }

            $iToken = (int) htmlspecialchars(trim($_POST['token']));
            $idUser = $_SESSION['user']->getId();

            if ($this->getSessionValue('token') != $iToken) {
                return $this->redirect('shop');
            } else {
                $this->destroySessionValue('token');
            }

            $idPack = (int) htmlspecialchars(trim($_POST['idPack']));
            $aCardsConf = include_once(__DIR__ . '/../../../config/cards.conf.php');

            if (!array_key_exists($idPack, $aCardsConf['Packs'])) {
                return $this->redirect('shop');
            }

            $oRessources = new Ressources();
            $iUserRubis = $oRessources->getRubisByIdUser($idUser);

            if ($iUserRubis < $aCardsConf['Packs'][$idPack]['Prix']) {
                $this->addFlashMessage('Vous n\'avez pas suffisamment de gemmes !');

                return $this->redirect('shop');
            }

            if (!$oRessources->updateRubisByIdUser($_SESSION['user']->getId(), - $aCardsConf['Packs'][$idPack]['Prix'])) {
                $this->addFlashMessage('Une erreur est survenue, veuillez réessayer ultèrieurement.');

                return $this->redirect('shop');
            }

            // TODO : voir problème maj rubis dans le header lors de l'achat
            $this->setSessionValues(['rubis' => $iUserRubis - $aCardsConf['Packs'][$idPack]['Prix']]);

            $aCards = [];
            $oCollection = new Collection();

            for ($i = 0; $i < 5; $i++) {
                // Taux de drop
                $iRandForRarity = rand(1, 1000);

                // Récupération des id de cartes dans le fichier de conf en fonction de la rareté
                if ($iRandForRarity > 50) {
                    $idCard = $aCardsConf['Packs'][$idPack]['Rareté'][1][array_rand($aCardsConf['Packs'][$idPack]['Rareté'][1], 1)];
                    $aCards[$idCard]['rarity'] = 1;
                } elseif ($iRandForRarity > 5) {
                    $idCard = $aCardsConf['Packs'][$idPack]['Rareté'][2][array_rand($aCardsConf['Packs'][$idPack]['Rareté'][2], 1)];
                    $aCards[$idCard]['rarity'] = 2;
                } else {
                    $idCard = $aCardsConf['Packs'][$idPack]['Rareté'][3][array_rand($aCardsConf['Packs'][$idPack]['Rareté'][3], 1)];
                    $aCards[$idCard]['rarity'] = 3;
                }

                !array_key_exists('quantity', $aCards[$idCard]) ? $aCards[$idCard]['quantity'] = 1 : $aCards[$idCard]['quantity']++;
            }

            $aCollection = $oCollection->getCollectionByIdUser($idUser);
            $aComparedCards = $oCollection->getComparedCards($aCollection, $aCards);
            $oActus = new Actus();

            foreach ($aComparedCards as $id => $aCardInfos) {
                if ($aCardInfos['double']) {
                    $oCollection->updateCardQuantity($idUser, $id , $idPack, $aCardInfos['total']);
                } else {
                    $oCollection->addNewCard($idUser, $id, $idPack, $aCardInfos['quantity']);
                }

                if ($aCardInfos['rarity'] == 3) {
                    $oActus->addURCard($_SESSION['user']->getUsername(), $aCardsConf['Packs'][$idPack]['Cartes'][$id]['Nom']);
                }
            }

            $this->setVariables([
                'aComparedCards' => $aComparedCards,
                'aCardsConf' => $aCardsConf,
                'idPack' => $idPack
            ]);

            return $this->getView('shop', 'newcards');
        }

        return $this->redirect('shop');
    }
}