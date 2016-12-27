
<div class="ui card">
    <div class="content top left attached label floating_over">
        <a href="/utilisateur/view_account/<?= $donnees['id_utilisateur'] ?>" style="color: #fff;">
            <?= $retour;?>
            <?= $pseudo;?>
        </a>
    </div>
    <div class="blurring dimmable image">
        <div class="ui dimmer">
            <div class="content">
                <div class="center">
                    <?php
                    if(isset($nom_univers[0])) {
                        echo ' <div class="ui inverted button">' . $nom_univers[0] . '</div>';
                    }
                    else {
                        echo '';
                    }
                    ?>
                    <?php
                    if(isset($cat_univers[0])) {
                        echo ' <div class="ui inverted button" style="margin: 0.5rem;">
                                                    ' . $cat_univers[0] . '</div>';
                    }
                    else {
                        echo '';
                    }
                    ?>
                </div>
            </div>
        </div>
        <amp-img src="<?= $afficher ?>">
    </div>
    <div class="content">
        <a class="header" href="/recettes/view_recipe?id=<?= $donnees['id'] ?>"> <?= ucfirst($titre_r)
            ; ?></a>
        <div class="hidden divider ui"></div>
        <div class="meta">
            <div class="left floated">
                <i class="heart outline like icon"></i>
                <?= rand(0, 1000)?>
            </div>
            <div class="right floated">
                <i class="comment icon"></i>
                <?= rand(0, 1000)?>
            </div>
        </div>
    </div>
    <div class="extra rat_hid">
        <div class="ui rating" data-rating="<?= $donnees['difficulte']?>"></div>
        <div class="right floated">
            <a href="/recettes/type/<?= $donnees['type']?>"><button class="compact ui <?=$color ?> basic  button">
                    <?= ucfirst($this->affiche_nom_categorie_recette($donnees['id'], '1') )?>
                </button>
            </a>
        </div>
    </div>
</div>