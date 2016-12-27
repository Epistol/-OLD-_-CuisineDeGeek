<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 13/11/2016
 * Time: 14:47
 */


$recipe = $recette[0];
?>


<div class="html ui top attached segment">

    <form class="ui form" action-xhr="pages/edit" method="post">
        <div class="field">
            <label>Nom de la recette : </label>
            <input type="text" name="titre" value="<?= $recipe['titre'] ?>">
        </div>
        <div class="field">
            <label>Commentaire</label>
            <textarea class="myeditablediv" type="text" name="contenu">
            <?= $recipe['commentaire'] ?>

            </textarea>
        </div>
        <button class="ui button" type="submit">Submit</button>
    </form>

</div>