<?php

/**
 * Created by PhpStorm.
 * User: mlebeau
 * Date: 12/05/2016
 * Time: 10:42
 */
class RecettesModel
{



	private $maco;

	private $id;
	private $titre;
	private $difficulte;
	private $categorie;
	private $tps_prepa;
	private $tps_cuisson;
	private $tps_repos;
	private $temperature;
	private $commentaire;
	private $etapes;
	private $ingredients;



	function __construct($maco2)
	{
		$this->maco = $maco2;


	}

    /**
     * @param $url
     */
    public function redirect($url)
    {
        header("Location: $url");
    }

	function liste_recette(){
		return $this->maco->query("SELECT * FROM recette");
	}

    function liste_recette_limit($limit,$debut){
        $query = "SELECT *  FROM recette ORDER BY ID DESC LIMIT $limit OFFSET $debut  ";
        return $this->maco->query($query);
    }

	public function get_recipe($idrecette){
		try
		{
			$requete = $this->maco->prepare("SELECT * FROM recette 
	                WHERE id = ?
	                
	                ");
			$requete->execute(array($idrecette));
			while ($donnees = $requete->fetch())
			{
				return $retourarray = array('titre' => $donnees['titre'], 'categ' =>$donnees['categorie']);
			}
			$requete->closeCursor();
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function get_all_pictures(){
        try
        {
            $requete = $this->maco->prepare("SELECT id, lib_univ from categ_univers ");
            $requete->execute();

            while ($donnees = $requete->fetch())
            {

                    $position = -32 + (32 * $donnees['id']);

                echo "<a href='/recettes/categorie/".$donnees['id']."'> <div class='bloc_pict'><div class='opt_bg' style='background-position:0 -" . $position . "px' ></div><div class='titre_label'>"
                    .$donnees['lib_univ']."</div></div></a>";

            }
            $requete->closeCursor();


        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }


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



    /**
     * @param $id
     * @return mixed
     */

    public function get_etapes($id)
    {


        try {


            $requete = $this->maco->prepare("SELECT *  FROM etape_de_recette WHERE id_recette = :value");


            $requete->execute(array(':value' => $id));

            $result = $requete->fetchAll();

            return $result;


            $requete->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function affiche_nom_categorie($id, $accent, $pluriel)
    {


            if ($accent == 0 && $pluriel == 0) {
                switch ($id) {
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
            } elseif ($accent == 1 && $pluriel == 0) {
                switch ($id) {
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
            elseif ($accent == 1 && $pluriel == 1) {
                switch ($id) {
                    case 1:
                        return 'entrées';
                        break;
                    case 2:
                        return 'plats';
                        break;
                    case 3:
                        return 'desserts';
                        break;
                    case 4 :
                        return 'accompagnements';
                        break;
                    case 5 :
                        return 'amuse-bouches';
                        break;
                    case 6 :
                        return 'bonbons';
                        break;
                    case 7 :
                        return 'sauces';
                        break;
                    case 8 :
                        return 'cocktails';
                        break;
                    default:
                        return '';

                }
            }

            elseif ($accent == 0 && $pluriel == 1) {
            switch ($id) {
                case 1:
                    return 'entrees';
                    break;
                case 2:
                    return 'plats';
                    break;
                case 3:
                    return 'desserts';
                    break;
                case 4 :
                    return 'accompagnements';
                    break;
                case 5 :
                    return 'amuse-bouches';
                    break;
                case 6 :
                    return 'bonbons';
                    break;
                case 7 :
                    return 'sauces';
                    break;
                case 8 :
                    return 'cocktails';
                    break;
                default:
                    return '';

            }
        }





    }


    /**
     * @param $id_recette
     * @param $accent
     * @return string
     */
    public function affiche_nom_categorie_recette($id_recette, $accent)
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

    private function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    public function random_color() {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
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

    public function  get_recipes_by_categorie($where){
        return  $this->maco->query("SELECT id, titre,type,url_img,id_categ_univers,id_univers,timestp,nb_vues FROM recette $where");

    }






}