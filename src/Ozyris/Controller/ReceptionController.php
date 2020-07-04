<?php


namespace Ozyris\Controller;


use Ozyris\Service\Reception;
use Ozyris\Service\SessionManager;

class ReceptionController extends AbstractController
{

    public function indexAction()
    {
        if (!SessionManager::isAuth()) {
            $this->addFlashMessage('Vous devez être connecté pour accéder à cet espace');

            return $this->redirect('authentification');
        }

        // récupération du user avec le user_id stocké en session
        $idUser = $_SESSION['user']->getId();
        $oReception = new Reception();
        $aAttachmentsConf = include_once (__DIR__ . '/../../../config/attachments.conf.php');

        $this->setVariables([
            'aMessages' => $oReception->getAllMessagesByIdUser($idUser),
            'aAttachmentsType' => $aAttachmentsConf['Type']
        ]);

        $this->getView('reception');
    }

    public function readmessageAction()
    {

    }

    public function collectattachmentAction()
    {

    }
}