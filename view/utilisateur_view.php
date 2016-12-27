<?php

/**
 * The about page view
 */
class UtilisateurView
{

    private $modelObj;
    private $controller;


    function __construct($controller, $model)
    {
        $this->controller = $controller;
        $this->modelObj = $model;


    }

// on redirige toujours sur la vérification du login
    public function index()
    {
        return $this->login('');
    }

    /** Login utilisateur
     * @param $value
     */
    public function login($value)
    {


        // si le formulaire est envoyé, on lance la verification
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $redirect = NULL;

            if ($_POST['location'] != '') {
                $redirect = $_POST['location'];
            } else {
                $redirect = '/utilisateur/compte';
            }

            $uname = $_POST['txt_uname_email'];
            $umail = $_POST['txt_uname_email'];
            $upass = $_POST['txt_password'];

            $valeur = $this->modelObj->login($uname, $umail, $upass);
            if ($valeur != FALSE) {
                $this->modelObj->ajout_session($valeur);
                $_SESSION['user_session'] = htmlspecialchars($valeur);


                $this->controller->redirect($redirect);

            } else {
                $_SESSION['msg'] = "Pseudo ou mot de passe incorrect";
                $_SESSION['color'] = 'bgred';
                $this->controller->redirect('/utilisateur/login');
            }


        } // si le formulaire n'est pas encore envoyé
        else {
            // formulaire


            if (isset($value)) {
                $url2 = explode('?', ltrim($value, '?'));
            } else {
                $url2 = '/';
            }

            if (isset($url2)) {
                $url3 = explode('=', ltrim($url2[0], '='));
            } else {
                $url3 = '/';
            }


            // LOGIN PART
            if ($this->modelObj->is_loggedin() != "") {
                // si déjà loggué
                $this->controller->redirect('/utilisateur/compte');
            }
        }

        require_once('./includes/login.inc.php');


    }


// ENREGISTREMENT UTILISATEUR
    public function register()
    {

        $img_profil = NULL;
        // FORMULAIRE
        require_once('./includes/register.inc.php');
        // SI ON A CLIQUE SUR LE BOUTON S'ENREGISTRER
        if (isset($_POST['btn-signup'])) {

            // on initialise error
            $error = NULL;

            // echappement des champs
            $uname = htmlspecialchars(trim($_POST['txt_uname']));
            $umail = htmlspecialchars(trim($_POST['txt_umail']));
            $upass = htmlspecialchars(trim($_POST['txt_upass']));
            $upass2 = htmlspecialchars(trim($_POST['password2']));


            // génération d'un chiffre aléatoire converti en hexa
            $random_bytes = random_bytes(10);
            $random_str = bin2hex($random_bytes);


            // ____________________________
            //  - - FIN DE L'AJOUT D'IMAGE
            // ____________________________

            if ($uname == "") {


                $_SESSION['msg'] = "Un pseudo ça sera ptet mieux ...";
                $_SESSION['color'] = 'bgorange';
                $error = TRUE;

            } else if ($umail == "") {

                $_SESSION['msg'] = "Pourquoi pas un email ?";
                $_SESSION['color'] = 'bgorange';
                $error = TRUE;
            } else if (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {

                $_SESSION['msg'] = "Un email valide c'est mieux non ? ";
                $_SESSION['color'] = 'bgorange';
                $error = TRUE;
            } else if ($upass == "") {

                $_SESSION['msg'] = "C'est mieux un mot de passe pour sécuriser tout ça ...";
                $_SESSION['color'] = 'bgorange';
                $error = TRUE;

            } else if (strlen($upass) < 6) {

                $_SESSION['msg'] = "Au fait, 6 lettres minimum pour le mot de passe, question de sécurité.";
                $_SESSION['color'] = 'bgorange';
                $error = TRUE;
            } else if ($upass2 != $upass) {


                $_SESSION['msg'] = "Les mots de passes ne correspondent pas, c'est balot :/";
                $_SESSION['color'] = 'bgorange';
                $error = TRUE;
            }


            //si il n'y a pas d'erreurs
            if ($error != TRUE) {

                $image = $this->modelObj->saving_picture($uname, $_FILES['photo']);

                if ($image == FALSE) {
                    $image = 'https://api.adorable.io/avatars/150/' . $random_str . '_' . $uname . '.png';
                    $nom_photo_avec_random = $image;
                    $img_profil = $nom_photo_avec_random;
                } else {
                    $img_profil = $image;
                }


                try {

                    $row = $this->modelObj->verify_user($uname, $umail);

                    if ($row['username'] == $uname) {
                        $_SESSION['color'] = 'bgred';
                        $_SESSION['msg'] = "Pseudo déjà pris, désolé !";
                    } else if ($row['email'] == $umail) {
                        $_SESSION['color'] = 'bgred';
                        $_SESSION['msg'] = "Adresse e-mail déjà utilisée !";
                    } else {

                        $test = $this->modelObj->register($uname, $umail, $upass, $img_profil);


                        if ($test == TRUE) {

                            $_SESSION['color'] = 'bggreen';
                            $_SESSION['msg'] = "Vous êtes bien enregistré, connectez-vous";
                            $this->controller->redirect('compte');
                        }


                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

            } // si ya une erreur, on recharge la page pour que les msg d'erreurs s'affichent
            else {
                $this->controller->redirect('register');
            }

            /*

                        if (isset($_GET['joined'])) {
                            //TODO : Améliorer ça, un login auto + redirect comtpe.php
                            echo "
                    <div class='alert bggreen'>
                        <i class='glyphicon glyphicon-log-in'></i> &nbsp; Bien enregistré,  <a href='login'>connectez-vous</a>.
                    </div>
                    ";
                        }*/


        }


    }

    public function aside($clickable)
    {
        // recuperation de l'image
        $img_util = $this->controller->get_img_util();
        //si elle contient http dans le champ
        if (strstr($img_util, 'api.adorable.io') == TRUE) {
            // on affiche le champ tel quel
            $image_a_afficher = htmlspecialchars($img_util);

        } else {
            $image_a_afficher = '../img/utilisateurs/' . $this->modelObj->get_pseudo() . '/profil/' . $img_util;
        }

        if ($this->modelObj->is_loggedin() != "") {
            require_once './includes/aside.inc.php';

        }
    }

    public function compte($param)
    {


        echo $this->aside(FALSE);

        if ($this->modelObj->is_loggedin() != '') {
            // TODO + d'options

            ?>


            <?php
        } else {
            $this->modelObj->redirect('index');
        }
    }


    public function verification_psd_reset()
    {
        return $this->modelObj->verif_psd();
    }

    public function view_account($id)
    {
        echo 'Salut ' . $id[0];
    }

    public function modifier_profil()
    {
        echo $this->aside(TRUE);

        if (isset($_FILES['photo'])) {
            $photo = $this->modelObj->saving_picture($this->modelObj->get_pseudo(), $_FILES['photo']);
            if ($this->controller->update_photo($photo) == TRUE) {
                $this->modelObj->redirect('/utilisateur/modifier_profil');

            };
        }

        require './includes/modifier_profil.inc.php';


    }

    public function logout()
    {


        unset($_SESSION['user_session']);
        session_destroy();
        $this->controller->redirect('index');

    }

}