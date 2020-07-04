<?php


namespace Ozyris\Controller;

use Ozyris\Service\Collection;
use Ozyris\Service\Ressources;
use Ozyris\Service\SessionManager;
use function MongoDB\BSON\toRelaxedExtendedJSON;

class CollectionController extends AbstractController
{

    public function indexAction()
    {
        if (!SessionManager::isAuth()) {
            $this->addFlashMessage('Vous devez être connecté pour accéder à cet espace');

            return $this->redirect('authentification');
        }

        // récupération du user avec le user_id stocké en session
        $idUser = $_SESSION['user']->getId();
        $oModelCollection = new Collection();
        $aCollection = $oModelCollection->getCollectionByIdUser($idUser);
        $aCardsConf = include_once (__DIR__ . '/../../../config/cards.conf.php');

        $this->setVariables([
            'aCollection' => $aCollection,
            'aCardsConf' => $aCardsConf
        ]);

        return $this->getView('collection');
    }

    /**
     * Méthode appelée en ajax dans load-collection.js
     */
    public function loadcollectionAction() {
        if (!empty($_POST)) {
            if (!SessionManager::isAuth()) {
                $this->addFlashMessage('Vous devez être connecté pour accéder à cet espace');

                return $this->redirect('authentification');
            }

            // récupération du user avec le user_id stocké en session
            $idUser = $_SESSION['user']->getId();
            $oModelCollection = new Collection();
            $aCollection = $oModelCollection->getCollectionByIdUser($idUser);
            $aCardsConf = include_once (__DIR__ . '/../../../config/cards.conf.php');

            $this->setVariables([
                'aCollection' => $aCollection,
                'aCardsConf' => $aCardsConf
            ]);

            return require_once __DIR__ . '/../View/collection/collection.php';
        } else {
            return $this->redirect('collection');
        }
    }

    /**
     * Méthode appelée en ajax dans load-table.js
     */
    public function loadtableAction()
    {
        if (!empty($_POST)) {
            if (!SessionManager::isAuth()) {
                $this->addFlashMessage('Vous devez être connecté pour accéder à cet espace');

                return $this->redirect('authentification');
            }

            // récupération du user avec le user_id stocké en session
            $idUser = $_SESSION['user']->getId();
            $oModelCollection = new Collection();
            $aCollection = $oModelCollection->getCollectionByIdUser($idUser);
            $aCardsConf = include_once (__DIR__ . '/../../../config/cards.conf.php');

            $this->setVariables([
                'aCollection' => $aCollection,
                'aCardsConf' => $aCardsConf
            ]);

            return require_once __DIR__ . '/../View/collection/table.php';
        } else {
            return $this->redirect('collection');
        }
    }

    /**
     * Méthode appelée en ajax dans load-packs.js
     */
    public function loadpacksAction()
    {
        if (!empty($_POST)) {
            if (!SessionManager::isAuth()) {
                $this->addFlashMessage('Vous devez être connecté pour accéder à cet espace');

                return $this->redirect('authentification');
            }

            // récupération du user avec le user_id stocké en session
            $idUser = $_SESSION['user']->getId();
            $oModelCollection = new Collection();
            // TODO : récupérer dynamiquement l'id du pack
            $aCollection = $oModelCollection->getIdCardByIdUserAndPack($idUser, 1);
            $aCardsConf = include_once (__DIR__ . '/../../../config/cards.conf.php');

            $this->setVariables([
                'aCollection' => $aCollection,
                'aCardsConf' => $aCardsConf
            ]);

            return require_once __DIR__ . '/../View/collection/packs.php';
        } else {
            return $this->redirect('collection');
        }
    }

    /**
     * Méthode appelée en ajax dans table.php
     */
    public function sellingAction()
    {
        $aReturn = [];

        if (!SessionManager::isAuth()) {
            $aReturn['redirection'] = '/authentification';
            echo json_encode($aReturn);
            exit;
        }

        if (!empty($_POST)) {
            if (!array_key_exists('idCard', $_POST) || !array_key_exists('idPack', $_POST)) {
                $aReturn['redirection'] = '/collection';
                echo json_encode($aReturn);
                exit;
            }

            $iIdCard = (int) htmlspecialchars(trim($_POST['idCard']));
            $iIdPack = (int) htmlspecialchars(trim($_POST['idPack']));

            if (!$iIdCard || !$iIdPack) {
                $aReturn['redirection'] = '/collection';
                echo json_encode($aReturn);
                exit;
            }

            $idUser = $_SESSION['user']->getId();
            $oCollection = new Collection();
            $aInfosCard = $oCollection->getCard($idUser, $iIdCard, $iIdPack);

            if (empty($aInfosCard)) {
                $aReturn['redirection'] = '/collection';
                echo json_encode($aReturn);
                exit;
            }

            $aCardsConf = require_once (__DIR__ . '/../../../config/cards.conf.php');
            $oRessources = new Ressources();
            $oRessources->sellCard($idUser, $iIdCard, $iIdPack, $aCardsConf['Revente'][$aInfosCard['rarity']]);
            $_SESSION['rubis'] = $oRessources->getRubisByIdUser($idUser);

            if ($aInfosCard['quantity'] > 0) {
                $aReturn['quantity'] = $aInfosCard['quantity'] - 1;
            }

            $aReturn['idCard'] = $iIdCard;
            $aReturn['idPack'] = $iIdPack;
            $aReturn['rubis'] = $_SESSION['rubis'];
            $aReturn['confirmation'] = $aCardsConf['Revente'][$aInfosCard['rarity']] . ' rubis obtenus';
            echo json_encode($aReturn);
            exit;
        }
    }
}