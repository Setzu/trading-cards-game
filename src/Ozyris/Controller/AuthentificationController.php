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
use Ozyris\Service\Reception;
use Ozyris\Service\Ressources;
use Ozyris\Service\SessionManager;
use Ozyris\Service\Users;

class AuthentificationController extends AbstractController
{

    public $isAuthentified = false;

    /**
     * Connecte l'utilisateur, stocke l'objet Users en session, puis redirige sur l'accueil
     */
    public function indexAction()
    {
        if (SessionManager::isAuth()) {
            return $this->redirect('index');
        }

        if (!empty($_POST)) {

            if (!array_key_exists('username', $_POST) || !array_key_exists('password', $_POST) ||
                !array_key_exists('connectToken', $_POST)) {
                return $this->redirect('authentification');
            }

            $iToken = (int) htmlspecialchars(trim($_POST['connectToken']));

            if ($this->getSessionValue('connectToken') != $iToken) {
                return $this->redirect('index');
            } else {
                $this->destroySessionValue('connectToken');
            }

            $sUsername = (string) htmlspecialchars(trim($_POST['username']));

            $oModelUser = new UserModel();
            $aDonneesUser = $oModelUser->getUserByUsernameOrEmail($sUsername);

            $sPassword = (string) htmlspecialchars(trim($_POST['password']));

            if (count($aDonneesUser) == 0 || !password_verify($sPassword, $aDonneesUser['password'])) {
                $this->addFlashMessage('Identifiant ou mot de passe incorrect.');

                return $this->redirect('authentification');
            }

            $oUser = new Users($aDonneesUser);
            $oRessources = new Ressources();
            $iRubis = $oRessources->getRubisByIdUser($oUser->getId());
            $oReception = new Reception();

            $this->setSessionValues([
                'user' => $oUser,
                'rubis' => $iRubis,
                'isAuthentified' => true,
                'isNewMessage' => $oReception->hasNewMessages($oUser->getId(), Reception::NON_LU)
            ]);

            $oReception = new Reception();

            if ($oReception->isNewDay($oUser->getLastConnection())) {
                $oReception->addMessage($oUser->getId(), 'Bonus de connection quotidien', 'Bon jeu', 2);
            }

            $oModelUser->updateConnectionByIdUser($oUser->getId());

            return $this->redirect();
        }

        $token = random_int(100, 1000);
        $this->setSessionValues(['connectToken' => $token]);

        $this->setVariables([
            'connectToken' => $token
        ]);

        return $this->getView('authentification', 'index');
    }

    /**
     * Création d'un nouvel utilisateur et redirige sur l'action index pour le connecter
     */
    public function registrationAction()
    {
        if (SessionManager::isAuth()) {
            return $this->redirect('index');
        }

        if (!empty($_POST)) {

            if (!array_key_exists('email', $_POST) || !array_key_exists('username', $_POST) ||
                !array_key_exists('password', $_POST) || !array_key_exists('confirm-password', $_POST) ||
                !array_key_exists('registrationToken', $_POST)) {
                return $this->redirect('authentification', 'registration');
            }

            $iToken = (int) htmlspecialchars(trim($_POST['registrationToken']));

            if ($this->getSessionValue('registrationToken') != $iToken) {
                return $this->redirect('registration');
            } else {
                $this->destroySessionValue('registrationToken');
            }

            $sUserEmail = (string) htmlspecialchars(trim($_POST['email']));
            $oEmailValidator = new EmailValidator();
            $bEmailIsValid = $oEmailValidator->isValid($sUserEmail);

            if (!$bEmailIsValid) {
                $this->addFlashMessage($oEmailValidator->errorMessage);

                return $this->redirect('authentification', 'registration');
            }

            $oModelUser = new UserModel();

            if ($oModelUser->isUserAlreadyExist($sUserEmail)) {
                $this->addFlashMessage("Un compte a déjà été crée avec cette adresse email.");

                return $this->redirect('authentification', 'registration');
            }

            $sUsername = (string) htmlspecialchars(trim($_POST['username']));
            $oStandarValidator = new StandardValidator();
            $bUsernameIsValid = $oStandarValidator->stringLenght($sUsername, 3, 50);

            if (!$bUsernameIsValid) {
                $this->addFlashMessage($oStandarValidator->errorMessage);

                return $this->redirect('authentification', 'registration');
            }

            if ($oModelUser->getUserByUsernameOrEmail($sUsername)) {
                $this->addFlashMessage("Ce nom d'utilisateur est déjà utilisé, veuillez en choisir un autre.");

                return $this->redirect('authentification', 'registration');
            }

            $sPassword = (string) htmlspecialchars(trim($_POST['password']));
            $sConfirmPassword = (string) htmlspecialchars(trim($_POST['confirm-password']));
            $oPasswordValidator = new PasswordValidator();
            $bPasswordIsValid = $oPasswordValidator->isValid($sPassword, $sConfirmPassword);

            if (!$bPasswordIsValid) {
                $this->addFlashMessage($oPasswordValidator->errorMessage);

                return $this->redirect('authentification', 'registration');
            }

            $sHashPassword = password_hash($sPassword, PASSWORD_BCRYPT);

            $aInfosUser['email'] = $sUserEmail;
            $aInfosUser['username'] = $sUsername;
            $aInfosUser['password'] = $sHashPassword;

            $oUser = new Users($aInfosUser);
            $oModelUser->insertUserByInfosUser($oUser);
            $oUser->setId($oModelUser->getIdUserByUsername($oUser->getUsername()));
            $oRessources = new Ressources();
            $oRessources->starterRubisByIdUser($oUser->getId());

            $this->addFlashMessage('Votre compte a été crée avec succès.', false);
            $iRubis = $oRessources->getRubisByIdUser($oUser->getId());
            $oReception = new Reception();
            $oReception->addMessage($oUser->getId(), 'Cadeau de bienvenue', 'Bon jeu', 1);

            $this->setSessionValues([
                'user' => $oUser,
                'rubis' => $iRubis,
                'isAuthentified' => true,
                'isNewMessage' => $oReception->hasNewMessages($oUser->getId(), Reception::NON_LU)
            ]);

            return $this->redirect('index');
        }

        $token = random_int(100, 1000);
        $this->setSessionValues(['registrationToken' => $token]);

        $this->setVariables(
            ['registrationToken' => $token]
        );

        return $this->getView('authentification', 'registration');
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