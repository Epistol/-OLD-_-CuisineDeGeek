<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 03/07/2016
 * Time: 03:25
 */
// TODO : la partie adminsitration à revoir

/**
 * The about page controller
 */
class AdminController extends UtilisateurController
{
    private $modelObj;
    private $db;

    function __construct($model, $maco)
    {
        $this->modelObj = $model;
        $this->db = $maco;


    }

    public function current()
    {
        return $this->modelObj->message = "About us today changed by aboutController.";
    }


    public function get_info_current_user2($info)
    {
        $user_id = $_SESSION['user_session'];
        $stmt = $this->db->prepare("SELECT $info FROM users WHERE id= $user_id");
        $stmt->execute();
        $userRow = $stmt->fetch(PDO::FETCH_BOTH);
        return $userRow[0];
    }


    public function get_max_pages()
    {
        $query = "SELECT COUNT(*)  FROM users";
        $get = $this->db->query($query);
        $donnees = $get->fetch();
        $total = $donnees[0] / 50;
        $arrondi = ceil($total);
        return $arrondi;
    }

    public function get_page($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pages WHERE id = :id");
            $stmt->execute(array(':id' => $id));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;


        } catch (PDOException $e) {
            return $e->getMessage();

        }


    }

    public function get_pages()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pages");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;


        } catch (PDOException $e) {
            return $e->getMessage();

        }


    }

    public function edit_page($id)
    {


        $contenu = htmlspecialchars($_POST['contenu']);
        $titre = htmlspecialchars($_POST['titre']);


        try {
            $stmt = $this->db->prepare("UPDATE  `pages` SET  `name` = :titre,  `contenu` = :contenu WHERE  `id`=$id  LIMIT 1");
            $stmt->bindParam(":titre", $titre);
            $stmt->bindParam(":contenu", $contenu);
            $get = $stmt->execute();

            return TRUE;
        } catch (PDOException $e) {
            return $e->getMessage();

        }
    }

    public function ajout()
    {


        $contenu = htmlspecialchars($_POST['contenu']);
        $titre = htmlspecialchars($_POST['titre']);

        $slug = strtolower(htmlspecialchars($titre));

        try {

            $stmt = $this->db->prepare("INSERT INTO pages (`name`,`slug`, `contenu` ) VALUES('$titre','$slug','$contenu')");

            var_dump($stmt);

            $get = $stmt->execute();


            return TRUE;
        } catch (PDOException $e) {
            return $e->getMessage();

        }
    }


}