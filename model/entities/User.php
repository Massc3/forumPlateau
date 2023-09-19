<?php
// je le range dans l'espace virtuel
namespace Model\Entities;
// on indique d'aller chercher la class Entity dans le dossier app
use App\Entity;
// on interdit un heritage de la class, elle n epeut pas avoir d'enfant c'est une classe finale. La classe topic herite de la Entity
final class User extends Entity
{

    //liste des propriétés de la classe Topic, selon le principe d'encapsulation : (la visibilité des elements au sein d'une classe) mes propriété sont privé et que accessible au sein d'une classe
    private $id;
    private $email;
    private $pseudo;
    private $password;
    private $dateInscription;
    private $ban;
    private $role;
    private $userRole;


    public function __construct($data)
    {
        $this->hydrate($data);
    }
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of pseudo
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }
    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of dateInscription
     */
    public function getDateInscription()
    {
        $formattedDate = $this->dateInscription->format("d/m/Y, H:i:s");
        return $formattedDate;
    }
    /**
     * Set the value of dateInscription
     *
     * @return  self
     */
    public function setDateInscription($date)
    {
        $this->dateInscription = new \DateTime($date);
        return $this;
    }


    /**
     * Get the value of ban
     */
    public function getBan()
    {
        return $this->ban;
    }

    /**
     * Set the value of ban
     *
     * @return  self
     */
    public function setBan($ban)
    {
        $this->ban = $ban;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
    /**

     * Get the value of userRole

     */

    public function afficherRole()

    {

        if (in_array("ROLE_ADMIN", $this->getUserRole())) {



            return "admin";
        } else {



            return "user";
        }
    }



    /**
 
     * Set the value of userRole
 
     *
 
     * @return  self
 
     */

    public function setUserRole($role)

    {

        // on récupère du JSON

        $this->userRole = json_decode($role);

        // S'il n'y a pas de rôles attitrés, on va lui attribué un rôle



        if (empty($this->$role)) {

            $this->userRole[] = "ROLE_USER";
        }
        return $this;
    }

    // public function hasRole($role)

    // {
    //     // si dans mon tableau JSON on trouve un rôle qui correspond au rôle en paramètre alors ça va nous return le rôle

    //     return in_array($role, $this->getUserRole());
    // }

    /*    * Get the value of userRole   */
    public function getUserRole()
    {
        return $this->userRole;
    }

    // Methode ToString

    public function __toString()
    {
        return $this->getEmail() . $this->getEmail() . $this->getPassword() . $this->getDateInscription() . $this->getBan();
    }
}
