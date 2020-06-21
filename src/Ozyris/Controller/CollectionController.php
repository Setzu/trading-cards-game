<?php


namespace Ozyris\Controller;

use Ozyris\Service\Collection;
use Ozyris\Service\SessionManager;
use Ozyris\Service\Users;

class CollectionController extends AbstractController
{

    /**
     * @return array|mixed|void
     */
    public function indexAction()
    {
        if (!SessionManager::isAuth()) {
            $this->setFlashMessage('Vous devez être connecté pour accéder à cet espace');

            return $this->redirect('authentification');
        }

        // récupération du user avec le user_id stocké en session
        $sIdUser = $_SESSION['user']->getId();
        $oModelCollection = new Collection();
        $aCollection = $oModelCollection->getCollectionByIdUser($sIdUser);
        $aCardsConf = include_once (__DIR__ . '/../../../config/cards.conf.php');

        $this->setVariables(
            [
                'aCollection' => $aCollection,
                'aCardsConf' => $aCardsConf
            ]
        );

        return $this->render('collection');
    }

    public function tabAction() {

    }
}