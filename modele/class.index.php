<?php

/**
 * The home page model
 */
class IndexModel
{

    private $message = '<span class="cdg_intro">Cuisine De Geek</span><br />';
    private $infos = '<div class="headline">Bienvenue sur CDG !<br />
Vous êtes sur un site de cuisine qui met à votre disposition des recettes tirés
 d\'univers différents : <br />films, séries, jeux, animes, mangas, etc ... </div>';


    function __construct()
    {

    }

    function index(){
        require_once './includes/index.inc.php';
    }






}