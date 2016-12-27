<div class="item">

    <div class="content top left attached label floating_over">

        <a href="/utilisateur/view_account/<?= $donnees['id_utilisateur'] ?>" style="color: #fff;">
            <?= $retour;?>
            <?= $pseudo;?>
        </a>

    </div>

    <div class="ui tiny image">
        <a class="header" href="/recettes/view_recipe?id=<?= $donnees['id'] ?>"> <amp-img src="<?= $afficher ?>"   width="96" height="96"></a>



    </div>



    <div class="content">
        <a class="header" href="/recettes/view_recipe?id=<?= $donnees['id'] ?>"> <?= ucfirst($titre_r)
            ; ?></a>



        <div class="meta">
            <div class="ui rating" data-rating="<?= $donnees['difficulte']?>"></div>

        </div>


        <div class="description">
            <?php

            if($donnees['commentaire'] != ''){
           echo ' <p>'. $this->limit_texter($donnees['commentaire'], 40).'</p>';
            }

            ?>

        </div>

        <div class="extra">
            <div class="left floated">
                <i class="heart outline like icon"></i>
                <?= rand(0, 1000)?>
            </div>

            <div class="right floated">
                <i class="comment icon"></i>
                <?= rand(0, 1000)?>

            </div>
        </div>



        <div class="extra">
            <div class="left floated">
                <div class="ui compact basic buttons">
                    <?php
                    if(isset($nom_univers[0])) {
                        echo ' <a href="/recettes/univers/'.$donnees['id_univers'].'"><button class="ui tiny button">' . $nom_univers[0] . '</button></a>';
                    }
                    else {
                        echo '';
                    }
                    ?>

                    <?php
                    if(isset($cat_univers[0])) {
                        echo ' <button class="ui tiny button">
                                                    ' . $cat_univers[0] . '</button>';
                    }
                    else {
                        echo '';
                    }




                    ?>
                </div>
            </div>

            <div class="right floated">
                <a href="/recettes/type/<?= $donnees['type']?>"><button class="compact ui <?=$color ?> basic  button">
                        <?= ucfirst($this->affiche_nom_categorie_recette($donnees['id'], '1') )?>
                    </button>
                </a>
            </div>


        </div>


    </div>



</div>