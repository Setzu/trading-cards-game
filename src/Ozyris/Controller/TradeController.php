<?php


namespace Ozyris\Controller;


class TradeController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('trade');
    }
}