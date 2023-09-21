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

    public function afficherRole()

    {

        if (in_array("ROLE_ADMIN", $this->getRole())) {

            return "admin";
        } else {

            return "user";
        }
    }

    /**
 
     * Set the value of role
 
     *
 
     * @return  self
 
     */

    public function setRole($role)
    {
        if ($role === null || trim($role) === '') {

            // S'il est vide, vous pouvez attribuer un rôle par défaut

            $this->role = ["ROLE_USER"];

            // S'il n'y a pas de rôles attitrés, on va lui attribué un rôle

        } else {

            // on récupère du JSON

            // S'il contient une chaîne JSON valide, la décoder

            $this->role = json_decode($role);
            // Vérifier si la décoding a échoué (probablement en raison d'une JSON invalide)

            if ($this->role === null && json_last_error() !== JSON_ERROR_NONE) {

                // Gérer l'erreur de décoding JSON ici si nécessaire
            }
        }
        return $this;
    }

    public function hasRole($role)

    {
        // si dans mon tableau JSON on trouve un rôle qui correspond au rôle en paramètre alors ça va nous return le rôle
        return $this->getRole();
    }

    /*    * Get the value of role   */
    public function getRole()
    {
        return $this->role;
    }

    // Methode ToString

    public function __toString()
    {
        return $this->getEmail() . $this->getPseudo() . $this->getPassword() . $this->getDateInscription() . $this->getBan();
    }
}
