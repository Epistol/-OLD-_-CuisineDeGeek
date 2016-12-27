<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 24/09/2016
 * Time: 17:46
 */


$univers_id_current = $id_univ[0];





// si aucune image n'est encore associée
if($img == NULL){


    echo '
                    <div class="titre_action"> <span class="nom_univers_single"> '.$nom_univers.'</span></div>
                    </div>
                ';
}
// sinon on affiche l'image
else {
    ?>

    <div class="ui raised very padded text container segment" style="background-size: cover;    background-position-y: <?php echo $img_position; ?>%;
        background-image: url('/img/univers/<?php echo $img; ?>') ">
                    <span class="nom_univers_single">
                        <?php
                        if($texte_visible != 0){
                            echo $nom_univers;
                        }

                        ?>
                    </span>
    </div>
    <?php
}


// on affiche toujours les recettes =>

$all_categ_recettes = $this->controller->get_types_recettes_univers($id_univ[0]);

if($all_categ_recettes != ''){
    echo '<div class="ui main container segment" style="min-height: 100vh">';

    foreach ($all_categ_recettes as $id_categ){
        $id_univers = $this->controller->get_univ_categ($id_categ);

        echo '<div class="ui segment">
                
                <button class="compact ui button">' . $id_univers  .'</button>
                <div class="ui hidden divider"></div>
             <div class="ui cards">   ';



        $recettes = $this->controller->get_query('SELECT * FROM recette WHERE 
                id_univers = '.$univers_id_current.' AND id_categ_univers = '.$id_categ.'');

        $i = 0;

        while ($donnees = $recettes->fetch() AND $i <= 10) {

            if ($donnees['url_img'] != '') {
                // on récupère le fichier thumbnailé ;)
                $afficher = '/img/recette/thumbs/thumb' . $donnees["url_img"];
            } else {
                // defaut img si aucune n'est définie
                // en base64 car c'est + rapide et ça fait kewl.
                $afficher = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWCAIAAACzY+a1AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NjZEQ0JDOTEyMTg3MTFFNjg4QzFEQjRGNDZBQTAzOUEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NjZEQ0JDOTIyMTg3MTFFNjg4QzFEQjRGNDZBQTAzOUEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo2NkRDQkM4RjIxODcxMUU2ODhDMURCNEY0NkFBMDM5QSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo2NkRDQkM5MDIxODcxMUU2ODhDMURCNEY0NkFBMDM5QSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PnurVQYAABi4SURBVHja7F3Jc9tm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';
            }


            echo '<a href="/recettes/view_recipe?id='.$donnees['id'].'">';
            $titre_r = $donnees['titre'];

            $user_pic = $this->controller->get_info_user2('image_util', $donnees['id_utilisateur']);
            $pseudo = $this->controller->get_info_user2('username', $donnees['id_utilisateur']);



            if (strstr($user_pic, 'api.adorable.io') == TRUE) {
                // on affiche le champ tel quel
                $image_a_afficher = htmlspecialchars($user_pic);
                $retour =  ' <amp-img class="ui avatar image" src="'. $image_a_afficher.'">';
            }
            else {
                $image_a_afficher = "/img/utilisateurs/" . $pseudo .'/profil/thumbs/thumb'. $user_pic;
                $retour =  '<amp-img class="ui avatar image" src="'. $image_a_afficher.'">';
            }



            require 'recipes/view_cards.inc.php';

            echo '</a>';

            $i++;
        }



echo '  </div></div>';

    }
}



