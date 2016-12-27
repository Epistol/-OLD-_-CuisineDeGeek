<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 08/08/2016
 * Time: 13:30
 */

/**
 * Modules supplémentaires
 */
class ModulesController
{
    private $model;

    function __construct($model,  $maco)
    {
        $this->model = $model;
        $this->maco = $maco;

    }

    public function verif_mail()
    {
        if(isset($_POST['g-recaptcha-response']) AND $_POST['g-recaptcha-response'] != ''){
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);
            $formcontent="De: $name \n Message: $message";
            $recipient = "contact@cuisinedegeek.com";
            $subject = "Formulaire de Contact - CDG";
            $mailheader = "From: $email \r\n";
            mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
            return 1;
        }
        else {
            return NULL;
        }



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
