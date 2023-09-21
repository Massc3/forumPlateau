<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\CategoryManager;
use Model\Managers\PostManager;

class HomeController extends AbstractController implements ControllerInterface
{

    public function index()
    {


        return [
            "view" => VIEW_DIR . "security/home.php",
            "data" => [
                "title" => "Acceuil",
                "description" => "forum sur le sport"
            ]
        ];
    }


    public function forumRules()
    {

        return [
            "view" => VIEW_DIR . "rules.php"
        ];
    }

    /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/

    // faire la public function home
}
