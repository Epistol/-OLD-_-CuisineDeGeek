<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 24/09/2016
 * Time: 17:48
 */
?>

<div class="ui doubling stackable grid" id="example1">
    <div class="one wide column"></div>
    <div class="nine wide column">



        <div class="titre_page">
            <table style="width: 100%;
    height: 100%;">
                <tr>
                    <th style="width: 60%;"><p class="nom_recette" ><?= $larecette['titre'] ?></p></th>

                    <!--  affiche la difficultée sous forme d'étoiles -->
                    <th>
                        <div class='difficulty'> <?php echo $this->controller->get_difficulte(); ?></div>
                    </th>
                    <th>
                        <!-- TODO : pb -->
                        <p><a style="color:white" href="/utilisateur/view_account/<?php
                            echo $this->controller->info_createur_recette('id',$page);
                            ?>">Par <span >
                                <?= $this->controller->info_createur_recette('username',$page);
                                ?> </span> le <span ><?php

                                $date_f =  new DateTime($larecette['date_ajout']);
                                $result = $date_f->format('d/m/Y H:i:s');

                                if ($result) {
                                    echo $result;
                                } else { // format failed
                                    echo "Unknown Time";
                                }

                                ?>

                                    </span>


                            </a>
                        </p>
                        <!-- /FIN : pb -->
                    </th>
                </tr>
            </table>


        </div>





        <?php


        // affiche le titre de la recette => $pseudo sert de test si l'utilisateur est enregistré


        //  $pseudo. '<br />';
        $img_recette = $this->controller->get_img($page);

        if($img_recette != ''){
            // on récupère le fichier thumbnailé ;)
            $afficher = '/img/recette/thumbs/thumb' . $img_recette;
            $afficher_grand = '../img/recette/' . $img_recette;
        }
        else {
            // defaut img si aucune n'est définie
            // en base64 car c'est + rapide et ça fait kewl.
            $afficher = '../img/recette/default.png';
            $afficher_grand = '../img/recette/default.png';
        }



        ?>



        <!-- IMG de la recette -->
        <div class="bloc_photo">
            <a href="#" data-featherlight="<?php echo $afficher_grand; ?>">
                <div class='img_recette'  style="
                    background: white url('<?php echo $afficher; ?>') no-repeat center center;background-size: cover;">

                </div>
            </a>
        </div>
        <!-- on affiche le contenant des infos recettes et créateur: -->


        <div class="contenant_info_recette">
            <div class="bloc_commentaire_recette">
                <?php

                if($larecette['commentaire'] == ''){
                    echo '...';
                }
                else {

                    // strip tags to avoid breaking any html
                    $string = strip_tags($larecette['commentaire']);

                    if (strlen($string) > 250) {

                        // truncate string
                        $stringCut = substr($string, 0, 250) . ' ... ';



                        echo '<div id="accordion">
  <h3>'.$stringCut.'</h3>
  <div>
    <p>'.$string.'
    </p>
  </div></div>';


                        ;
                    }
                    else {
                        echo $larecette['commentaire'];
                    }




                }



                ?>
            </div>

        </div>




        <div class="contenant_info_recette topper">

            <?php

            // TODO Mettre en page correctement ce bloc, pas aussi moche.
            // _____________________________ BLOC INFOS TEMPS _____________________


            if ($larecette['tps_prepa'] == 0) {
                echo "<div class='info_recette'><div class='pre_tps'>Temps de préparation</div>

            <i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> Aucun </div>";
            } else {
                echo "<div class='info_recette'><div class='pre_tps'>Temps de préparation</div>
            <div  class='icone'></div> <i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> " . $larecette['tps_prepa']
                    .' min</div>';
            }


            // On affiche le temps de cuisson, msg si tps de cuisson = 0;

            if ($larecette['tps_cuisson'] == 0) {
                echo "<div class='info_recette'><div class='pre_tps'>Temps de cuisson</div>
            <i class=\"fa fa-fire\" aria-hidden=\"true\"></i> Aucun</div>";
            } else {
                echo "<div class='info_recette'><div class='pre_tps'>Temps de cuisson</div>
            <i class=\"fa fa-fire\" aria-hidden=\"true\"></i> " . $larecette['tps_cuisson'] . ' min</div>';
            }


            // On affiche le temps de cuisson, msg si tps de cuisson = 0;

            if ($larecette['tps_repos'] == 0) {
                echo "<div class='info_recette'><div class='pre_tps'>Temps de repos</div>
<i class=\"fa fa-pause\" aria-hidden=\"true\"></i> Aucun</div>";
            } else {
                echo "<div class='info_recette'><div class='pre_tps'>Temps de repos</div>
            <div  class='icone'></div> <i class=\"fa fa-pause\" aria-hidden=\"true\"></i> " . $larecette['tps_repos'] .
                    ' min</div
            >';
            }

            echo "</div>";


            // __________________________ FIN BLOC INFOS TEMPS _______________________


            // get toutes les étapes liée à la recette
            $etapes = $this->controller->get_etapes($page);


            echo "<div class='ui list'>";
            // on affiche le texte des étapes
            if ($etapes == NULL) {
                echo "Problème, nous n'avons pas d'étape correspondant à votre recette :( . </div>";
            } else {
                $i = 0;
                $j = 1;
                foreach ($etapes as $key => $value) {


                    echo " <div class='etape_recette item' style=\"
    padding: 1em;
\">
                        <a class=\"header\">Etape " . $i . " </a>

               <p>" . $value["instructions"] . "</p></div>";
                    $i++;$j++;
                }
                echo '</div>';

            }




            // fin info recette :

           require_once(__DIR__ . '/commentaire.php');

            ?>
            <script>
                $( function() {
                    $("#accordion" ).accordion({
                        collapsible: true,
                        active:false,
                    });
                } );
            </script>

            <script src="/js/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

        </div>


