<?php


class UtilisateurModel
{

    private $maco;

    private $message;

    /**
     * UtilisateurModel constructor.
     * @param $maco2
     */
    function __construct($maco2)
    {
        $this->maco = $maco2;


    }


    /**
     * @return mixed
     */
    public function verify_user($name, $mail)
    {
        $stmt = $this->maco->prepare("SELECT username,email FROM users WHERE username=:uname OR email=:umail");
        $stmt->execute(array(':uname' => $name, ':umail' => $mail));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    /**
     * @param $uname
     * @param $umail
     * @param $upass
     * @return mixed
     */
    public function register($uname, $umail, $upass, $image)
    {


        try {
            $new_password = password_hash($upass, PASSWORD_DEFAULT);
            $stmt = $this->maco->prepare("INSERT INTO users(username,email,password, date_enregistrement, image_util ) 
                                                       VALUES(:uname, :umail, :upass, now(), :img )");
            $stmt->bindparam(":uname", $uname);
            $stmt->bindparam(":umail", $umail);
            $stmt->bindparam(":upass", $new_password);
            $stmt->bindparam(":img", $image);
            $retour = $stmt->execute();
            return $retour;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }


    /**
     * @param $mdpactu
     * @param $mdp2
     * @param $mdp3
     * @return bool|string
     */

    public function verification_psd_reset($mdpactu, $mdp2, $mdp3)
    {


        try {
            //connexion bdd, on vérifie si l'id est bien celui de la session et si le mdp entré en param est le bon
            $stmt = $this->maco->prepare("SELECT * FROM users WHERE id=:id  LIMIT 1");
            $stmt->execute(array(':id' => $_SESSION['user_session']));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);


            // si l'utilisateur est bien connecté
            if ($stmt->rowCount() > 0) {

                var_dump($userRow);

            if(password_verify($mdpactu, $userRow['password'])){
                echo 'yes';
            }
            else {
                echo 'what';
            }


                // vérification du mdp actif
                if (password_verify($mdpactu, $userRow['password'])) {


                    //si le mdp est correct, on continue

                    if ($mdp2 == $mdp3) {
                        // si le champ du mdp2 est égal au champ 'type again' du mdp


                        try {
                            $new_password = password_hash($mdp3, PASSWORD_DEFAULT);

                            $stmt = $this->maco->prepare("UPDATE users SET password = :pswdf WHERE id=:id  LIMIT 1");
                            $stmt->execute(array(':id' => $_SESSION['user_session'], ':pswdf' => $new_password));

                            return TRUE;
                        } catch (PDOException $e) {
                            return $e->getMessage();

                        }


                    } // si le champ mdp2 et 3 sont pas égaux
                    else {
                        $error = "Les deux mots de passe ne correspondent pas";
                        return $error;
                    }


                }
                else {
                    return FALSE;
                }
            }
            else {
                return FALSE;
            }


        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    /** Fonction de connexion
     * @param $uname
     * @param $umail
     * @param $upass
     * @return bool
     */
    public function login($uname, $umail, $upass)
    {
        try {
            $stmt = $this->maco->prepare("SELECT * FROM users WHERE username=:uname OR email=:umail LIMIT 1");
            $stmt->execute(array(':uname' => $uname, ':umail' => $umail));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0) {
                if (password_verify($upass, $userRow['password'])) {

                    return $userRow['id'];
                } else {
                    return false;
                }
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function ajout_session($value)
    {
        try {
            $stmt = $this->maco->prepare("UPDATE users SET `nb_sesssions` = `nb_sesssions` + 1 WHERE id=:value LIMIT 1");
            $stmt->execute(array(':value' => $value));
            return TRUE;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


// TODO : Aucun sens. à refaire.
    public function get_info($info)
    {
        try {
            $stmt = $this->maco->prepare("SELECT $info FROM users WHERE id=:info LIMIT 1");
            $stmt->execute(array(':info' => $_SESSION['user_session']));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            return $userRow[$info];

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }


    /** est-ce que l'utilisateur est connecté
     * @return bool
     */
    public function is_loggedin()
    {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }

    public function update_time()
    {
        try {
            $stmt = $this->maco->prepare("UPDATE users SET last_loaded_page = now() WHERE id=:id  LIMIT 1");
            $stmt->execute(array(':id' => $_SESSION['user_session']));


        } catch (PDOException $e) {
            return $e->getMessage();

        }
    }


    /** est-ce que l'utilisateur est connecté
     * @return bool
     */
    public function is_admin()
    {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }


    /** affiche le pseudo
     * @return mixed
     */
    public function get_pseudo()
    {
        $user_id = $_SESSION['user_session'];
        $stmt = $this->maco->prepare("SELECT * FROM users WHERE id=:user_id");
        $stmt->execute(array(":user_id" => $user_id));
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userRow['username'];
    }



    /** affiche le pseudo
     * @return mixed
     */
    public function get_info_current_user($info)
    {
        $user_id = $_SESSION['user_session'];
        $stmt = $this->maco->prepare("SELECT $info FROM users WHERE id=:user_id");
        $stmt->execute(array(":user_id" => $user_id));
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userRow[$info];
    }


    /** redirection
     * @param $url
     */
    public function redirect($url)
    {
        header("Location: $url");
    }



    /**
     * @param $id_recette
     * @return mixed
     */
    public function get_img()
    {


        try {
            if(isset($_SESSION['user_session'])){
                $user_id = $_SESSION['user_session'];
                $stmt = $this->maco->prepare("SELECT * FROM users WHERE id=:user_id");
                $stmt->execute(array(":user_id" => $user_id));
                $result = $stmt->fetch(PDO::FETCH_BOTH);


                return $result['image_util'];

                $requete->closeCursor();
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }


    public function makeThumbnails($updir, $img)
    {
        $thumbnail_width = 250;
        $thumbnail_height = 250;
        $thumb_beforeword = "thumb";
        $arr_image_details = getimagesize("$updir" . '/' . "$img"); // pass id to thumb name
        $original_width = $arr_image_details[0];
        $original_height = $arr_image_details[1];
        if ($original_width > $original_height) {
            $new_width = $thumbnail_width;
            $new_height = intval($original_height * ($new_width / $original_width));
            if ($new_height < $new_width) {
                $pourcentage = $thumbnail_height / $new_height;
                $new_height = ($new_height * $pourcentage);
                $new_width = ($new_width * $pourcentage);
            }
        } else {
            $new_height = $thumbnail_height;
            $new_width = intval($original_width * ($new_height / $original_height));
            if ($new_width < $new_height) {
                $pourcentage = $thumbnail_width / $new_width;
                $new_height = ($new_height * $pourcentage);
                $new_width = ($new_width * $pourcentage);
            }
        }
        $dest_x = intval(($thumbnail_width - $new_width) / 2);
        $dest_y = intval(($thumbnail_height - $new_height) / 2);
        if ($arr_image_details[2] == 1) {
            $imgt = "ImageGIF";
            $imgcreatefrom = "ImageCreateFromGIF";
        }
        if ($arr_image_details[2] == 2) {
            $imgt = "ImageJPEG";
            $imgcreatefrom = "ImageCreateFromJPEG";
        }
        if ($arr_image_details[2] == 3) {
            $imgt = "ImagePNG";
            $imgcreatefrom = "ImageCreateFromPNG";
        }
        if ($imgt) {
            $old_image = $imgcreatefrom("$updir" . '/' . "$img");
            $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
            imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
            $th = $updir . '/thumbs';
            if(!is_dir($th)){
                //Directory does not exist, so lets create it.
                mkdir($th);
            }
            $imgt($new_image, "$updir" . "/thumbs/" . "$thumb_beforeword" . "$img");
        }
    }

    public function saving_picture($pseudo,$get){
        // ______________
        // AJOUT D'IMAGE
        // ______________

        $imgFile = $get['name'];
        $file_name = preg_replace("/[^a-zA-Z0-9.]/", "", $imgFile);
        $var = preg_replace('/\s+/', '_', $file_name);
        $tmp_dir = $get['tmp_name'];
        $imgSize = $get['size'];
        $imageFileType = $get['type'];




        // si l'image possède un nom sans espace
        if ($get['error'] <= 0) {
            if ($var != '') {


                $uploads_dir = './img/utilisateurs';

                $uploads_dir = $uploads_dir .'/'.$pseudo;
                if(!is_dir($uploads_dir)){
                    //Directory does not exist, so lets create it.
                    mkdir($uploads_dir);
                }
                $profils = $uploads_dir . '/profil';
                if(!is_dir($profils)){
                    //Directory does not exist, so lets create it.
                    mkdir($profils);
                }
                $uploads_dir = $profils;


                $nom_photo_avec_random = rand(100, 999999) . $var;
                $img_profil = $nom_photo_avec_random;


                $accepted = array(
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    'image/bmp' => 'bmp',
                );
                $file = $get;
                $maxSize = 20 * 1024 * 1024; // 20 MB

                // check if any upload error occured
                if (UPLOAD_ERR_OK !== $file['error']) {

                    // http://php.net/manual/en/features.file-upload.errors.php
                    echo 'Erreur d\'upload: ', $file['error'], '<br/>';

                    // check if file size is bigger than $maxSize
                } elseif ($imgSize > $maxSize) {
                    // if filesize is bigger than upload_max_filesize directive in php.ini
                    // script may timeout without any error
                    // post_max_size and upload_max_filesize need to be high enough
                    echo 'Erreur ! Image trop lourde<br/>';

                    // can proceed further
                } else {

                    // you will need to have the fileinfo enabled in php ini to use these
                    $finfo = finfo_open(FILEINFO_MIME);
                    $mime = finfo_file($finfo, $tmp_dir);
                    // finfo may give you charset info as well
                    // text/plain; charset=utf-8 or image/jpeg; charset=binary
                    $mime = array_shift(explode(';', $mime));
                    // change uploaded file name do to security reasons
                    // google "php null char upload"
                    // nice read http://resources.infosecinstitute.com/null-byte-injection-php/
                    $filename = md5(time() . $imgFile) . '.';
                    // if mime is accepted
                    if (!array_key_exists($mime, $accepted) /* or use isset: ! isset( $accepted[ $mime ] ) */) {

                        echo 'Erreur ! Type non supporté (jpg, png ou bmp uniquement)<br/>';
                        $uploadOk = 0;
                        // si l'upload est bien ok

                        // you could check if file is image and check min-max width & height
                        // for now move the uploaded file
                    } else {
                        $uploadOk = 1;
                        if ($uploadOk != 0) {
                            move_uploaded_file($tmp_dir, "$uploads_dir/$img_profil");
                            $this->makeThumbnails($uploads_dir, $img_profil);

                            return $img_profil;


                        }
                    }



                }


            } // si pas d'image uploadée = var = vide



        }
        else {
            return FALSE;
        }

    }


    public function logout()
    {



        unset($_SESSION['user_session']);
        session_destroy();
        $this->controller->redirect('index');

    }

    public function verif_psd(){


        if ($this->is_loggedin() != "") {

            if(isset($_POST['submit'])){
                echo 'salut';
                $mdp_valid = htmlspecialchars($_POST['psw1']);

                if ($mdp_valid != '') {

                    $ps1 = htmlspecialchars($_POST['psw1']);
                    $ps2 = htmlspecialchars($_POST['psw2']);
                    $ps3 = htmlspecialchars($_POST['psw3']);



                    $verif_psd = $this->verification_psd_reset($ps1, $ps2, $ps3);

                    if ($verif_psd == TRUE) {
                        $this->logout();
                        $this->redirect('index');

                    } else {

                        echo 'Erreur';

                    }


                }   else {
                    $this->redirect('/utilisateur/modifier_profil#mdp');
                }
            }

            else {

            }

        }
    }


}