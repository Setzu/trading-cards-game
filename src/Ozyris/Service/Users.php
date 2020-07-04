<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/16
 * Time: 16:50
 */

namespace Ozyris\Service;


use Ozyris\Exception\ServiceException;

class Users
{

    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $lastConnection;
    protected $dateRegistration;
    protected $role = 'member';

    /**
     * Users constructor.
     * @param array $aDonnees
     * @throws ServiceException
     */
    public function __construct(array $aDonnees = array())
    {
        if (!empty($aDonnees)) {
            $this->hydrate($aDonnees);
        }
    }

    /**
     * @param array $aUsers
     * @return $this
     * @throws ServiceException
     */
    public function hydrate(array $aUsers = array())
    {
        foreach($aUsers as $attribut => $value) {

            if (strpos($attribut, '_')) {
                $method = 'set';
                $aString = explode('_', $attribut);
                foreach ($aString as $k => $string) {
                    $method .= ucfirst(strtolower($string));
                }
            } else {
                $method = 'set' . ucfirst(strtolower($attribut));
            }

            if (!method_exists($this, $method)) {
                throw new ServiceException('Service Users : La méthode set' . ucfirst(strtolower($attribut)) . ' n\'existe pas.');
            }

            $this->$method($value);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getDateRegistration()
    {
        return $this->dateRegistration;
    }

    /**
     * @param mixed $dateRegistration
     */
    public function setDateRegistration($dateRegistration)
    {
        $this->dateRegistration = $dateRegistration;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getLastConnection()
    {
        return $this->lastConnection;
    }

    /**
     * @param mixed $lastConnection
     */
    public function setLastConnection($lastConnection)
    {
        $this->lastConnection = $lastConnection;
    }


}