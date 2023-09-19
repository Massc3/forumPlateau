<?php
// je le range dans l'espace virtuel
namespace Model\Entities;
// on indique d'aller chercher la class Entity dans le dossier app
use App\Entity;
// on interdit un heritage de la class, elle n epeut pas avoir d'enfant c'est une classe finale. La classe topic herite de la Entity
final class Topic extends Entity
{
        //liste des propriétés de la classe Topic, selon le principe d'encapsulation : (la visibilité des elements au sein d'une classe) mes propriété sont privé et que accessible au sein d'une classe
        private $id;
        private $title;
        private $dateCreation;
        private $locked;
        private $category;
        private $user;

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
         * Get the value of title
         */
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */
        public function setTitle($title)
        {
                $this->title = $title;

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

        public function getdateCreation()
        {
                $formattedDate = $this->dateCreation->format("d/m/Y, H:i:s");
                return $formattedDate;
        }

        public function setdateCreation($date)
        {
                $this->dateCreation = new \DateTime($date);
                return $this;
        }

        /**
         * Get the value of locked
         */
        public function getlocked()
        {
                return $this->locked;
        }

        /**
         * Set the value of locked** 
         * @return  self
         **/
        public function setlocked($locked)
        {
                $this->locked = $locked;

                return $this;
        }

        /**
         * Get the value of category
         */
        public function getCategory()
        {
                return $this->category;
        }

        /**
         * Set the value of category
         *
         * @return  self
         */
        public function setCategory($category)
        {
                $this->category = $category;

                return $this;
        }
        public function __toString()
        {
                return $this->getTitle() . $this->getDateCreation() . $this->getlocked() . $this->getCategory() .  $this->getUser();
        }
}
