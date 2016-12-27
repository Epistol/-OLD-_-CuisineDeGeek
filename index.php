<?php

// la variable url = demande si le path_info est défini, si oui explose l'url morceau par morceau, sinon c'est un banal '/'
$start_time = microtime(true);
$timestamp = $_SERVER['REQUEST_TIME'];
$root = $_SERVER['DOCUMENT_ROOT'];

if (!isset($_SESSION)) {
    session_start();
    ob_start();
}

require __DIR__ . '/vendor/autoload.php';


// on charge le modele de connexion pour se connecter à la bdd
require_once($root . '/modele/class.connexion.php');

// on charge le modele en passant le mode en paramètre ('dev' ou 'prod')
$connex = new ConnexionModel('dev');
// connexion a la bdd
$maco = $connex->connex_db();


// permet d'exploser l'url
if (isset($_SERVER['REQUEST_URI'])) {
    $url = explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
} else {
    $url = '/';
}

// stocker la provenance de l'utilisateur
if (!empty($_SERVER['HTTP_REFERER'])) {

    $referer = htmlspecialchars($_SERVER['HTTP_REFERER']);
} else {
    $referer = NULL;
}


if (strpos($referer, 'localhost') !== false OR strpos($referer, 'cuisinedegeek.com') !== false) {
    $_SESSION['referer'] = htmlspecialchars($referer);


    /*    // permet d'exploser l'url
        if (isset($_SESSION['referer'])) {
            $url2 = explode('/', ltrim($_SESSION['referer'], '/'));
        } else {
            $url2 = '/';
        }
        foreach(array_slice($url2,3) as $key=>$value)
        {
            echo '<br />Source : ' . $value;
        }*/


}/*
else if (strpos($referer, 'http://t.co') !== false) {
    $_SESSION['referer'] = htmlspecialchars($referer);
    echo 'twitter : ' . $_SESSION['referer'];

    // permet d'exploser l'url
    if (isset($_SESSION['referer'])) {
        $url2 = explode('/', ltrim($_SESSION['referer'], '/'));
    } else {
        $url2 = '/';
    }
    var_dump($url2);


}*/


require_once __DIR__ . '/controler/utilisateur_controller.php';
// charge constamment les infos utilisateurs
require_once __DIR__ . '/modele/class.utilisateur.php';

$user = new UtilisateurModel($maco);
if ($user->is_loggedin()) {

    $user->update_time();
}

/*
echo "<pre>";
print_r($url);
echo "</pre>";
*/


// si on est sur l'index
if ($url[0] == '' || $url[0] == 'index.php' || $url[0] == 'index') {


    require_once __dir__ . '/controler/header.php';


    // Accueil
    // Initialise le controlleur de index
    // et le render de view

    require_once __DIR__ . '/modele/class.index.php';
    require_once __DIR__ . '/controler/index_controller.php';
    require_once __DIR__ . '/view/index_view.php';

    $indexModel = New IndexModel($maco);
    $indexController = New IndexController($indexModel, $user, $maco);
    $indexView = New IndexView($indexController, $indexModel);

    echo $indexView->index();
    require_once 'view/footer/footer.php';


} /*else if ($url[0] == 'recette' && !is_numeric($url[1])) {
    // Accueil
    // Initialise le controlleur de index
    // et le render de view

    $i = 1;
    require_once __DIR__ . '/modele/class.utilisateur.php';
    require_once __DIR__ . '/controler/utilisateur_controller.php';


    require_once __DIR__ . '/view/utilisateur_view.php';

    require_once __DIR__ . '/modele/class.' . $url[0] . '.php';
    require_once __DIR__ . '/controler/' . $url[0] . '_controller.php';
    require_once __DIR__ . '/view/' . $url[0] . '_view.php';

    $recetteModel = New RecetteModel($maco);

    $recetteModel->ajout_visiteur($i, $url[1]);
    $recetteController = New RecetteController($recetteModel, $user, $maco);
    $recetteView = New RecetteView($recetteController, $recetteModel);

    $varpage = $recetteController->get_recette($url[1]);
    $varpage = $varpage['titre'];

    require_once __dir__ . '/controler/header.php';
    echo $recetteView->error_404(htmlspecialchars($url[1]));
    require_once 'controler/footer.php';
}*/


