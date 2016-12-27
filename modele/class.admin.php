<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 03/07/2016
 * Time: 03:25
 */

/**
 * The home page model
 */
class AdminModel
{

    private $message = 'Bienvenue sur Cuisine De Geek.com';
    private $maco;

    /**
     * AdminModel constructor.
     * @param $maco2
     */
    function __construct($maco2)
    {
        $this->maco = $maco2;
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



    /**
     * @return string
     */
    public function welcomeMessage()
    {
        return $this->message;
    }

    /**
     * @param $url
     */
    public function redirect($url)
    {
        header("Location: $url");
    }

    public function get_recettebyid($param, $casdefigure)
    {
        try {
            if ($casdefigure == 'delete') {
                $requete = "DELETE FROM `recette` WHERE id = $param";
                $st = $this->maco->prepare($requete);
                $this->maco->exec($requete);
                return TRUE;
                $st->closeCursor();
            } else if ($casdefigure == 'update') {
                $requete = $this->maco->prepare("SELECT * FROM `recette` WHERE id = $param");
                $requete->execute();
                $retour = $requete->fetchAll();
                return $retour;
                $requete->closeCursor();
            }


        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $nombre_user
     * @return mixed
     */
    public function get_users($nombre_user)
    {
        if ($nombre_user == 'all') {
            try {
                $requete = $this->maco->prepare("SELECT id,username,email,google_id,prenom,nom,date_enregistrement,activation,role,image_util FROM users ");
                $requete->execute();
                $retour = $requete->fetchAll();
                return $retour;
                $requete->closeCursor();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


    /**
     * @param $nombre_user
     * @return mixed
     */
    public function get_recettes()
    {
        try {
            $requete = "SELECT * FROM recette";
            return $this->maco->query($requete);
            $requete->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function get_users_nofetch($nombre_user)
    {
        if ($nombre_user == 'all') {
            try {
                $requete = "SELECT id,username,email,google_id,prenom,nom,date_enregistrement,activation,role,image_util FROM users ORDER BY id DESC ";
                return $this->maco->query($requete);
                $requete->closeCursor();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    /** affiche le pseudo
     * @return mixed
     */
    public function get_pseudo()
    {
        $user_id = $_SESSION['user_session'];
        $stmt = $this->maco->prepare("SELECT * FROM users WHERE id=:user_id");
        $stmt->execute(array(":user_id" => $user_id));
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userRow['username'];
    }


}