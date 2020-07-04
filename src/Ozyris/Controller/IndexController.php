<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 08/06/16
 * Time: 13:01
 */

namespace Ozyris\Controller;

use Ozyris\Service\Actus;

class IndexController extends AbstractController
{

    public function indexAction()
    {
        $oActus = new Actus();

        $this->setVariables([
            'aLastsURCards' => $oActus->getLastsURCards()
        ]);

        return $this->getView();
    }
}
