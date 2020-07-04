<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 30/05/16
 * Time: 14:48
 */

namespace Ozyris\Controller;

use Exception;
use Ozyris\Exception\ControllerException;
use Ozyris\Service\SessionManager;
use Ozyris\Stdlib\ControllerInterface;

abstract class AbstractController extends SessionManager implements ControllerInterface
{

    public $view;

    const DEFAULT_DIRECTORY = 'index';
    const DEFAULT_VIEW = 'index';

    /**
     * Création d'une propriété pour chaque valeur du tableau $aVariables
     * Le nom des propriétés seront égales aux clés du tableau $aVariables
     * Les propriétés seront accessibles dans les vues avec $this->nom_propriété
     *
     * @param array $aVariables
     * @return $this
     * @throws Exception
     */
    protected function setVariables(array $aVariables)
    {
        foreach ($aVariables as $sName => $mValue) {
            if (!is_string($sName)) {
                throw new Exception('La clé doit être une chaîne de caractères.');
            }

            $this->{$sName} = $mValue;
        }

        return $this;
    }

    /**
     * @param string $sName
     * @param mixed $mValue
     * @return mixed
     * @throws Exception
     */
    protected function updateVariables($sName, $mValue)
    {
        if (!is_string($sName)) {
            throw new Exception('Le nom de la variable doit être une chaîne de caractères.');
        } elseif (!property_exists($this, $sName)) {
            return $this->setVariables([$sName => $mValue]);
        }

        return $this->{$sName} = $mValue;
    }

    /**
     * @param string $directory
     * @param string $view
     * @param bool $layout
     * @return $this
     * @throws ControllerException
     */
    public function getView(string $directory = '', string $view = '', bool $layout = true)
    {
        if (empty($directory) || !is_string($directory)) {
            $directory = self::DEFAULT_DIRECTORY;
        }

        if (empty($view) || !is_string($view)) {
            $view = self::DEFAULT_VIEW;
        }

        $this->view = __DIR__ . '/../View/' . $directory . '/' . $view . '.php';

        if (!file_exists($this->view)) {
            throw new ControllerException('Le fichier ' . $this->view . ' n\'a pas été trouvé.');
        }

        if ($layout) {
            $this->setVariables([
                'content' => $this->view
            ]);

            return require_once __DIR__ . '/../View/layout/layout.php';
        }

        return require_once $this->view;
    }

    /**
     * Redirige vers /Nom_du_Controller/Action_du_controller.
     *
     * @param string $controller
     * @param string $action
     */
    protected function redirect($controller = '', $action = '')
    {
        $sControllerName = (string) strtolower(trim($controller));
        $sActionName = (string) strtolower(trim($action));

        if (!empty($sActionName)) {
            header('Location: /' . $sControllerName . '/' . $sActionName);
            exit;
        } else {
            header('Location: /' . $sControllerName);
            exit;
        }
    }

    /**
     * Appelle la méthode render avec les paramètres de la page 404
     *
     * @return string
     * @throws Exception
     */
    public function pageNotFound()
    {
        return $this->getView('error', '404');
    }
}
