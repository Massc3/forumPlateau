<?php
// je le range dans l'espace virtuel
namespace Model\Entities;
// on indique d'aller chercher la class Entity dans le dossier app
use App\Entity;
// on interdit un heritage de la class, elle n epeut pas avoir d'enfant c'est une classe finale. La classe topic herite de la Entity
final class Post extends Entity
{

    //liste des propriétés de la classe Topic, selon le principe d'encapsulation : (la visibilité des elements au sein d'une classe) mes propriété sont privé et que accessible au sein d'une classe
    private $id;
    private $user;
    private $topic;
    private $text;
    private $datePost;


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
     * Get the value of text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of datePost
     */
    public function getDatePost()
    {
        return $this->datePost;
    }

    /**
     * Set the value of datePost
     *
     * @return  self
     */
    public function setDatePost($datePost)
    {
        $this->datePost = $datePost;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set the value of topic
     *
     * @return  self
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    public function __toString()
    {
        return $this->getText() . $this->getDatePost() . $this->getUser() . $this->getTopic();
    }
}
