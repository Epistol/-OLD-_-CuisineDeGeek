<?php

/**
 * The home page controller
 */
class IndexController extends UtilisateurController
{
    private $model;

    function __construct($model, $user, $maco)
    {
        $this->model = $model;
        $this->user = $user;
    }






}