else {


    // Pas l'accueil
    // Initie le controlleur approprié (/controler/$$$_controller.php)
    // et affiche la vue associée

    //le premier element du tableau $url sera un controlleur
    $requestedController = $url[0];
    $varpage = $url[0];


    // si il ya un deuxième élément au tableau $url
    // ça sera une méthode
    $requestedAction = isset($url[1]) ? $url[1] : '';

    // le nom de la page exclut tout ce qui viens après un ? (inclus)
    if (isset($url[1])) {
        $varpage = $url[1];
        if (isset($varpage)) {
            $url2 = explode('?', ltrim($varpage, '?'));
            $varpage = $url2[0];
        } else {
            $url2 = $url[1];
        }
    }


    // le reste sera des arguments de la méthode
    $requestedParams = array_slice($url, 2);

    if (empty($requestedParams)) {
        $requestedParams = '';
    }

    // Regarde si le controlleur existe

    $ctrlPath = __DIR__ . '/controler/' . $requestedController . '_controller.php';


    if (file_exists($ctrlPath)) {

        // MODELES : cette partie gère les données
        require_once __DIR__ . '/modele/class.' . $requestedController . '.php';
        // CONTROLLER : décisionnel et renvoi des données traitées
        require_once __DIR__ . '/controler/' . $requestedController . '_controller.php';
        // VUE : affiche la vue avec les données du controller.
        require_once __DIR__ . '/view/' . $requestedController . '_view.php';


        $modelName = ucfirst($requestedController) . 'Model';
        $controllerName = ucfirst($requestedController) . 'Controller';
        $viewName = ucfirst($requestedController) . 'View';


        $modelObj = new $modelName($maco);
        $controllerObj = new $controllerName($modelObj, $maco);


        // Gestion du nom de la page dans le header.
        if ($url[0] == 'recettes') {
            if (isset($url[1])) {
                if (strstr($url[1], 'view_recipe')) {
                    $page = (!empty($_GET['id']) ? $_GET['id'] : 1);
                    $larecette = $controllerObj->get_recette_id($page);
                    $varpage = htmlspecialchars($larecette['titre']);
                } // TODO : faire un 'index' d'univers
                else if (strstr($url[1], 'univers')) {


                    if (isset($url[2])) {
                        if ($url[2] != NULL) {
                            $page = $url[2];
                        }
                    }


                    if (isset($page) AND $page != NULL) {
                        $id_univ = explode('_', ltrim($page, '_'));
                        $nom_univers = ucfirst($controllerObj->get_infos_param('lib_univ', 'univers', $id_univ[0]));
                        $varpage = htmlspecialchars($nom_univers) . ' - Univers ';
                    } else {
                        $id_univ = '/';
                        $nom_univers = '';
                        $varpage = 'Univers';

                    }


                } else if (strstr($url[1], 'page?')) {
                    $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
                    $varpage = 'Recettes / ' . htmlspecialchars($varpage) . ' ' . htmlspecialchars($page);
                }
            }


        }


        if ($url[0] == 'modules') {
            if (isset($url[1])) {
                if (strstr($url[1], 'page')) {
                    $page = $url[2];
                    $lapage = $controllerObj->get_page($page);
                    $varpage = htmlspecialchars($lapage['name']);
                }


            }


        }


        if ($url[0] == 'admin') {

        }

        //on charge toujours le header
        require_once __dir__ . '/controler/header.php';


        $viewObj = new $viewName($controllerObj, $modelObj);


//        $viewObj = new $viewName($controllerObj, new $modelName($maco));


        /*
                SOLUTION POUR PAGE 404 à trouver

           if(!method_exists($url[1],$viewObj)){

                    header("Location: ../index.php");
                }*/


        // si il ya une méthode d'appellée
        if ($requestedAction != '') {
            // alors on appelle la vue liée à la méthode

            // si l'action comporte un $_GET['qqch']
            if (strpos($requestedAction, '?') !== false) {

                $url_explosee_get = explode('?', ltrim($requestedAction, '?'));
                $action = $url_explosee_get[0];
                $param = '?' . $url_explosee_get[1];
                echo $viewObj->$action($param);
            } else {
                echo $viewObj->$requestedAction($requestedParams);


            }


        } else {

            echo $viewObj->index();

        }

    } else {
        //on charge toujours le header
        $varpage = 'Erreur 404';
        require_once __dir__ . '/controler/header.php';
        require_once("404.php");

    }

// on charge le pied de page
    require_once 'view/footer/footer.php';


}