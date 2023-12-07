<?php
    //!import du fichier de configuration
    include './env.php';
    //!import de l'autoloader des classes
    require_once './vendor/autoload.php';
    // require_once './vendor/autoload.php';
    use App\Controller\UtilisateurController;
    use App\Controller\RoleController;
    use App\Controller\HomeController;
    use App\Controller\RecetteController;
    use App\Controller\CommentaireController;
    use App\Controller\IngredientController;
    $userController = new UtilisateurController();  
    $roleController = new RoleController();
    $homeController = new HomeController();   
    $recetteController = new RecetteController();
    $commentaireController = new CommentaireController();  
    $ingredientController = new IngredientController();
    //!utilisation de session_start(pour gérer la connexion au serveur)
    session_start();
    //!Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //!test si l'url posséde une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    //!version connecté
    if(isset($_SESSION['connected'])){
        //routeur
        switch ($path) {
            case '/projetSite':
                $homeController->getHome();
                break;
            case '/projetSite/roleadd':
                $roleController->addRole();
                break;
            case '/projetSite/userdeconnexion':
                $userController->deconnexionUser();
                break;
            case '/projetSite/recetteadd':
                $recetteController->addRecette();
                break;
                case '/projetSite/ingredientadd':
                    $ingredientController->addIngredient();
                    break;
            case '/projetSite/recetteall':
                $recetteController->getAllRecette();
                break;
                // case '/projetSite/recetteone':
                //     $recetteController->getOneRecette($id_recette);
                //     break;
            case '/projetSite/emailtest':
                $homeController->testMail();
                break;
            case '/projetSite/commentaireadd':
                $commentaireController->addCommentaire();
                break;
            case '/projetSite/commentaireall':
                $commentaireController->allCommentaire();
                break;
            default:
                $homeController->get404();
                break;
        }
    }
    //!Version deconnecté
    else{
        switch ($path) {
            case '/projetSite/':
                $homeController->getHome();
                break;
            case '/projetSite/userconnexion':
                $userController->connexionUser();
                break;
            case '/projetSite/useradd':
                $userController->addUser();
                break;
            case '/projetSite/recetteall':
                $recetteController->getAllRecette();
                break;
            case '/projetSite/emailtest':
                $homeController->testMail();
                break;
            case '/projetSite/useractivate':
                $userController->activateUser();
                break;
            case '/projetSite/commentaireall':
                $commentaireController->allCommentaire();
                break;
            case '/projetSite/commentaireadd':
            // case '/projetSite/recetteupdate':
                $homeController->get401();
                break;
            default:
                $homeController->get404();
                break;
        }
    }
?>