<?php


switch ($larecette['tps_prepa']){
    case $larecette['tps_prepa'] < 60 :
        $resultM = $larecette['tps_prepa'];
        $resultH = '';
        break;
    case $larecette['tps_prepa'] < 120 :
        $resultH = '1H';
        $resultM = $larecette['tps_prepa'] - 60 ;
        break;
    case $larecette['tps_prepa'] > 120 :
        $nb_h = $larecette['tps_prepa'] / 60;
        $resultH = $nb_h.'H';
        $resultM = $larecette['tps_prepa'] - (60 *  $nb_h) ;
        break;
    default :
        $resultH = '';
        $resultM = '';
        return NULL;

}

?>


        <?php
        $temps_total = $larecette['tps_prepa'] + $larecette['tps_cuisson'] + $larecette['tps_repos'];

        switch ($temps_total){
            case $temps_total < 60 :
                $resultMc = $temps_total;
                $resultHc  = '';
                break;
            case $temps_total < 120 :
                $resultHc = '1H';
                $resultMc = $temps_total - 60 ;
                break;
            case $temps_total > 120 :
                $nb_h = round($temps_total / 60);
                $resultHc = $nb_h.'H';
                $resultMc = $temps_total - (60 *  $nb_h) ;
                break;
            default :
                $resultHc = '';
                return NULL;

        }


        $i = 0;



        ?>



        <script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Recipe",
  "name": "<?= htmlspecialchars($larecette['titre']) ?>",
  "author": {
      "@type": "Person",
      "name": "<?= htmlspecialchars($this->controller->info_createur_recette('username',$page));?>"
     },

  "image": "<?= 'http://' . $_SERVER['HTTP_HOST']  . $afficher ?>",
  "description": " <?= htmlspecialchars($larecette['commentaire']) ?> ",
  "datePublished": "<?= htmlspecialchars($larecette['date_ajout'])?>",
  "prepTime": "PT<?=htmlspecialchars($resultH); ?><?=htmlspecialchars($resultM); ?>M",
  "totalTime": "PT<?=htmlspecialchars($resultHc); ?><?=htmlspecialchars($resultMc); ?>M",
  "recipeYield": "<?= htmlspecialchars($larecette['nb_convives']) ?>",
  "recipeIngredient": [
  <?php
            $numItems = count($tmaj);
            $j = 0;
            foreach ($tmaj as $item => $value) {


                if(++$i === $numItems) {
                    echo  '"' . htmlspecialchars($value['lib_ingredient']) .'"' ;
                }
                else {
                    echo  '"' . htmlspecialchars($value['lib_ingredient']) .'",' ;
                }

            }

?>
  ],
  "recipeInstructions": [

  <?php

            $numItems2 = count($etapes);
            $k = 0;
            $cle = 1;


            foreach ($etapes as $key => $value) {

                if(++$k === $numItems2) {
                    echo  '"' . $cle . " " . htmlspecialchars($value['instructions']) .'"' ;
                }
                else {
                    echo  '"' . $cle . " " . htmlspecialchars($value['instructions']) .'",' ;
                }
                $cle++;



            }


?>

 ]
}
</script>





