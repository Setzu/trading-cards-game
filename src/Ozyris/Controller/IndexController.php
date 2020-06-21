<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 08/06/16
 * Time: 13:01
 */

namespace Ozyris\Controller;

use Ozyris\Service\SessionManager;

class IndexController extends AbstractController
{

    public function indexAction()
    {
        if (SessionManager::isAuth()) {
            $this->setVariables([
                'user' => $this->getUser()
            ]);
        }

        return $this->render();
    }
}
