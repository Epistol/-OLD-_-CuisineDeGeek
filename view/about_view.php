<?php

/**
 * The about page view
 */
class AboutView
{

    private $modelObj;

    private $controller;


    function __construct($controller, $model)
    {
        $this->controller = $controller;

        $this->modelObj = $model;

        print "<div class='col-md-8'> About - ";
    }

    public function now()
    {
        return $this->modelObj->nowADays();
    }

    public function today()
    {
        return $this->controller->current();
    }


}