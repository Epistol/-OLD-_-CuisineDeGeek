<?php

/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 05/12/2016
 * Time: 08:37
 */
class Participant extends Session
{



    private $nom;
    private $prenom;
    private $anciennete;
    private $session;
    private $lesChoix = array();



    public function init($unNom, $unPrenom, $uneanciennete, Session $deschoix, Session $lesChoix)
    {
        $this->lesChoix[] = $lesChoix;
        $this->deschoix = $deschoix;
        $this->uneanciennete = $uneanciennete;
        $this->unPrenom = $unPrenom;
        $this->unNom = $unNom;

    }

    public function getChoixSession($index){
        return $this->lesChoix[$index];
    }



}