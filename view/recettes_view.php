<?php


class RecettesView
{

    private $model;

    private $controller;


    /**
     * RecettesView constructor.
     * @param $controller
     * @param $model
     */
    function __construct($controller, $model)
    {
        $this->controller = $controller;

        $this->model = $model;


    }


    private function formater ($aform){
    return $this->format('d-m-Y H:i');
}




    /**
     * @param $recette
     * @param $id
     */
    private function aside($recette, $id){
        echo '<div class="one wide column"></div><div class="four wide column">';

        if($recette == TRUE){

            $tout = $this->model->get_ingr($id);
            $nb_convive = $this->model->nb_convive($id);
            $lib_univ = $this->model->get_info_rq("SELECT univers.lib_univ FROM univers,recette WHERE recette.id = $id 
AND recette.id_univers = univers.id");
            $id_univ = $this->model->get_info_rq("SELECT univers.id FROM univers,recette WHERE recette.id = $id 
AND recette.id_univers = univers.id");

            $categorie = $this->model->get_info_rq("SELECT type FROM recette WHERE recette.id = $id");


            $larecette = $this->controller->get_recette_id($id);





            $lib_univ_sans_espace = preg_replace('/\s+/', '', $lib_univ);

            if ($nb_convive == '0') {
                $afficher = '';
            } else if ($nb_convive == '1') {
                $afficher = ' - ' . $nb_convive . ' personne';
            } else {
                $afficher = ' - ' . $nb_convive . ' personnes';
            }





            if(isset($_SESSION)){
                if(isset($_SESSION['user_session'])){
                    if($larecette['id_utilisateur'] == $_SESSION['user_session']){
                        echo '<a href="/recette/edit/'.$larecette['id'].'">C\'est votre recette ! Voulez-vous la
                         modifier ? </a><br />';
                    }
                }

            }

            $id_categ_univ = $this->model->get_info_rq("SELECT id_categ_univers FROM recette WHERE recette.id = $id ");
            if ($id_categ_univ == 0) {
                $position = 900;
            } else {
                $position = -32 + (32 * $id_categ_univ);
            }


            echo '<div class="type_info"><div class="moitie-center type_div">
                <a itemprop="recipeCategory" href="'.'http://' . $_SERVER['HTTP_HOST'] .'/recettes/type/'
                . $categorie. ' "> ' . ucfirst($this->model->affiche_nom_categorie_recette($id, 1, 1)) .
                '</a></div><div class="moitie-center univ_div" ><div class="opt_bg" style="background-position:0 -'
                . $position . 'px" ></div>
                <a href="/recettes/univers/' . $id_univ . '">'
                . wordwrap(ucfirst($lib_univ), 20, "<br />\n") . '</a>
                </div>
                 </div>


    ';
            echo '<div class="ui sticky bg_ingredients">
    
    
    
    <div class="titre_ingr">Ingrédients' . $afficher . '</div><div class="ui relaxed selection list">';
            $i = 1;
            foreach ($tout as $item => $value) {

                echo ' <div class="item"> ' . htmlspecialchars($value["quantite"]) . ' ' .    htmlspecialchars($value['lib_ingredient']) . '</div>';
                $i++;
            }


            echo '</div></div></a></div>';?>

             <script>
            $('.ui.sticky')
                .sticky({
                    context: '#example1'
                })
            ;
        </script>

<?php
        }

    }

    /**
     *
     */
    public function index()
    {

        return $this->page('1');
    }

    /**
     * @param $param
     */public function page($param)
{


    if (isset($param)) {
        $url2 = explode('?', ltrim($param, '?'));
    } else {
        $url2 = '/';
    }

    if (isset($url2)) {
        $url3 = explode('=', ltrim($url2[0], '='));
    } else {
        $url3 = '/';
    }

    $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
    $limite = 18;
    $debut = ($page - 1) * $limite;

    // view :
    require_once './includes/liste_recettes.inc.php';


}




    /**
     * @param $param
     */
    public function view_recipe($param)
{


    if (isset($param)) {
        $url2 = explode('?', ltrim($param, '?'));
    } else {
        $url2 = '/';
    }

    if (isset($url2)) {
        $url3 = explode('=', ltrim($url2[0], '='));
    } else {
        $url3 = '/';
    }

    $page = (!empty($_GET['id']) ? $_GET['id'] : 1);
    $limite = 18;
    $debut = ($page - 1) * $limite;





    // TODO A reprendre avec boostrap et getmcl
    // TODO ne pas oublier un système de notation des utilisateurs
    // TODO partage recette réseaux sociaux
    // TODO Date d'ajout




    $larecette = $this->controller->get_recette_id($page);

    // si la recette n'existe pas, on 404
    if($larecette == '' OR NULL ){
        $this->controller->redirect('/recettes/error_404');

    }


    // un petit debug qui va bien


    // echo "<pre>";
    // var_dump($larecette);
    // echo "</pre>";

    // display
    $tmaj = $this->model->get_ingr($page);
    require_once './includes/view_recipe.inc.php';

    echo $this->aside('TRUE',$page);
    echo '</div> 
</div>';



}

    /**
     *
     */

    public function categories()
    {
        echo '<div class=\'col-md-8\'>';
        ?>

        <div class="titre_page">
            <p>Liste des recettes par catégorie</p>
        </div>
        <a href='../recette/ajouter'>Ajouter une recette</a><br/>


        <?php
        echo $this->model->get_all_pictures();

        echo "<div class='clearfix'></div>";


    }

    public function error_404()
    {
        echo 'Erreur : la recette demandée est indisponible.';

    }



// TODO : continuer.
    /**
     * @param $id
     * @param $i
     */


    private function icone_categ_univ($id, $i){

    $nb_categorie = $this->model->get_info_rq("SELECT COUNT(DISTINCT id_categ_univers) FROM recette WHERE id_univers = $id ");
    echo  $nb_categorie . '<br />';




    try {
        $requete = $this->controller->get_infos_param_complet('SELECT DISTINCT id_categ_univers FROM recette WHERE id_univers = '.$id);



        while ($donnees = $requete->fetch()) {
            $nom_univers = $this->controller->get_nom_categ_univers($donnees['id_categ_univers']);

            echo ' 
                        <!-- Button Chip -->
                        <a href="/recettes/categorie/'.$donnees['id_categ_univers'].'"
                        <button type="button" class="mdl-chip">
                            <span class="mdl-chip__text">'.$nom_univers.'</span>
                        </button>
                        </a>
                     ';



        }

    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }


}

    public  function limit_texter($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

// affiche les recettes issues de films, manga, jeux, etc
    /**
     * @param $id
     */

    public function categorie($id)
    {
        echo '<div class=\'ui main container segment items\' style="min-height: 100vh">';
        if ($this->controller->get_univ_categ($id[0]) == '') {
            $this->controller->redirect("/index");
        }

        echo 'Catégorie : ' . $this->controller->get_univ_categ($id[0]);
        echo $this->get_categ($id[0], 'id_categ_univers');


    }

    /**
     * @param $id
     * @param $type
     */
    private function get_categ($id, $type)
{

    try {
        $requete = $this->controller->get_recipes_by_categorie($id, $type);

        while ($donnees = $requete->fetch()) {


            // img recette
            echo '<a href="/recettes/view_recipe?id=' . $donnees['id'] . '">';

            if ($donnees['url_img'] != '') {
                // on récupère le fichier thumbnailé ;)
                $afficher = '/img/recette/thumbs/thumb' . $donnees["url_img"];
            } else {
                // defaut img si aucune n'est définie
                // en base64 car c'est + rapide et ça fait kewl.
                $afficher = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWCAIAAACzY+a1AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NjZEQ0JDOTEyMTg3MTFFNjg4QzFEQjRGNDZBQTAzOUEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NjZEQ0JDOTIyMTg3MTFFNjg4QzFEQjRGNDZBQTAzOUEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo2NkRDQkM4RjIxODcxMUU2ODhDMURCNEY0NkFBMDM5QSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo2NkRDQkM5MDIxODcxMUU2ODhDMURCNEY0NkFBMDM5QSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PnurVQYAABi4SURBVHja7F3Jc9tm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';
            }


            $titre_r = $donnees['titre'];

            require './includes/recipes/view_items.inc.php';


            echo '</a>';
        }

        $requete->closeCursor();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    echo "<div class='clearfix'></div>";


}


    /**
     * @param $id
     * @param $id_univers
     */


    private function get_recettes_univers($id, $id_univers)
    {


        $requete = $this->controller->retrieve_all_categories_of_universe($id, $id_univers);

        $i = 0;


        while($donnees = $requete->fetch() ) {

            $requete2 = $this->controller->retrieve_categories_of_universe($donnees['id_categ_univers']);
            $requete3 = $this->controller->retrieve_name_categ_of_universe($donnees['id_categ_univers']);




            if($donnees['id_categ_univers'] == $requete2){
                echo $requete3 . '<br />';
                var_dump($donnees['id'] . $donnees['titre']);

            }

            $i++;



        }

        echo 'Nombre de recettes : ' . $i;

        echo "<div class='clearfix'></div>";


    }

    public function affiche_nom_categorie_recette($id_recette, $accent)
    {
        return $this->controller->affiche_nom_categorie_recette($id_recette,$accent);


    }

// entrées, plats, desserts, etc

    public function get_categ_pub($id)
    {
        echo $this->get_categ($id, 'categorie');
    }

    /**
     * @param $text
     */
    public function univers($text){
        // TODO Faire page Univers

        var_dump($text);

        if (isset($text[0] ) AND $text[0] != '') {

            $id_univ = explode('_', ltrim($text[0], '_'));
            $univers = $id_univ[0];

            $img = $this->controller->get_infos_param('img_univ','univers', $univers);
            $img_position = $this->controller->get_infos_param('img_vertical_position','univers', $univers);

            $nom_univers =  ucfirst($this->controller->get_infos_param('lib_univ','univers', $id_univ[0]));
            $texte_visible = $this->controller->get_infos_param_complet_fetch('SELECT texte_visible FROM univers WHERE id = '.$univers.'');


            // partie affichage :
            require_once './includes/univers.inc.php';


        } else {

        }







    }

    /**
     * @param $id
     */
    public function type($id)
    {

        echo '<div class=\'ui main container segment items\' style="min-height: 100vh">';


        // si le type est défini
        if(isset($id[0])){

            // si il est numérique
            if(is_numeric($id[0])){

                $titre = ucfirst($this->model->affiche_nom_categorie($id[0],1,1));
                echo '<h1>' . htmlspecialchars($titre) . ' : </h1>';

                if ($id[0] != '') {
                    echo $this->get_categ($id[0], 'type');
                }

            }
            else {
                // TODO : finir la liste des types (entrées plats desserts, etc)
                echo 'Entrées, plats, desserts, tout est dispo ici !';
            }
        }
        // si pas de type
        else {
            // TODO : finir la liste des types (entrées plats desserts, etc)
            echo 'Entrées, plats, desserts, tout est dispo ici !';
        }


        echo $this->aside(FALSE,'');

    }




}

    