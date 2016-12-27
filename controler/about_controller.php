<?php

/**
 * The about page controller
 */
class AboutController
{
    private $modelObj;

    function __construct( $model, $user )
    {
        $this->modelObj = $model;

    }

    public function current()
    {
        return $this->modelObj->message = "About us today changed by aboutController.";
    }
}