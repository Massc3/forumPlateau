<?php

namespace Controller;


use App\DAO;
use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;


class SecurityController extends AbstractController implements ControllerInterface
{

    public function index()

    {
        // return [

        //     "view" => VIEW_DIR . "error404.php"
        // ];
    }
    public function listUsers()
    {
        $manager = new UserManager();
        $users = $manager->findAll();

        return [
            "view" => VIEW_DIR . "view/listUsers.php",
            "data" => ["users" => $users]
        ];
    }

    public function userProfil($id)
    {
        $userManager = new UserManager();
        $user = $userManager->findOneById($id);

        return [
            "view" => VIEW_DIR . "security/userProfil.php",
            "data" => [
                "user" => $user
            ]
        ];
    }


    public function registerForm()
    {
        /**

         * App/Session::getFlash()

         */

        return [

            "view" => VIEW_DIR . "security/registerForm.php",

            "data" => [
                "successMessage" => Session::getFlash('success'),
                "errorMessage" => Session::getFlash('error')
            ]

        ];
    }



    public function register()

    {
        // filtrer ce qui arrive en POST
        // "pseudo" : vient du name="pseudo" du fichier register.php
        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $userEmail = filter_input(INPUT_POST, "userEmail", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);



        // password_hash = creates a new password hash using a strong one-way hashing algorithm.

        /**

         * PASSWORD_DEFAULT - Use the bcrypt algorithm (default as of PHP 5.5.0). Note that this constant is designed to change over time as new and stronger algorithms are added to PHP. For that reason, the length of the result from using this identifier can change over time. Therefore, it is recommended to store the result in a database column that can expand beyond 60 characters (255 characters would be a good choice).

         */



        if ($pseudo && $userEmail && $password && $confirmPassword) {

            $userManager = new UserManager();
            // on doit d'abord rechercher si le userEmail existe en BDD

            if (!$userManager->findOneByEmail($userEmail)) {

                // si c'est false on poursuit


                // si le password correspond au confirmPassword et que la longueur de la chaîne de caractère du password est supérieur ou égale à 12

                if (($password == $confirmPassword) and (strlen($password) >= 12)) {



                    // On va hasher le password et enregistrer le user en BDD

                    // un password est hashé en BDD. Le hashage est un mécanisme unidirectionnel et irréversible. ON NE DEHASHE JAMAIS UN PASSWORD!!!



                    // la fonction password_hash va nous demander l'algorithme de hash choisi. Les algos a priviligié sont BCRYPT et ARGON2i.

                    // Ne pas utiliser sha ou md5

                    // DCRYPT et ARGON2i font parti des algos de hash fort

                    // sha ou md5 font parti des algos de hash faible



                    $password_hash = password_hash($password, PASSWORD_DEFAULT);

                    // password_default utilise par défault l'algo BCRYPT

                    // BCRYPT est un algo fort comme ARGON2i

                    // il va créé une empreinte numérique en BDD composé de l'algo utilisé, d'un cost, d'un salt et du password hashé

                    // le salt est une chaîne de caractère aléatoire hashée qui sera concaténé à notre password hashé.

                    // si un pirate récupère notre password hashé il aura plus de difficulté à découvrir notre MDP d'origine



                    // $password_hash2 = md5($password);


                    $userManager->add(['pseudo' => $pseudo, 'email' => $userEmail, 'password' => $password_hash, "role" => json_encode(['ROLE_USER'])]);
                } else {



                    Session::addFlash('error', 'Le mot de passe ne sont pas identiques ou pas assez long');
                }
            } else {



                Session::addFlash('error', 'Email déjà utilisé');
            }
        }



        $this->redirectTo("forum", "listCategories");
    }

    /**

     * LOGIN FORM

     */
    public function loginForm()

    {

        /**
 
         * App/Session::getFlash()
 
         */

        return [

            "view" => VIEW_DIR . "security/loginForm.php",

            "data" => [

                "successMessage" => Session::getFlash('success'),

                "errorMessage" => Session::getFlash('error')

            ]

        ];
    }



    /**
 
     * LOGIN
 
     */



    public function login()

    {



        // je filtre les données envoyées dans le formulaire



        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);



        // on va d'abord vérifié si le filtrage s'est bien passé

        if ($pseudo && $password) {



            // on va instancier le UserManager pour vérifier que j'ai bien un user à ce nom là

            $userManager = new UserManager();



            $user = $userManager->findOneByPseudo($pseudo);



            if ($user) {

                $userId = $user->getPassword();

                // si un user existe avec ce pseudo on continue

                // on va vérfier que le password donné dans le formulaire de login correspond au password de l'utilisateur qui pseudo



                if (password_verify($password, $userId)) {



                    // PASSWORD_VERIRFY VA COMPARER DEUX CHAINES DE CARACTERES HASHE!



                    if ($user->getBan() == 0) {

                        // si ça fonctionne on met le user en session

                        Session::setUser($user);



                        $this->redirectTo('forum', 'listCategories');
                    } else {



                        $this->redirectTo('forum', 'listCategories');



                        Session::addFlash('error', 'personne ne t aime tu es banni!!!');
                    }
                }
            } else {



                $this->redirectTo('forum', 'listCategories');
            }
        }
    }
    // fonction pour mettre à jour un mot de passe 
    public function updatePasswordForm($id)
    {
        $userManager = new userManager();

        $user = $userManager->findOneById($id);
        $password = "password";

        return [
            "view" => VIEW_DIR . "forum/updatePasswordForm.php",
            "data" => [
                "user" => $user,
                "password" => $password,
            ]
        ];
    }


    // Récupérer le mot de passe haché de l'utilisateur depuis la base de données

    // public function updatePasswordForm($id)
    // {
    //     return [

    //         "view" => VIEW_DIR . "security/updatePasswordForm.php",

    //         "data" => [

    //             "successMessage" => Session::getFlash('success'),

    //             "errorMessage" => Session::getFlash('error')

    //         ]

    //     ];
    // }
    public function updatePassword()
    {
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $hash = filter_input(INPUT_POST, "hash", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $newPassword = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // On vérifie que le pseudo et le mot de passe correspondent à la BDD sinon il faudra indiquer qu'il y a une erreur de pseudo ou de mot de passe.

        if (password_verify($password, $hash)) {



            Session::addFlash('success', 'Le mot de passe est valide !');

            $this->redirectTo('view', 'home');
        } else {



            Session::addFlash('error', 'Nom d\'utilisateur ou mot de passe incorrect.');

            $this->redirectTo('view', 'layout');
        }
    }

    /**
 
     * LOG OUT
 
     */



    public function logout()
    {



        session_start();



        session_destroy();



        $this->redirectTo('security', 'loginForm');
    }
}
