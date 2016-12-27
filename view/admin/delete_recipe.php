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
?>


<?php


// on charge le modele en passant le mode en paramètre ('dev' ou 'prod')
$connex = new ConnexionModel('dev');
// connexion a la bdd
$maco = $connex->connex_db();




if (isset($_GET['term'])){

    $tableau_termes = $_GET['term'];
    // permet d'exploser l'url
    if (isset($tableau_termes)) {
        $tab = explode(',', ltrim($tableau_termes, ','));
    } else {
        $tab = ',';
    }


    foreach ($tab as $item) {

    $return_arr = array();

    try {
        $conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT titre FROM recette WHERE id = :term ' );
        $stmt->execute(array('term' => $item));
        while($row = $stmt->fetch()) {
            $return_arr[] =  $row[0];
        }
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);


    }



}

