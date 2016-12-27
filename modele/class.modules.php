<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 08/08/2016
 * Time: 13:31
 */


/**
 * The Modules model
 */
class ModulesModel
{

    private $message;
    private $maco;

    public function __construct($maco2)
    {
        $this->maco = $maco2;
    }

    public function form_contact()
    {
        echo $this->message = " <h1>Contact</h1>";
        include_once './includes/contact.inc.php';
    }

    public function get_page($id){
        try {
            $stmt = $this->maco->prepare("SELECT * FROM pages WHERE id = :id");
            $stmt->execute(array(':id' => $id));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;


        } catch (PDOException $e) {
            return $e->getMessage();

        }


    }



       
        


}