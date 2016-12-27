<?php

/**
 * The about page model
 */
class AboutModel
{

    private $message;

    public function __construct()
    {
        $this->message = "Welcome to the of PHP MVC framework official site.";
    }

    public function nowADays()
    {
        return $this->message = "Aujourd'hui, des pates.";
    }
}