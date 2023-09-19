<?php
// je le range dans l'espace virtuel
namespace Model\Entities;
// on indique d'aller chercher la class Entity dans le dossier app
use App\Entity;
// on interdit un heritage de la class, elle n epeut pas avoir d'enfant c'est une classe finale. La classe topic herite de la Entity
final class Category extends Entity
{

    //liste des propriétés de la classe Topic, selon le principe d'encapsulation : (la visibilité des elements au sein d'une classe) mes propriété sont privé et que accessible au sein d'une classe
    private $id;
    private $nameCategory;

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
     * Get the value of nameCategory
     */
    public function getNameCategory()
    {
        return $this->nameCategory;
    }

    /**
     * Set the value of nameCategory
     *
     * @return  self
     */
    public function setNameCategory($nameCategory)
    {
        $this->nameCategory = $nameCategory;

        return $this;
    }
    public function __toString()
    {
        return $this->getNameCategory();
    }
}
