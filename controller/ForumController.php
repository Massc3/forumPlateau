<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Entities\Topic;
use Model\Managers\TopicManager;
use Model\Managers\CategoryManager;
use Model\Managers\PostManager;

class ForumController extends AbstractController implements ControllerInterface
{

    // fonction pour afficher la liste des Topics
    public function index()
    {

        $topicManager = new TopicManager();

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findAll(["dateCreation", "DESC"])
            ]
        ];
    }
    // fonction pour afficher la liste des Categories

    public function listCategories()
    {
        $categoryManager = new CategoryManager();

        $manager = new CategoryManager();
        $categories = $manager->findAll();


        return [
            "view" => VIEW_DIR . "forum/listCategories.php",
            "data" => [
                "categories" => $categoryManager->findAll(["nameCategory", "DESC"]),
                "title" => "liste categories",
            ]
        ];
    }

    public function findTopicByCategoryId($id)
    {
        $categoryManager = new CategoryManager();
        $topicManager = new TopicManager();

        $category = $categoryManager->findOneById($id);

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findTopicByCategoryId($id),
                "category" => $category
            ]
        ];
    }

    // fonction pour afficher un post d'un Topic

    public function findPostByTopicId($id)
    {
        $postManager = new PostManager();
        $topicManager = new TopicManager();


        $topic = $topicManager->findOneById($id);

        return [
            "view" => VIEW_DIR . "forum/postTopics.php",
            "data" => [
                "posts" => $postManager->findPostByTopicId($id),
                "topic" => $topic
            ]
        ];
    }


    // Formulaire de l'ajout d'une categorie
    public function addCategoryForm()
    {
        return [
            "view" => VIEW_DIR . "forum/addCategoryForm.php",
        ];
    }

    // fonction pour savoir si l'ajout d'une categorie a fonctionner ou non 
    public function addCategory()
    {

        // filtrer ce qui arrive en POST
        $nameCategory = filter_input(INPUT_POST, "nameCategory", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $categoryManager = new CategoryManager();



        // validation des règles du formulaire
        $isFormValid = true;
        $errorMessages = [];

        // category est obligatoire
        if ($nameCategory == "") {
            $isFormValid = false;
            $errorMessages["nameCategory"] = "Ce champ est obligatoire";
        }

        // category ne doit pas dépasser 30 caractères
        if (strlen('nameCategory') > 30) {
            $isFormValid = false;
            $errorMessages["nameCategory"] = "Ce champ est limité à 30 caractères";
        }

        // si les règles de validation du formulaire sont respectées
        if ($isFormValid) {

            // (id_category, category)
            $categoryManager->add(["nameCategory" => $nameCategory]);

            $this->redirectTo("forum", "listCategories");

            // var_dump($error); // $error["errorInfo"][2]
            // die();
        } else {
            // le formulaire est invalide

            $globalMessage = "Le formulaire est invalide";

            $formValues = [
                "nameCategory" => $nameCategory
            ];
        }
    }

    // Ajoute des topics avec un message

    public function addTopicForm($id)
    {
        $categoryManager = new CategoryManager();
        /**

         * App/Session::getFlash()

         * Dans addTopicForm : action="index.php?ctrl=forum&action=addTopic&id=<?= $id ?>" : on récupère l'id de la category grâce au lien pour ajouter un topic qui se trouve dans UNE category ($_GET["id"])

         */

        return [
            "view" => VIEW_DIR . "forum/addTopicForm.php",

            "data" => [
                "category" => $categoryManager->findOneById($id),
                "successMessage" => Session::getFlash('success'),
                "errorMessage" => Session::getFlash('error')
            ]
        ];
    }

    // ajouter un topic en fonction de la catégorie sur laquelle on a cliqué

    public function addTopic($id)
    {
        // filtrer ce qui arrive en POST

        // "title" : vient du name="title" du fichier addTopicForm.php

        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($title && $text) {

            $topicManager = new TopicManager();
            $postManager = new PostManager();
            /**
             * On ajoute un topic en fontion de la catégorie
             * $topicId -> DAO->return self::$bdd->lastInsertId() : pour pousser l'id jusquà la table Message et donc pouvoir ajouter un message ("topic_id" => $topicId)
             */

            $topicId = $topicManager->add(["title" => $title, "user_id" => 1, "category_id" => $id]);

            /**
             * on ajoute le message
             */
            $postManager->add(["text" => $text, "user_id" => 1, "topic_id" => $topicId]);
            Session::addFlash('success', 'Le topic a été ajouté');
            /**
             * On redirige vers layout pour voir le message s'afficher
             */

            $this->redirectTo('forum', 'findTopicByCategoryId', $id);
        } else {
            return $this->addTopicForm($id);
        }
    }


    // fonction pour mettre à jour les posts 
    public function addPostForm($id)
    {
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        return [
            "view" => VIEW_DIR . "forum/addPostForm.php",
            "data" => [
                "topic" => $topic
            ]
        ];
    }

    public function addPost($id)
    {

        // filtrer ce qui arrive en POST
        $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $topic = filter_input(INPUT_POST, "topicId", FILTER_SANITIZE_NUMBER_INT);

        $postManager = new PostManager();
        // vars
        $isAddPostSuccess = false;
        $globalMessage = "L'enregistrement a bien été effectué";
        $formValues = null;

        // validation des règles du formulaire
        $isFormValid = true;
        $errorMessages = [];

        // post est obligatoire
        if ($text == "") {
            $isFormValid = false;
            $errorMessages["text"] = "Ce champ est obligatoire";
        }

        // post ne doit pas dépasser 30 caractères
        if (strlen('text') > 30) {
            $isFormValid = false;
            $errorMessages["text"] = "Ce champ est limité à 30 caractères";
        }

        // si les règles de validation du formulaire sont respectées
        if ($isFormValid) {


            // (id_post, post)
            $postManager->add(["text" => $text, "topic_id" => $topic]);

            $this->redirectTo("forum", "findPostByTopicId", $topic);

            // var_dump($error); // $error["errorInfo"][2]
            // die();
        } else {
            // le formulaire est invalide

            $globalMessage = "Le formulaire est invalide";

            $formValues = [
                "text" => $text
            ];
        }
    }
    // fonction pour mettre à jour les topics 
    public function updateTopicForm($id)
    {
        $topicManager = new TopicManager();

        $topic = $topicManager->findOneById($id);

        return [
            "view" => VIEW_DIR . "forum/updateTopicForm.php",
            "data" => [
                "topic" => $topic,
                "categoryId" => $_GET['categoryId']
            ]
        ];
    }
    // Verification de la fonction pour mettre à jour les topics
    public function updateTopic($id)
    {
        $topicManager = new TopicManager();
        // filtrer ce qui arrive en POST
        // "updateTopic" : vient du name="updateTopic" du fichier addTopicForm.php
        $updateTopic = filter_input(INPUT_POST, "updateNameTopic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $categoryId = filter_input(INPUT_POST, "categoryId", FILTER_SANITIZE_NUMBER_INT);

        // validation des règles du formulaire
        $isFormValid = true;
        $errorMessages = [];

        // post est obligatoire
        if ($updateTopic == "") {
            $isFormValid = false;
            $errorMessages["updateTopic"] = "Ce champ est obligatoire";
        }

        if ($isFormValid) {

            // (id_topic, topic)
            // newTitle = au newTitle de ma requete Sql 
            $topicManager->update(["id" => $id, "newTitle" => $updateTopic,]);

            $this->redirectTo("forum", "findTopicByCategoryId", $categoryId);

            // var_dump($error); // $error["errorInfo"][2]
            // die();
        } else {
            // le formulaire est invalide
            $isActionSuccess = false;

            $globalMessage = "Le formulaire est invalide";
        }
    }
    public function deletePost($id)
    {

        $postManager = new PostManager();

        $postManager->delete($id);
        $topicId = $_GET['topicId'];
        $this->redirectTo("forum", "findPostByTopicId", $topicId);
    }
    public function deleteTopic($id)
    {

        $topicManager = new TopicManager();
        $topicManager->delete($id);
        $categoryId = $_GET['categoryId'];
        $this->redirectTo("forum", "findTopicByCategoryId", $categoryId);
    }
}
