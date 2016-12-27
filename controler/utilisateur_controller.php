<?php

/**
 * The about page controller
 */
class UtilisateurController
{
    private $modelObj;
    private $message;
    private $db;


    function __construct($model, $maco)
    {
        $this->modelObj = $model;
        $this->db = $maco;


    }

    public function index()
    {
        return $this->modelObj->register();
    }

    public function redirect($url){
        header("Location: $url");
    }

    public function conn()
    {
        return $this->db;
    }

    function selog()
    {
        if ($this->modelObj->is_loggedin() != '') {
            echo 'yay';
        } else {
            echo "ow.";
        }

    }

    public function get_info_current_user($info)
    {
        $user_id = $_SESSION['user_session'];
        $stmt = $this->db->prepare("SELECT $info FROM users WHERE id= $user_id");
        $stmt->execute();
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userRow[0];
    }

    public function get_info_user($info, $id)
    {

        $stmt = $this->db->prepare("SELECT $info FROM users WHERE id=$id");
        $stmt->execute();
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userRow[$info];
    }

    public function update_photo($photo){

        try {
            $stmt = $this->db->prepare("UPDATE users SET image_util = :photo WHERE id=:id  LIMIT 1");
            $stmt->execute(array(':id' => $_SESSION['user_session'], ':photo' => $photo));

            return TRUE;
        } catch (PDOException $e) {
            return $e->getMessage();

        }
    }


    public function is_loggedin()
    {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }
    public function current()
    {
        $this->message = "About us today changed by aboutController.";
        return $this->message ;
    }

    public function register($uname, $umail, $upass)
    {
        // LOGIN PART

        return $this->modelObj->register($uname, $umail, $upass);

    }

    public function get_img_util()
    {
        return $this->modelObj->get_img();
    }


}
