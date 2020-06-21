<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/16
 * Time: 14:52
 */

namespace Ozyris\Controller;

use Ozyris\Model\UserModel;
use Ozyris\Form\Validator\EmailValidator;
use Ozyris\Form\Validator\PasswordValidator;
use Ozyris\Form\Validator\StandardValidator;
use Ozyris\Service\Ressources;
use Ozyris\Service\SessionManager;
use Ozyris\Service\Users;

class AuthentificationController extends AbstractController
{

    public $isAuthentified = false;

    /**
     * Connecte l'utilisateur, stocke l'objet Users en session, puis redirige sur l'accueil
     * @return void
     */
    public function indexAction()
    {
        if (SessionManager::isAuth()) {
            return $this->redirect('index');
        }

        if ($_POST) {
            $sUsername = (string) htmlspecialchars(trim($_POST['username']));

            $oModelUser = new UserModel();
            $aDonneesUser = $oModelUser->getUserByUsernameOrEmail($sUsername);

            $sPassword = (string) htmlspecialchars(trim($_POST['password']));

            if (count($aDonneesUser) == 0 || !password_verify($sPassword, $aDonneesUser['password'])) {
                $this->setFlashMessage('Identifiant ou mot de passe incorrect.');

                return $this->redirect('authentification');
            }

            $oUser = new Users($aDonneesUser);
            $oRessources = new Ressources();
            $iMoney = $oRessources->getMoneyByIdUser($oUser->getId());

            $this->setSessionValues([
                'user' => $oUser,
                'money' => $iMoney,
                'isAuthentified' => true
            ]);

            return $this->redirect();
        }

        return $this->render('authentification', 'index');
    }

    /**
     * Création d'un nouvel utilisateur et redirige sur l'action index pour le connecter
     * @return $this
     */
    public function registrationAction()
    {
        if (SessionManager::isAuth()) {
            return $this->redirect('index');
        }

        if ($_POST) {
            $aInfosUser = array();
            $sUserEmail = (string) htmlspecialchars(trim($_POST['email']));
            $oEmailValidator = new EmailValidator();
            $bEmailIsValid = $oEmailValidator->isValid($sUserEmail);

            if (!$bEmailIsValid) {
                $this->setFlashMessage($oEmailValidator->errorMessage);

                return $this->redirect('authentification', 'registration');
            }

            // TODO : passer par un service Users
            $oModelUser = new UserModel();

            if ($oModelUser->isUserAlreadyExist($sUserEmail)) {
                $this->setFlashMessage("Un compte a déjà été crée avec cette adresse email.");

                return $this->redirect('authentification', 'registration');
            }

            $sUsername = (string) htmlspecialchars(trim($_POST['username']));
            $oStandarValidator = new StandardValidator();
            $bUsernameIsValid = $oStandarValidator->stringLenght($sUsername, 3, 50);

            if (!$bUsernameIsValid) {
                $this->setFlashMessage($oStandarValidator->errorMessage);

                return $this->redirect('authentification', 'registration');
            }

            if ($oModelUser->getUserByUsernameOrEmail($sUsername)) {
                $this->setFlashMessage("Ce nom d'utilisateur est déjà utilisé, veuillez en choisir un autre.");

                return $this->redirect('authentification', 'registration');
            }

            $sPassword = (string) htmlspecialchars(trim($_POST['password']));
            $sConfirmPassword = (string) htmlspecialchars(trim($_POST['confirm-password']));
            $oPasswordValidator = new PasswordValidator();
            $bPasswordIsValid = $oPasswordValidator->isValid($sPassword, $sConfirmPassword);

            if (!$bPasswordIsValid) {
                $this->setFlashMessage($oPasswordValidator->errorMessage);

                return $this->redirect('authentification', 'registration');
            }

            $sHashPassword = password_hash($sPassword, PASSWORD_BCRYPT);

            $aInfosUser['email'] = $sUserEmail;
            $aInfosUser['username'] = $sUsername;
            $aInfosUser['password'] = $sHashPassword;

            $oUser = new Users($aInfosUser);
            $oModelUser->insertUserByInfosUser($oUser);
            $oRessources = new Ressources();
            $oRessources->starterMoneyByIdUser($oModelUser->getIdUserByUsername($oUser->getUsername()));

            $this->setFlashMessage('Votre compte a été crée avec succès.', false);

            return $this->indexAction();
        }

        return $this->render('authentification', 'registration');
    }

    /**
     * Détruit la session puis redirige sur l'accueil
     * @return void
     */
    public function disconnectAction()
    {
        $this->destroySession();
        $this->isAuthentified = false;

        return $this->redirect();
    }

}
