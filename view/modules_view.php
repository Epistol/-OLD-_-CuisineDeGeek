<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 08/08/2016
 * Time: 13:31
 */

/**
 * The Modules page view
 */
class ModulesView
{

    private $modelObj;

    private $controller;


    function __construct($controller, $model)
    {
        $this->controller = $controller;

        $this->modelObj = $model;

        print "<div class='ui main container segment' style='min-height: 100vh;'>";
    }


    public function mail(){




        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $verification =  $this->controller->verif_mail();


            if($verification == 1){
                echo "<div class='ui ignored success message'>Votre message à bien été envoyé !</div>";
            }
            else {
                echo "<div class='ui ignored error message'>N'oubliez pas le Captcha !</div> ";
                return $this->modelObj->form_contact();
            }
        }
        else {
            return $this->modelObj->form_contact();
        }

    }

    public function today()
    {
        return $this->controller->current();
    }

    public function page($id)
    {


        if(isset($id) AND $id != ''){
            $page = $this->modelObj->get_page($id[0]);


            echo '<h1 style="text-align: center">'.htmlspecialchars($page['name']).'</h1>';

            // $string = htmlspecialchars($page['contenu']);
            $string = html_entity_decode($page['contenu']);



            echo '<p>'.$string.'</p>';





        }
    }



    public function about(){
        return $this->page('2');
    }


    public function faq(){
        return $this->page('3');
    }

    public function cgu()
    {
        return $this->page('1');
    }





    }

