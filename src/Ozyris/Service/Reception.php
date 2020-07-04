<?php


namespace Ozyris\Service;

use DateTime;
use Ozyris\Exception\ModelException;
use Ozyris\Exception\ServiceException;
use Ozyris\Model\ReceptionModel;

class Reception extends ReceptionModel
{

    const DEFAULT_SENDER = 'My Collection';
    const NON_LU = 0;

    /**
     * @param int $idUser
     * @param string $header
     * @param string $content
     * @param int $idAttachment
     * @param string $sender
     * @return bool
     * @throws ServiceException
     * @throws ModelException
     */
    public function addMessage(int $idUser, string $header, string $content, int $idAttachment = 0, string $sender = self::DEFAULT_SENDER)
    {
        if (!$idUser || empty($header) || empty($content)) {
            throw new ServiceException('Le message doit contenir : id user, sujet, contenu');
        }

        return $this->insertMessageByIdUser($idUser, $header, $content, $idAttachment, $sender);
    }

    /**
     * $type = 1 équivaut à rubis,
     * @param int $type
     * @param int $quantity
     * @return bool
     * @throws ServiceException
     * @throws ModelException
     */
    public function addAttachment(int $type = 1, int $quantity = 1)
    {
        if (!$type || !$quantity) {
            throw new ServiceException('La pièce jointe doit contenir un type > à 0 et une quantité > à 0');
        }

        return $this->insertAttachment($type, $quantity);
    }

    /**
     * @param int $idUser
     * @return array
     * @throws ModelException
     */
    public function getAllMessagesByIdUser(int $idUser)
    {
        if (!$idUser) {
            return [];
        }

        return $this->selectMessagesAndAttachmentsByIdUser($idUser);
    }

    public function readedMessage($idUser, $idMessage)
    {

    }

    public function collectAttachment($idUser, $idAttachment)
    {

    }

    /**
     * @param string $date
     * @return bool
     * @throws ServiceException
     */
    public function isNewDay(string $date)
    {
        if (empty($date)) {
            throw new ServiceException('La date doit être renseignée');
        }

        $datetime1 = new DateTime(date('Y-m-d', strtotime($date)));
        $datetime2 = new DateTime(date('Y-m-d'));
        $interval = $datetime1->diff($datetime2);

        if ($interval->format('%a') > 0) {
            return true;
        }

        return false;
    }

    /**
     * @param int $idUser
     * @param int $readed
     * @return bool
     * @throws ModelException
     */
    public function hasNewMessages(int $idUser, int $readed)
    {
        if (!$idUser) {
            return false;
        }

        if (!empty($this->selectReadedMessages($idUser, $readed))) {
            return true;
        } else {
            return false;
        }
    }
}