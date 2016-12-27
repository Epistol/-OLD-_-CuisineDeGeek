<?php


/**
 * The about page view
 */
class AdminView
{

    private $modelObj;

    private $controller;
    private $active;


    /**
     * CONSTRUCTEUR ADMIN VIEW
     * @param $controller
     * @param $model
     * @param $url
     */
    function __construct($controller, $model)
    {


        echo '

<script>

$(document).ready(function() {
    $(\'a\').each(function() {
        if ($(this).prop(\'href\') == window.location.href) {
            $(this).addClass(\'selected\');
        }
    });
});
</script>



<div class="container" style="
                width: 100%;
                padding: 0px;min-height: 100vh;
            ">
            
            <div class="ui internal left rail" style="padding: 0px!important;margin-top: 5rem;margin-left: 0px;">
            
            ';

        echo $this->menu_aside('');

        echo '</div>';


        //chargement du controlleur
        $this->controller = $controller;
        //chargement du modele
        $this->modelObj = $model;


    }


    /** VERIFICATION DU ROLE DE L'UTILISATEUR QUI ACCEDE A CETTE PARTIE
     * @return mixed
     */
    private function verif_logged_role()
    {

        return $this->controller->get_info_current_user2('role');

    }


    /** DOIT RENVOYER UNE FENETRE DE VALIDATION MODALE
     *
     */
    private function modal()
    {

    }


    /**
     * ACCUEIL DE L'ESPACE ADMINISTRATION
     */
    public function index()
    {

        echo '  <div class="contenu_admin">';

        // si la personne est co :
        if ($this->controller->is_loggedin() == TRUE) {
            echo 'Bonjour et ';
            $role = $this->verif_logged_role();
            // si c'est un admin :
            if ($role == 1) {
                echo 'bienvenue ' . $this->modelObj->get_pseudo();
            } // si c'est user lambda : ça dégage.
            else {
                $_SESSION['msg'] = 'Vous n\'avez pas l\'autorisation d\'accéder à cette partie du site.';
                $_SESSION['color'] = 'bgorange';
                $this->controller->redirect('/index');
            }
        } else {
            $this->controller->redirect("/utilisateur/login?location=" . urlencode($_SERVER['REQUEST_URI']));
        }

        ?>


        </div>
        <?php

    }


    /**
     *
     *  MENU VERTICAL LATERAL
     * @param $url
     * @return string
     */
    public function menu_aside($url)
    {


        $noms = array('Admin', 'Pages', 'Liste utilisateurs', 'Liste recettes');
        $liens = array('/admin/', '/admin/pages/', '/admin/liste_users', '/admin/liste_recettes');


        $index = '';
        $liste_user = '';
        $liste_r = '';
        $num = 0;


        if (isset($_SERVER['REQUEST_URI'])) {
            $url2 = explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
        } else {
            $url2 = '/';
        }


        foreach ($liens as $lien) {

            if ($url == $lien[$num]) {
                $class = 'current transition';
                break;
            } else {
                $class = 'main-nav-link';
            }

            $num++;
        }


        include_once './includes/menu_aside.inc.php';


    }

    /**
     * LISTE DES UTILISATEURS DU SITE CLASSES PAR INFOS
     */
    public function liste_users()
    {


        echo '   <div class="contenu_admin">';


        $tout_user = $this->modelObj->get_users('all');


        $count = 0;
        foreach ($tout_user as $nb) {
            $count++;
        }
        echo '<p><i class="material-icons">account_box</i> ' . $count . ' utilisateurs</p>';
        include './includes/liste_users.inc.php';

        $max_page = $this->controller->get_max_pages();


    }

    public function pages($id)
    {

        echo '<div class="contenu_admin">';


        $toutes_pages = $this->controller->get_pages();


        $count = 0;
        foreach ($toutes_pages as $nb) {
            $count++;
        }


        if ($id[0] == 'edit') {

            echo '<p>EDITION :</p> ';

            $page = $this->controller->get_page($id[1]);

            include './includes/admin/page_edit.inc.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {


                if ($this->controller->edit_page($id[1]) == TRUE) {
                    $this->controller->redirect('/admin/pages/');
                }


            }

        } elseif ($id[0] == 'ajouter') {
            echo '<p>AJOUT :</p> ';

            include './includes/admin/page_ajout.inc.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {


                if ($this->controller->ajout() == TRUE) {
                    var_dump($_POST);
                    //$this->controller->redirect('/admin/pages/');


                }
            }

        } elseif ($id[0] == 'supprimer') {

            $page = $this->controller->get_page($id[1]);

            echo '<p>Supprimer :</p> ';

            include './includes/admin/page_supprimer.inc.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {


                if ($this->controller->ajout() == TRUE) {
                    var_dump($_POST);
                    //$this->controller->redirect('/admin/pages/');


                }
            }

        } else {
            include './includes/admin/liste_pages.inc.php';
        }


    }


    private function select_recette($id, $action)
    {

        $j = 0;
        $tab = array();

// Si la recette est cochée :
        if ($_POST['checked']) {


            $get = $this->modelObj->get_recettebyid($id, $action);


            return $get;


        }
    }


    /**
     * LISTE DES RECETTES => FONCTIONS COMPLEMENTAIRES
     */
    public function liste_recettes($fonction)
    {

        echo '   <div class="contenu_admin">';


        $nb_r = $this->modelObj->get_recettes();
        $j = 0;

        while ($donnees = $nb_r->fetch()) {
            $j++;
        }

        echo 'Nombre de recettes : ' . $j . '<br />';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST['checked']) {
                // pour chaque élément coché
                foreach ($_POST['checked'] as $item) {

                    var_dump($item);

                    if ($_POST['action'] == 'delete') {
                        if ($this->select_recette($item, 'delete') == TRUE) {

                        }
                    } else {

                    }
                }
            }
        }


        $max_page = $this->controller->get_max_pages();

        echo $this->modal();


// VUE :


        if (isset($fonction[0]) AND $fonction[0] == 'edit') {
            echo $fonction[1];

            echo '<p>EDITION :</p> ';

            $recette = $this->modelObj->get_recettebyid($fonction[1], 'update');

            $yo = $this->modelObj->get_univers();

            include './includes/admin/recettes/recette_edit.inc.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            }


        } else {
            include './includes/admin/form_admin.inc.php';
        }

    }


}

