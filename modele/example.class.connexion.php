<?php



class ConnexionModel
{
    private $modecode;
    private $DB_host;
    private $DB_user;
    private $DB_pass;
    private $DB_name;


    /**
     * ConnexionModel constructor.
     * @param $modededev
     */
    public function __construct($modededev){


        $this->modecode = $modededev;

        if ($this->modecode == 'dev') {
            $this->DB_host = "localhost";
            $this->DB_user = "root";
            $this->DB_pass = "";
            $this->DB_name = "cdg";
            if (!defined("URL")){
                define("URL", "http://localhost/");
            }
            define('DB_SERVER', 'localhost');
            define('DB_USER', 'root');
            define('DB_PASSWORD', '');
            define('DB_NAME', 'cdg');



        }
        else {
            $this->DB_host = "";
            $this->DB_user = "";
            $this->DB_pass = "";
            $this->DB_name = "";
            if (!defined("URL")){
                define("URL", "http://cuisinedegeek.com/");
            }
            define('DB_SERVER', '');
            define('DB_USER', '');
            define('DB_PASSWORD', '');
            define('DB_NAME', '');


        }
    }


    /**
     * @return PDO
     */

    public function connex_db(){

        try
        {
            $DB_con = new PDO("mysql:host={$this->DB_host};dbname={$this->DB_name}",$this->DB_user,$this->DB_pass);
            $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $DB_con->exec("SET CHARACTER SET utf8");
            return $DB_con;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }


}