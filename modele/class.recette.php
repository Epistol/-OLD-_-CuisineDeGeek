<?php


/**
 * Le modèle d'une recette
 */
class RecetteModel
{

    private $maco;



    /**
     * RecetteModel constructor.
     * @param $maco2
     */

    public function __construct($maco2)
    {
        $this->maco = $maco2;
    }

// permet d'ajouter 1 à chaque visite d'une recette au nombre de visiteur d'une recette
    public function ajout_visiteur($var,$id)
    {
        try {
            $stmt = $this->maco->prepare("UPDATE recette SET nb_vues = nb_vues + $var WHERE id=:id  LIMIT 1");
            $stmt->execute(array(':id' => $id));


        } catch (PDOException $e) {
            return $e->getMessage();

        }
    }



    // utilisé pour générer des caractères aléatoires, 10 par défaut
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /**
     * @param $url
     */
    public function redirect($url)
    {
        header("Location: $url");
    }


    public function get_univers()
    {
        $stmt = $this->maco->prepare("SELECT * FROM categ_univers");
        $stmt->execute();
        $contenu = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($contenu as $content) {
            $retour [] = $content['lib_univ'];

        }

        return $retour;


    }


    public function verify_univers($contenu)
    {
        $stmt = $this->maco->prepare("SELECT * FROM univers WHERE lib_univ = '$contenu' ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // si le champ n'existe pas, on l'ajoute et on retourne l'id
        if($result == FALSE){
            try {

                $stmt = $this->maco->prepare("INSERT INTO univers(`lib_univ`) VALUES ('$contenu')");
                $stmt->execute();
                $lastId = $this->maco->lastInsertId('id');
                return $lastId;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        // sinon on retourne l'id
        else {

            return $result['id'];
        }



    }

    public function verify_univers_by_id($contenu)
    {
        $stmt = $this->maco->prepare("SELECT * FROM univers WHERE id = '$contenu' ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);



            return $result['lib_univ'];




    }

    /**
     * @param $id
     * @return retourne un tableau de * de la requete d'une recette
     */
    public function get_recipe_only($id)
    {
        try {
            $requete = $this->maco->prepare("SELECT * FROM recette 
                    WHERE recette.id = ?
                    
                    ");
            $requete->execute(array($id));
            while ($donnees = $requete->fetch()) {
                return $retourarray = $donnees;
            }
            $requete->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }




    // récupère juste l'image




    // permet d'afficher toutes les étapes d'une recette


    public function ajout($titre, $difficulte, $categorie, $tps_preparation,
                          $tps_cuisson, $tps_repos, $descr, $image, $nb_convive, $categ_univ, $id_univ, $cout, $id_util)
    {

        try {

            $stmt = $this->maco->prepare("INSERT INTO recette(`titre`, `difficulte`, type, `tps_prepa`,
`tps_cuisson`, `tps_repos`, `commentaire`, `url_img`, `nb_convives`, `id_categ_univers`, `id_univers`, `cout`, `id_utilisateur` ) VALUES('$titre', '$difficulte', '$categorie',  '$tps_preparation', 
                                                       '$tps_cuisson', '$tps_repos', '$descr', '$image', '$nb_convive', '$categ_univ', '$id_univ'
                                                        , '$cout', '$id_util') ");
            $stmt->execute();
            $lastId = $this->maco->lastInsertId('id');
            return $lastId;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }


    public function update($id_recette, $titre, $difficulte, $categorie, $tps_preparation,
                          $tps_cuisson, $tps_repos, $descr, $image, $nb_convive, $categ_univ, $id_univ, $cout, $id_util)
    {

        try {

            $stmt = $this->maco->prepare("
            UPDATE `recette` SET `titre` = '$titre',
  `difficulte` = '$difficulte',
  `type` = '$categorie',
  `tps_prepa` = '$tps_preparation',
  `tps_cuisson` = '$tps_cuisson',
  `tps_repos` = '$tps_repos',
  `commentaire` = '$descr',
  `url_img` = '$image',
  `nb_convives` = '$nb_convive',
  `id_categ_univers` = '$categ_univ',
  `id_univers` = '$id_univ',
  `cout` = '$cout'
  
  WHERE `id` = '$id_recette' ");
            $stmt->execute();
            return 'ok';
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

    // fonction en cours

    public function requete($rq)
    {


        try {
            $stmt = $this->maco->prepare($rq);
            $stmt->execute();


            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

    // fonction en cours

    public function ajout_requete($rq, $val)
    {


        try {
            $stmt = $this->maco->prepare($rq . $val);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

    public function makeThumbnails($updir, $img)
    {
        $thumbnail_width = 250;
        $thumbnail_height = 250;
        $thumb_beforeword = "thumb";
        $arr_image_details = getimagesize("$updir" . "$img"); // pass id to thumb name
        $original_width = $arr_image_details[0];
        $original_height = $arr_image_details[1];
        if ($original_width > $original_height) {
            $new_width = $thumbnail_width;
            $new_height = intval($original_height * ($new_width / $original_width));
            if ($new_height < $new_width) {
                $pourcentage = $thumbnail_height / $new_height;
                $new_height = ($new_height * $pourcentage);
                $new_width = ($new_width * $pourcentage);
            }
        } else {
            $new_height = $thumbnail_height;
            $new_width = intval($original_width * ($new_height / $original_height));
            if ($new_width < $new_height) {
                $pourcentage = $thumbnail_width / $new_width;
                $new_height = ($new_height * $pourcentage);
                $new_width = ($new_width * $pourcentage);
            }
        }
        $dest_x = intval(($thumbnail_width - $new_width) / 2);
        $dest_y = intval(($thumbnail_height - $new_height) / 2);
        if ($arr_image_details[2] == 1) {
            $imgt = "ImageGIF";
            $imgcreatefrom = "ImageCreateFromGIF";
        }
        if ($arr_image_details[2] == 2) {
            $imgt = "ImageJPEG";
            $imgcreatefrom = "ImageCreateFromJPEG";
        }
        if ($arr_image_details[2] == 3) {
            $imgt = "ImagePNG";
            $imgcreatefrom = "ImageCreateFromPNG";
        }
        if ($imgt) {
            $old_image = $imgcreatefrom("$updir" . "$img");
            $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
            if($imgt == 'ImagePNG'){
                // integer representation of the color black (rgb: 0,0,0)
                $background = imagecolorallocate($new_image, 0, 0, 0);
                // removing the black from the placeholder
                imagecolortransparent($new_image, $background);

                // turning off alpha blending (to ensure alpha channel information
                // is preserved, rather than removed (blending with the rest of the
                // image in the form of black))
                imagealphablending($new_image, false);

                // turning on alpha channel information saving (to ensure the full range
                // of transparency is preserved)
                imagesavealpha($new_image, true);
            }
            imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
            $imgt($new_image, "$updir" . "/thumbs/" . "$thumb_beforeword" . "$img");
        }
    }


    public function get_ingr($id)
    {


        try {


            $requete = $this->maco->prepare("SELECT * FROM recette_ingredients WHERE id_recette = :value");


            $requete->execute(array(':value' => $id));

            $result = $requete->fetchAll(PDO::FETCH_ASSOC);

            return $result;


            $requete->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function rq_where($rq)
    {


        try {


            $requete = $this->maco->prepare("$rq");


            $requete->execute();

            $result = $requete->fetchAll(PDO::FETCH_ASSOC);

            return $result;


            $requete->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function get_truc($info,$id)
    {


        try {


            $requete = $this->maco->prepare("SELECT $info  FROM recette WHERE id = :value");


            $requete->execute(array(':value' => $id));

            $result = $requete->fetch(PDO::FETCH_BOTH);

            return $result[0];


            $requete->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function get_steps($id)
    {


        try {


            $requete = $this->maco->prepare("SELECT `instructions`  FROM etape_de_recette WHERE id_recette = :value");


            $requete->execute(array(':value' => $id));

            $result = $requete->fetchAll(PDO::FETCH_BOTH);

            foreach ($result as $items){
                $stock[] = $items;
            }

            return $stock;


            $requete->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function get_ingredients($id)
    {


        try {


            $requete = $this->maco->prepare("SELECT *  FROM recette_ingredients WHERE id_recette = :value");


            $requete->execute(array(':value' => $id));

            $result = $requete->fetchAll(PDO::FETCH_BOTH);

            foreach ($result as $items){
                $stock[] = $items;
            }

            return $stock;


            $requete->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function nb_convive($id_recette)
    {
        try {
            $requete = $this->maco->prepare("SELECT nb_convives FROM recette WHERE id= ?
                    
                    ");
            $requete->execute(array($id_recette));
            $result = $requete->fetch(PDO::FETCH_BOTH);


            return $result[0];

            $requete->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

    public function get_info_rq($rq)
    {
        try {
            $requete = $this->maco->prepare("$rq");
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_BOTH);


            return $result[0];

            $requete->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

    /**
     * @param $id_recette
     * @param $accent
     * @return string
     */
    public function affiche_nom_categorie($id_recette, $accent)
    {
        try {
            $requete = $this->maco->prepare("SELECT type FROM recette WHERE id= ?
                    
                    ");
            $requete->execute(array($id_recette));
            $result = $requete->fetch(PDO::FETCH_BOTH);

            if ($accent == 0) {
                switch ($result["type"]) {
                    case 1:
                        return 'entree';
                        break;
                    case 2:
                        return 'plat';
                        break;
                    case 3:
                        return 'dessert';
                        break;
                    case 4 :
                        return 'accompagnement';
                        break;
                    case 5 :
                        return 'amuse-bouche';
                        break;
                    case 6 :
                        return 'bonbon';
                        break;
                    case 7 :
                        return 'sauce';
                        break;
                    case 8 :
                        return 'cocktail';
                        break;
                    default:
                        return '';

                }
            } elseif ($accent == 1) {
                switch ($result["type"]) {
                    case 1:
                        return 'entrée';
                        break;
                    case 2:
                        return 'plat';
                        break;
                    case 3:
                        return 'dessert';
                        break;
                    case 4 :
                        return 'accompagnement';
                        break;
                    case 5 :
                        return 'amuse-bouche';
                        break;
                    case 6 :
                        return 'bonbon';
                        break;
                    case 7 :
                        return 'sauce';
                        break;
                    case 8 :
                        return 'cocktail';
                        break;
                    default:
                        return '';

                }
            }


            $requete->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }


}