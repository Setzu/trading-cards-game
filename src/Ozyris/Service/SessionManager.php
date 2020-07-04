<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 02/06/16
 * Time: 10:14
 */

namespace Ozyris\Service;

abstract class SessionManager
{

    public $aFlashMessages = [];

    const DEFAULT_EXPIRATION_TIME = 60;
    const FLASH_MESSAGE = 'flashmessage';
    const ALERTS = 'alerts';
    const DANGER = 'danger';
    const SUCCESS = 'success';
    const WARNING = 'warning';

    public function __construct()
    {
        $this->startSession();
    }

    /**
     * Démarre la session
     *
     * @param int $expiration
     * @return $this
     */
    public function startSession($expiration = self::DEFAULT_EXPIRATION_TIME)
    {
        if (session_status() == PHP_SESSION_NONE) {
            $exp = (int) $expiration;
            session_cache_expire($exp > 0 ? $exp : self::DEFAULT_EXPIRATION_TIME);
            session_start();
        }

        return $this;
    }

    /**
     * Enregistre $value en session
     *
     * @param array $values
     * @throws \Exception
     */
    public function setSessionValues(array $values)
    {
        foreach ($values as $k => $v) {
            if (!is_string($k) && !is_int($k)) {
                throw new \Exception('Session Manager : La clé doit être un entier ou une chaine de caractères.');
            }
            $_SESSION[$k] = $v;
        }
    }

    /**
     * Récupère une valeur de la session en passant la clé en paramètre
     *
     * @param mixed $key
     * @return null
     * @throws \Exception
     */
    public function getSessionValue($key)
    {
        if (!is_string($key) && !is_int($key)) {
            return null;
        }

        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    /**
     * Détruit toute la session
     */
    public function destroySession()
    {
        session_destroy();
    }

    /**
     * Détruit la clé $key en session
     *
     * @param $key
     * @return bool
     */
    public function destroySessionValue($key)
    {
        if (is_string($key) || is_int($key) && array_key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);

            return true;
        }

        return false;
    }

    /**
     * Stocke les flash messages en session
     *
     * @param string $message
     * @param bool $error
     */
    public function addFlashMessage(string $message, bool $error = true)
    {
        $_SESSION[self::FLASH_MESSAGE][$error ? self::DANGER : self::SUCCESS] = ['message' => $message];
    }

    /**
     * Affiche le message selon le type, et appelle la méthode destroySessionValue
     *
     * @return string
     */
    public static function flashMessages()
    {
        $sFlashMessages = '';

        if (array_key_exists(self::FLASH_MESSAGE, $_SESSION)) {
            foreach ($_SESSION[self::FLASH_MESSAGE] as $type => $message) {
                if ($type == self::DANGER) {
                    $icon = "<svg class='bi bi-x-circle-fill' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z'/>
</svg>";
                } else {
                    $icon = "<svg class='bi bi-check-circle-fill' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
</svg>";
                }

                $sFlashMessages .= "<div class='flashmessage alert alert-$type'>" . $icon . "&nbsp;". $message['message'] . '</div><br>';
            }
        }

        unset($_SESSION[self::FLASH_MESSAGE]);

        echo $sFlashMessages;
    }

    /**
     * Renvoi true si l'utilisateur est connecté
     * @return bool
     */
    public static function isAuth()
    {
        if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Users) {
            return true;
        } else {
            return false;
        }
    }
}
