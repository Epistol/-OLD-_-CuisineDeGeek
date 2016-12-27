<nav class="nav">
    <a href="/index" class="header nav-item">
        <amp-img src="/img/cdglogo.png" width="35px" height="20px"/>

    </a>
    <a href="/index" class="nav-item">Cuisine De Geek</a>
    <a href="/recettes" class="nav-item">Recettes</a>
    <div class="ui simple dropdown item nav-item">
        <p class="nav-item">Types<i class="material-icons">arrow_drop_down</i> </p>


        <div class="menu">
            <a class="nav-item" href="/recettes/type/1">Entrées</a>
            <a class="nav-item" href="/recettes/type/2">Plats</a>
            <a class="nav-item" href="/recettes/type/3">Desserts</a>
            <a class="nav-item" href="/recettes/type/4">Accompagnements</a>
            <a class="nav-item" href="/recettes/type/5">Amuse-Bouche</a>
            <a class="nav-item" href="/recettes/type/6">Bonbons</a>
            <a class="nav-item" href="/recettes/type/7">Sauces</a>
            <a class="nav-item" href="/recettes/type/8">🍹 Cocktails</a>
        </div>
    </div>

    <div class="ui simple dropdown item nav-item">
        <p class="nav-item">Univers <i class="material-icons">arrow_drop_down</i> </p>
        <div class="menu">
            <a class="nav-item" href="/recettes/univers/2">Game of Thrones</a>
            <a class="nav-item" href="/recettes/univers/1">Skyrim</a>
            <a class="nav-item" href="/recettes/univers/">Et encore d'autres !</a>
        </div>
    </div>
    <div class="ui simple dropdown item nav-item">
        <p class="nav-item">Catégories <i class="material-icons">arrow_drop_down</i> </p>
        <div class="menu">
            <a href="/recettes/categorie/1" class="nav-item">🎮 Jeux-vidéo</a>
            <a href="/recettes/categorie/2" class="nav-item">🎥 Cinéma / TV</a>
            <a href="/recettes/categorie/3" class="nav-item">💢 Manga / Anime</a>
            <a href="/recettes/categorie/5" class="nav-item">💬 Comics</a>
            <a href="/recettes/categorie/6" class="nav-item">🃏 Jeux de cartes</a>
            <a href="/recettes/categorie/7" class="nav-item">📚 Livres</a>
        </div>
    </div>

    <div class="right menu nav-right nav-menu">
        <div class="nav-item" style="height: 100%;">


            <input type="text" placeholder="Recherche..." class="input">
            <div class="button"><i class="search icon"></i></div>

        </div>

        <?php
        if (isset($_SESSION['user_session'])) {

            $pseudo = $user->get_pseudo();


            // recuperation de l'image
            $img_util = $user->get_img();
            //si elle contient http dans le champ
            if (strstr($img_util, 'api.adorable.io') == TRUE) {
                // on affiche le champ tel quel
                $image_a_afficher = htmlspecialchars($img_util);
            } else {
                $image_a_afficher = '/img/utilisateurs/' . $pseudo . '/profil/thumbs/thumb' . $img_util;
            }


            ?>


            <div class="ui simple dropdown item nav-item">
                <?php echo '<a href="/utilisateur/compte" class="">' . $pseudo . '
                <amp-img width="28px" height="28px" src="'
                . $image_a_afficher .
                '" class="ui avatar image" /></a>';
            ?> <i class="dropdown icon"></i>
                <div class="menu">
                    <a href="/utilisateur/modifier_profil" class="nav-item"> <i class="settings icon"></i> Réglages</a>

                    <a href="/utilisateur/logout" class="nav-item">Déconnexion</a>
                </div>
            </div>


            <?php

        } else {

            ?>
            <div class="nav-item">
                <a href="/utilisateur/login" class="nav-item">Connexion</a>
            </div>
            <?php
        }


        ?>

    </div>



</nav>


<!--[if lt IE 8]>
<p class="browserupgrade">Votre navigateur est dépassé. Veuillez en utiliser un récent si possible : <a
        href="http://browsehappy.com/">via ce site</a> pour améliorer votre expérience.</p>
<![endif]-->
