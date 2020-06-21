<?php


namespace Ozyris\Controller;


use Ozyris\Service\Users;

class FriendController extends AbstractController
{

    public function indexAction()
    {
        if (!isset($_SESSION) || !array_key_exists('user', $_SESSION) || !$_SESSION['user'] instanceof Users) {
            $this->setFlashMessage('Vous devez être connecté pour accéder à cet espace');

            return $this->redirect('authentification');
        }

        return $this->render('friend');
        // TODO: Implement indexAction() method.
    }
}