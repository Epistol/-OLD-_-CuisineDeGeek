<?php

$varurl = URL. $url[0];
define("PAGE_URL", $varurl);
define ("PAGE_IDENTIFIER", $url[1]);



/**
 * La view d'une recette
 */

class RecetteView
{

    private $model;
    private $controller;
    private $id_recette;

    private $id_step ;
    private $ingre ;
    private $qtt;
    private $stp_ing;
    private $step_qtt;




    /**
     * RecetteView constructeur.
     * @param $controller
     * @param $model
     */

    function __construct($controller, $model)
    {
        $this->controller = $controller;
        $this->model = $model;
    }


    /**
     * @param $id_error
     */

    public function error_404($id_error){
        echo "<div class='contenupage'>";
        echo $id_error. ' est indisponible pour le moment, veuillez nous excusez pour le dérangement.';
    }

    /**
     * @param $id_recette
     */
    public function index()
    {
        $this->model->redirect('/');
    }

    /**
     * Ajouter une recette
     */


    public function get_infos($info,$id){
        return $this->model->get_truc($info,$id);
    }





    /**
     *
     */
    public function ajouter()
    {





        $yo = $this->model->get_univers();
        require_once('includes/recipes/ajouter.php');


        // si l'utilisateur n'est pas connecté
        if ($this->controller->is_loggedin() == FALSE){
            //redirection vers login
            $this->controller->redirect("/utilisateur/login?location=".urlencode($_SERVER['REQUEST_URI']));
        }

        // si le formulaire est bien posté :
        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            $save = $this->controller->valider_ajout();




            $_SESSION['msg'] = "Votre recette à bien été sauvegardé"; $_SESSION['color'] = 'positive';

            $this->controller->redirect("/recettes/view_recipe?id=$save");





        }




    }


    public function edit($id)
    {




        $id_recette = $id[0];
        $id_verif_recette = $this->get_infos('id',$id_recette);

        $id_auteur = $this->get_infos('id_utilisateur',$id_recette);

        // si la recette n'existe pas
        if( $id_verif_recette == ''){
            $this->model->redirect("/recettes/");
        }
        // si la personne n'a pas les droits sur cette recette
        else if($id_auteur != $_SESSION['user_session'] ){
            $this->model->redirect("/recette/".$id_recette);
        }



        $nom = $this->get_infos('titre',$id_recette);
        $desc = $this->get_infos('commentaire',$id_recette);
        $img_url = $this->get_infos('url_img',$id_recette);
        $univers_cat = $this->get_infos('id_categ_univers',$id_recette);

        $id_origine = $this->get_infos('id_univers',$id_recette);
        $lib_origine = $this->model->verify_univers_by_id($id_origine);

        $type = $this->get_infos('type',$id_recette);
        $diff = $this->get_infos('difficulte',$id_recette);
        $cout = $this->get_infos('cout',$id_recette);
        $nb_convive = $this->get_infos('nb_convives',$id_recette);


        $tps_preparation = $this->get_infos('tps_prepa',$id_recette);
        $tps_preparation_h = floor($tps_preparation / 60);
        $tps_preparation_m = ($tps_preparation) - ($tps_preparation_h * 60);


        $tps_cuisson = $this->get_infos('tps_cuisson',$id_recette);
        $tps_cuisson_h = floor($tps_cuisson / 60);
        $tps_cuisson_m = ($tps_cuisson) - ($tps_cuisson_h * 60);

        $tps_repos = $this->get_infos('tps_repos',$id_recette);
        $tps_repos_h = floor($tps_repos / 60);
        $tps_repos_m = ($tps_repos) - ($tps_repos_h * 60);


        $steps = $this->model->get_steps($id_recette);
        $ingredients = $this->model->get_ingredients($id_recette);



        // si l'utilisateur n'est pas connecté
        if ($this->controller->is_loggedin() == FALSE){
            //redirection vers login
            $this->controller->redirect('/utilisateur/login');
        }



        echo "<div class=\"row\">
  <div class=\"col-md-12\">
";
        $yo = $this->model->get_univers();
        require_once('includes/recipes/modifier.php');
        echo '</div>';
    }



    public function modifier_valid($id)
    {


        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';


        $id_recette = $id[0];
        // si le formulaire est bien posté :
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $this->controller->validation_modif($_POST);

            // TODO : gestion erreurs

            // TODO : gestion erreurs
            $_SESSION['msg'] = "Votre recette à bien été modifié"; $_SESSION['color'] = 'bggreen';
            $this->controller->redirect("/recettes/view_recipe?id=$id_recette");




        }

    }

    public function aside($id)
    {

        $tout = $this->model->get_ingr($id);
        $nb_convive = $this->model->nb_convive($id);
        $lib_univ = $this->model->get_info_rq("SELECT univers.lib_univ FROM univers,recette WHERE recette.id = $id  AND recette.id_univers = univers.id_univ");
        $id_categ_univ = $this->model->get_info_rq("SELECT id_categ_univers FROM recette WHERE recette.id = $id ");
        $categorie = $this->model->get_info_rq("SELECT type FROM recette WHERE recette.id = $id");

        $larecette = $this->controller->get_recette($id);




        if ($id_categ_univ == 0) {
            $position = 900;
        } else {
            $position = -32 + (32 * $id_categ_univ);
        }

        $lib_univ_sans_espace = preg_replace('/\s+/', '', $lib_univ);

        if ($nb_convive == '0') {
            $afficher = '';
        } else if ($nb_convive == '1') {
            $afficher = ' - ' . $nb_convive . ' personne';
        } else {
            $afficher = ' - ' . $nb_convive . ' personnes';
        }

        echo '</div>';


        echo '<div class="menu_vertical col-md-4">';

        if(isset($_SESSION)){
            if(isset($_SESSION['user_session'])){
                if($larecette['id_utilisateur'] == $_SESSION['user_session']){
                    echo '<a href="/recette/edit/'.$larecette['id'].'">C\'est votre recette ! Voulez-vous la
                         modifier ? </a><br />';
                }
            }

        }


        echo '<div class="type_info"><div class="moitie-center type_div">
<a href="/recettes/type/'
            . $categorie. ' "> ' . ucfirst($this->model->affiche_nom_categorie($id, 1)) .
            '</a></div><div class="moitie-center univ_div" ><div class="opt_bg" style="background-position:0 -'
            . $position . 'px" ></div>
            <a href="/recettes/univers/' . strtolower(lcfirst($lib_univ_sans_espace))
            . ' ">'
            . wordwrap(ucfirst($lib_univ), 20, "<br />\n") . '</a></div>
</div>


    ';
        echo '<div class="titre_ingr">Ingrédients' . $afficher . '</div>';
        $i = 1;
        foreach ($tout as $item => $value) {

            echo '<p><span class="mini-button">' . $i . '</span> ' . htmlspecialchars($value['lib_ingredient']) . ' : ' . htmlspecialchars($value["quantite"]) . '</p><br />';
            $i++;
        }


        echo '</div>';
    }



}

