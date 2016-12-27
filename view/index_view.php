<?php

/**
 * The home page view
 */
class IndexView
{

    private $model;

    private $controller;


    function __construct($controller, $model)
    {
        $this->controller = $controller;

        $this->model = $model;



    }


    private function helpWanted(){
        return '<div class="ui segment" style="margin-bottom: 1rem"><a href="/modules/contact" style="color:#857fe1"><h1>Help Wanted</h1>
'. $this->msgFR() . ' ' . $this->msgEN() . '</div>';
    }

    private function msgFR(){
        return 'Nous recherchons activement :  <ul style="    list-style-type: none;"><li class="large_help webdesign">Webdesigner</li>
<li class="large_help ux_help">UX designer</li></ul></a>';
    }

    private function msgEN(){

    }

    public function index()
    {
        return  $this->model->index() .  $this->helpWanted() . "</div></div>";


    }

    public function action()
    {
        return $this->controller->takeAction();
    }

}