<?php

class RecetteController extends UtilisateurController
{

    private $model;
    private $larecette;

    function __construct($model,  $maco)
    {
        $this->model = $model;
        $this->maco = $maco;

    }

    public function sayWelcome()
    {
        return $this->model->welcomeMessage();
    }




    public function get_recette($id_recette)
    {
        $this->larecette = $this->model->get_recipe_only($id_recette);
        return $this->larecette;
    }
    public function info_createur_recette($info, $id_recette)
    {
        $id_util = $this->model->get_recipe_only($id_recette);
        $id = $id_util['id_utilisateur'];

        $infos = $this->get_info_user($info,$id);


        return $infos;
    }



    public function get_difficulte()
    {

        $diff = $this->larecette['difficulte'];

        for ($i = 0; $i < $diff; $i++) {

            echo '<i class="material-icons">star</i> ';


        }
        for ($etoile_gris = 3; $etoile_gris > $i; $etoile_gris--) {
            echo '<i class="material-icons">star_border</i>';
        }


    }


    // fonction qui affiche le nom de la catégorie, qui prend en paramètre l'id de la recette choisie et $accent = 0 si
    // pas d'accent, sinon on en met

    /**
     * @param $id_recette
     * @return mixed
     */

    public function get_img($id_recette)
    {
        try {
            $requete = $this->maco->prepare("SELECT url_img FROM recette WHERE id= ?
                    
                    ");
            $requete->execute(array($id_recette));
            $result = $requete->fetch(PDO::FETCH_BOTH);

            $requete->closeCursor();
            return $result[0];


        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

    public function valider_ajout(){


        $capt = addslashes(htmlspecialchars($_POST['g-recaptcha-response']));

        // si le titre est vide
        if (!isset($_POST['nom_recette']) OR $_POST['nom_recette'] == '') {
            $_SESSION['msg'] = 'Vous avez oublié d\'ajouter un nom à votre recette';
            $_SESSION['color'] = 'warning';
            header('Location: ajouter');
        } // si le champ d'instruction 1 est vide (un minimum requis)
        else if (!isset($_POST['etape_1']) OR $_POST['etape_1'] == '') {
            $_SESSION['msg'] = 'Il faut au minimum une étape';
            $_SESSION['color'] = 'warning';
            header('Location: ajouter');
        }



        // si on a un titre et une étape (pas forcément d'ingrédient ...)
        if (!isset($capt) OR $capt == '') {
            $_SESSION['msg'] = 'Le captcha est incorrect';
            $_SESSION['color'] = 'warning';
            header('Location: ajouter');
        } // si le champ d'instruction 1 est vide (un minimum requis)
        else {


            /* !!! FUCK ça MARCHE // ça loop dans les post et ça ressort une variable pour chaque entrée
            foreach ($_POST as $key => &$item) {
                $item = htmlspecialchars($_POST[$key]);
                echo $key . ' = ' . $item . '<br />';
            }
            */

            $titre = addslashes(htmlspecialchars($_POST['nom_recette']));
            // nl2br : ajoute les retour à la ligne en <br> dans la bdd
            $descr = addslashes(nl2br(htmlspecialchars($_POST['descr'])));
            $categorie = addslashes(htmlspecialchars($_POST['categorie_r']));
            $difficulte = addslashes(htmlspecialchars($_POST['difficulte']));
            $nb_convive = addslashes(htmlspecialchars($_POST['nb_convive']));
            $categ_univ = addslashes(htmlspecialchars($_POST['categ_univers']));
            $cout = addslashes(htmlspecialchars($_POST['cost']));


            $origine_lib = addslashes(htmlspecialchars($_POST['origine']));
            $id_univ_array = $this->model->verify_univers($origine_lib);


            $id_univ = $id_univ_array;






            $tps_preparation_h = addslashes(htmlspecialchars($_POST['tps_preparation-h']));
            $tps_preparation_m = addslashes(htmlspecialchars($_POST['tps_preparation-h']));
            $tps_preparation = ($tps_preparation_h * 60) + $tps_preparation_m;

            $tps_cuisson_h = addslashes(htmlspecialchars($_POST['tps_cuisson-h']));
            $tps_cuisson_m = addslashes(htmlspecialchars($_POST['tps_cuisson-m']));
            $tps_cuisson = ($tps_cuisson_h * 60) + $tps_cuisson_m;

            $tps_repos_h = addslashes(htmlspecialchars($_POST['tps_repos-h']));
            $tps_repos_m = addslashes(htmlspecialchars($_POST['tps_repos-m']));
            $tps_repos = ($tps_repos_h * 60) + $tps_repos_m;


            $id_util = $_SESSION['user_session'];



            // ______________
            // AJOUT D'IMAGE
            // ______________

            $imgFile = $_FILES['photo']['name'];
            $file_name = preg_replace("/[^a-zA-Z0-9.]/", "", $imgFile);
            $var = preg_replace('/\s+/', '_', $file_name);
            $tmp_dir = $_FILES['photo']['tmp_name'];
            $imgSize = $_FILES['photo']['size'];
            $imageFileType = $_FILES['photo']['type'];




            // si l'image possède un nom sans espace
            if ($_FILES['photo']['error'] <= 0) {
                if ($var != '') {
                    $uploads_dir = './img/recette';
                    $nom_photo_avec_random = rand(100, 999999) . $var;
                    $img_profil = $nom_photo_avec_random;


                    $accepted = array(
                        'image/jpeg' => 'jpg',
                        'image/png' => 'png',
                        'image/bmp' => 'bmp',
                    );
                    $file = $_FILES['photo'];
                    $maxSize = 20 * 1024 * 1024; // 20 MB

                    // check if any upload error occured
                    if (UPLOAD_ERR_OK !== $file['error']) {

                        // http://php.net/manual/en/features.file-upload.errors.php
                        echo 'Erreur d\'upload: ', $file['error'], '<br/>';

                        // check if file size is bigger than $maxSize
                    } elseif ($imgSize > $maxSize) {
                        // if filesize is bigger than upload_max_filesize directive in php.ini
                        // script may timeout without any error
                        // post_max_size and upload_max_filesize need to be high enough
                        echo 'Erreur ! Image trop lourde<br/>';

                        // can proceed further
                    } else {

                        // you will need to have the fileinfo enabled in php ini to use these
                        $finfo = finfo_open(FILEINFO_MIME);
                        $mime = finfo_file($finfo, $tmp_dir);
                        // finfo may give you charset info as well
                        // text/plain; charset=utf-8 or image/jpeg; charset=binary
                        $mime = array_shift(explode(';', $mime));
                        // change uploaded file name do to security reasons
                        // google "php null char upload"
                        // nice read http://resources.infosecinstitute.com/null-byte-injection-php/
                        $filename = md5(time() . $imgFile) . '.';
                        // if mime is accepted
                        if (!array_key_exists($mime, $accepted) OR ! isset( $accepted[ $mime ] ) ) {

                            echo 'Erreur ! Type non supporté (jpg, png ou bmp uniquement)<br/>';
                            $uploadOk = 0;
                            // si l'upload est bien ok

                            // you could check if file is image and check min-max width & height
                            // for now move the uploaded file
                        } else {
                            $uploadOk = 1;
                            if ($uploadOk != 0) {
                                move_uploaded_file($tmp_dir, "$uploads_dir/$nom_photo_avec_random");
                                $this->model->makeThumbnails('./img/recette/', $nom_photo_avec_random);


                            }
                        }



                    }


                } // si pas d'image uploadée = var = vide



            }
            else {
                $image = 'default.png';
                $nom_photo_avec_random = $image;
            }



            $save = $this->model->ajout($titre, $difficulte, $categorie, $tps_preparation,
                $tps_cuisson, $tps_repos, $descr, $nom_photo_avec_random, $nb_convive, $categ_univ,$id_univ, $cout,
                $id_util
            );





            foreach ($_POST as $item => $value) {
                $get_id = explode('_', $item);

                if ($get_id[0] == 'etape') {

                    $this->id_step = $get_id[1];
                    $val = addslashes($value);


                    if($val != ''){
                        $rq = " INSERT INTO `etape_de_recette` (`id_recette`, `numero_etape`, `instructions`) ";
                        $valeurs = "VALUES ( '$save', '$this->id_step','$val') ";
                        $result = $this->model->ajout_requete($rq, $valeurs);
                    }

                }
                if ($get_id[0] == 'ingred' OR $get_id[0] == 'qtt') {

                    if($get_id[0] == 'ingred'){
                        $this->ingre = $value;
                        $id_step_ingredient = $get_id[1];
                        $this->stp_ing = $id_step_ingredient;

                    }



                    $rq2 = " INSERT INTO `recette_ingredients` (`id_recette`, `lib_ingredient`)";
                    $valeurs2 = "VALUES ( '$save', '$this->ingre') ";

                    if(isset($this->ingre) AND $this->ingre != ''){
                        $this->model->ajout_requete($rq2, $valeurs2);
                    }





                }





            }
        }

        return $save;
    }
    public function valider_mod()
    {
        $capt = addslashes(htmlspecialchars($_POST['g-recaptcha-response']));

        // si le titre est vide
        if (!isset($_POST['nom_recette']) OR $_POST['nom_recette'] == '') {
            $_SESSION['msg'] = 'Vous avez oublié d\'ajouter un nom à votre recette';
            $_SESSION['color'] = 'bgorange';
            header('Location: ajouter');
        } // si le champ d'instruction 1 est vide (un minimum requis)
        else if (!isset($_POST['etape_1']) OR $_POST['etape_1'] == '') {
            $_SESSION['msg'] = 'Il faut au minimum une étape';
            $_SESSION['color'] = 'bgorange';
            header('Location: ajouter');
        } // si on a un titre et une étape (pas forcément d'ingrédient ...)
        if (!isset($capt) OR $capt == '') {
            $_SESSION['msg'] = 'Le captcha est incorrect';
            $_SESSION['color'] = 'bgorange';
            header('Location: ajouter');
        } // si le champ d'instruction 1 est vide (un minimum requis)
        else {


            /* !!! FUCK ça MARCHE // ça loop dans les post et ça ressort une variable pour chaque entrée
            foreach ($_POST as $key => &$item) {
                $item = htmlspecialchars($_POST[$key]);
                echo $key . ' = ' . $item . '<br />';
            }
            */

            $titre = addslashes(htmlspecialchars($_POST['nom_recette']));
            // nl2br : ajoute les retour à la ligne en <br> dans la bdd
            $descr = addslashes(nl2br(htmlspecialchars($_POST['descr'])));
            $categorie = addslashes(htmlspecialchars($_POST['categorie_r']));
            $difficulte = addslashes(htmlspecialchars($_POST['difficulte']));
            $nb_convive = addslashes(htmlspecialchars($_POST['nb_convive']));
            $categ_univ = addslashes(htmlspecialchars($_POST['categ_univers']));
            $cout = addslashes(htmlspecialchars($_POST['cost']));


            $origine_lib = addslashes(htmlspecialchars($_POST['origine']));
            $id_univ_base = $this->model->verify_univers($origine_lib);


            $id_univ = $id_univ_base['id'];



            $tps_preparation_h = addslashes(htmlspecialchars($_POST['tps_preparation-h']));
            $tps_preparation_m = addslashes(htmlspecialchars($_POST['tps_preparation-h']));
            $tps_preparation = ($tps_preparation_h * 60) + $tps_preparation_m;

            $tps_cuisson_h = addslashes(htmlspecialchars($_POST['tps_cuisson-h']));
            $tps_cuisson_m = addslashes(htmlspecialchars($_POST['tps_cuisson-m']));
            $tps_cuisson = ($tps_cuisson_h * 60) + $tps_cuisson_m;

            $tps_repos_h = addslashes(htmlspecialchars($_POST['tps_repos-h']));
            $tps_repos_m = addslashes(htmlspecialchars($_POST['tps_repos-m']));
            $tps_repos = ($tps_repos_h * 60) + $tps_repos_m;

            $imgFile = $_FILES['photo']['name'];
            $var = preg_replace('/\s+/', '_', $imgFile);
            $tmp_dir = $_FILES['photo']['tmp_name'];
            $imgSize = $_FILES['photo']['size'];
            $imageFileType = $_FILES['photo']['type'];

            $id_util = $_SESSION['user_session'];



            // si l'image possède un nom autorisé
            if ($var != '') {

                $uploads_dir = './img/recette';
                $nom_photo_avec_random = rand(100, 999999) . $var;


                $accepted = array(
                    'image/jpeg'     => 'jpg',
                    'image/png'      => 'png',
                    'image/bmp' => 'bmp',
                );
                $file      = $_FILES['photo'];
                $maxSize   = 20 * 1024 * 1024 ; // 20 MB

                // check if any upload error occured
                if( UPLOAD_ERR_OK !== $file['error'] ){

                    // http://php.net/manual/en/features.file-upload.errors.php
                    echo 'Erreur d\'upload: ', $file['error'], '<br/>';

                    // check if file size is bigger than $maxSize
                } elseif( $imgSize > $maxSize ){
                    // if filesize is bigger than upload_max_filesize directive in php.ini
                    // script may timeout without any error
                    // post_max_size and upload_max_filesize need to be high enough
                    echo 'Erreur ! Image trop lourde<br/>';

                    // can proceed further
                } else {

                    // you will need to have the fileinfo enabled in php ini to use these
                    $finfo    = finfo_open( FILEINFO_MIME );
                    $mime     = finfo_file( $finfo, $tmp_dir );
                    // finfo may give you charset info as well
                    // text/plain; charset=utf-8 or image/jpeg; charset=binary
                    $mime     = array_shift( explode( ';', $mime ) );
                    // change uploaded file name do to security reasons
                    // google "php null char upload"
                    // nice read http://resources.infosecinstitute.com/null-byte-injection-php/
                    $filename = md5( time() . $imgFile ) . '.';
                    // if mime is accepted
                    if( ! array_key_exists( $mime, $accepted ) /* or use isset: ! isset( $accepted[ $mime ] ) */ ){

                        echo 'Erreur ! Type non supporté (jpg, png ou bmp uniquement)<br/>';
                        $uploadOk = 0;

                        // you could check if file is image and check min-max width & height
                        // for now move the uploaded file
                    }
                    else {
                        $uploadOk = 1;
                    }
                }





            }

            // si pas d'image uploadée = var = vide
            else {
                $nom_photo_avec_random = $this->model->get_truc('url_img',$id_recette);
            }

            // si l'upload est bien ok
            if (isset($uploadOk) AND $uploadOk != 0) {
                move_uploaded_file($tmp_dir, "$uploads_dir/$nom_photo_avec_random");
                $this->model->makeThumbnails('./img/recette/', $nom_photo_avec_random);
            }
            else {

            }


            $this->model->update($id_recette, $titre, $difficulte, $categorie, $tps_preparation,
                $tps_cuisson, $tps_repos, $descr, $nom_photo_avec_random, $nb_convive, $categ_univ,$id_univ, $cout,
                $id_util
            );

            $var = 0;

            // Pour chaque post
            foreach ($_POST as $item => $value) {
                $get_id = explode('_', $item);
                // si le post est un "etape"
                if ($get_id[0] == 'etape') {

                    $this->id_step = $get_id[1];
                    $val = addslashes($value);


                    $get_if_nume_etape = 'SELECT id FROM etape_de_recette WHERE id_recette = '.$id_recette.' AND numero_etape = '.$this->id_step;



                    echo '<br />';
                    $resultat2 = $this->model->requete($get_if_nume_etape);

                    $fouetch = $resultat2->fetch(PDO::FETCH_ASSOC);

                    var_dump($fouetch);

                    if (!empty($val)) {
                        if($fouetch != FALSE){

                            $rq = " UPDATE `etape_de_recette` SET `numero_etape` = '$this->id_step', `instructions` = '$val' WHERE `id_recette` = '$id_recette' AND `numero_etape` = '$this->id_step'";

                        }
                        else {
                            $rq2 = " INSERT INTO `etape_de_recette` (`id_recette`, `numero_etape`, `instructions`) ";
                            $valeurs = "VALUES ( '$id_recette', '$this->id_step','$val') ";
                            $rq = $rq2 . $valeurs;
                        }
                        $result = $this->model->requete($rq);
                    }

                }



                elseif ($get_id[0] == 'ingred' OR $get_id[0] == 'qtt') {

                    $ingre_get = $get_id[1];


                    if($get_id[0] == 'ingred'){
                        $this->ingre = $value;
                    }

                    if($get_id[0] == 'qtt'){
                        $this->qtt = $value;
                    }


                    $rq = " UPDATE `recette_ingredients` SET `lib_ingredient` = '$this->ingre' WHERE `id_recette` = '$id_recette' AND `id_ingredient` = '$ingre_get' ";

                    $rq2 = " SELECT * FROM recette_ingredients WHERE id_ingredient = '$ingre_get' AND `id_recette` = '$id_recette' ";


                    if(isset($this->ingre) AND $this->ingre != ''){
                        $result2 = $this->model->rq_where($rq2);

                        echo '<pre>';
                        var_dump($result2[0]);
                        echo '</pre>';

                        if($result2[0]['id_ingredient'] == $ingre_get){
                            $result = $this->model->requete($rq);
                        }

                        // TODO : corriger le bug des recettes
                        else {

                            $rq2 = " INSERT INTO `recette_ingredients` (`id_recette`, `lib_ingredient`, `quantite`, `id_ingredient`)";
                            $valeurs2 = "VALUES ( '$id_recette', '$this->ingre', '$this->qtt', '$ingre_get') ";

                            if(isset($this->ingre) AND $this->ingre != ''){
                                $this->model->ajout_requete($rq2, $valeurs2);
                            }


                        }


                    }
                    $var++;


                }



            }
        }
    }


}